<?php
	declare(strict_types=1);

	use Lcobucci\JWT\Builder;
	use Lcobucci\JWT\Configuration;
	use Lcobucci\JWT\Parser;
	use Lcobucci\JWT\Signer\Key;
	use Lcobucci\JWT\Signer\Rsa\Sha256;
	require_once '../../dbaccess/dbcontrol/DbManager.php';

	if(file_exists('../../../vendor/autoload.php')){
		include_once '../../../vendor/autoload.php';
	}else{
		include_once '../../vendor/autoload.php';
	}



	class DBUsers extends DbManager	{
		private $DBCon;
		public function __construct ( string $USER , string $PASSWORD , string $DATABASE ) {

			$this->DBCon = mysqli_connect ( 'localhost' , $USER , $PASSWORD , $DATABASE );
			parent ::__construct ( $this->DBCon );
		}
		public function deleteUser(int $rec_id):array {
			$res = $this->setDeleteSafely('users',$rec_id );
			return $this->result($res , 'Deleted User');
		}
		public function UpdateUser($record_id ,  $username, $password,$id_role ):array {
			if(empty($password)){
				$res = $this->andUpdate( 'users', [
					'username' => $username,  'id_role' => $id_role
				], [ 'id' => $record_id ] );
			}else {
				$password =  password_hash ( $password , CRYPT_BLOWFISH , [ 'cost' => 8 , ] );
				$res = $this->andUpdate( 'users', [
					'username' => $username, 'password' => $password, 'id_role' => $id_role
				], [ 'id' => $record_id ] );
			}
			return $this->result($res , 'Updated a  User');
		}
		public function saveNewUser( $username, $password, $id_employee,$id_role ):array {
			$password =  password_hash ( $password , CRYPT_BLOWFISH , [ 'cost' => 8 , ] );
			$res = $this->insert('users',[
				'username'=> $username , 'password'=>$password , 'id_employee'=>$id_employee ,'id_role'=>$id_role
			]);
			return $this->result($res , 'Created a New User');
		}
		public function getEmployeesWithOutUserAccounnts ()
		: array {

			$sql = 'SELECT e.id ,  e.name  , e.surname
								FROM employees e
								WHERE (e.isdeleted = 0 AND e.isvisible =1)
								  AND  e.id NOT IN (SELECT users.id_employee FROM users)';

			return $this -> fetchInArray ( $sql );
		}
		/**Get all users*/
		public function getAllUsers():array {
			$sql = "SELECT users.ID, users.USERNAME, CONCAT(employees.name , '', employees.surname) AS fullName, roles.title AS roleTitle, 
    						users.ID_ROLE 
						FROM users JOIN roles ON roles.id = users.id_role JOIN employees ON employees.id = users.id_employee WHERE
					users.isvisible = 1";
			return $this->fetchInArray($sql);
		}
		public function getAllRoles():array {
			$sql = "SELECT * FROM roles";
			return $this->fetchInArray($sql);
		}



		public function loginUser(string $username ,string $password):array {
			if ( $this->countRows( 'users', [ 'username' => $username ] ) < 1 ) {
				return [ 'status' => 'none' ];
			}

			$sql = mysqli_query( $this->DBCon, "SELECT password,id_role,id FROM users WHERE username = '$username'" );
			$sqlArr = mysqli_fetch_assoc( $sql );
			$dbPassword = $sqlArr[ 'password' ];
			$dbRole = (int)$sqlArr[ 'id_role' ];
			$dbUserID = (int)$sqlArr[ 'id' ];
			$accessM = '1.1,1.2,2.1,2.2,10.1,10.2,3.1,3.2,4.1,4.2,5.1,5.2';
			if ( !password_verify( $password, $dbPassword ) ) {
				return [ 'status' => 'auth' ];
			}

			if ( !isset( $_SESSION ) ) {
				session_start();
			}
			require '../../../config/LoadModulesResources.php';
			$_SESSION[ 'modules_lists' ] = $accessM;
			$res = new LoadModulesResources();
			$res->loadFiles();
			$res->buildNavigations( $accessM );
			$_SESSION[ 'SYSTEM_MAIN_NAV' ] = $res->SYSTEM_MAIN_NAV;
			$_SESSION[ 'USER_MODULES' ] = $res->USER_MODULES;
			$_SESSION[ 'SYSTEM_PARENT_NAV' ] = $res->SYSTEM_PARENT_NAV;
			$token = (string)$this->createUserToken( $dbUserID, $dbRole );
			return [ 'status' => 'ok', 'jwt' => $token ];


		}

		public function tokenToken(string $token ):array {
			if(!$this->isTokenValid($token)){
				return null;
			}
		}

		public function createUserToken(int $userID,int $role) {

		// 259200seconds  = 3days
		// 86400seconds  = 1days
			$time = time();
			$token = (new Builder())
				->issuedBy('http://example.com') // Configures the issuer (iss claim)
			->permittedFor('http://example.org') // Configures the audience (aud claim)
			->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
			->issuedAt($time) // Configures the time that the token was issue (iat claim)
			->canOnlyBeUsedAfter($time + 60) // Configures the time that the token can be used (nbf claim)
			->expiresAt($time + 3600) // Configures the expiration time of the token (exp claim)
			->withClaim('user', $userID) // Configures a new claim, called "uid"
			->withClaim('role',$role)
			->withClaim('modules','1,2,3')
			->getToken(); // Retrieves the generated token


			//$token->getHeaders(); // Retrieves the token headers
			//$token->getClaims(); // Retrieves the token claims

			//echo $token->getHeader('jti'); // will print "4f1g23a12aa"
			//echo $token->getClaim('iss'); // will print "http://example.com"
			//echo $token->getClaim('user_id'); // will print "1"
			//echo $token->getClaim('modules'); // will print "1"

			return $token;
		}
		public function isTokenValid($token):bool {
			try {

			$token = (new Parser())->parse( (string)$token); // Parses from a string
			}catch (Exception  $exception){
				return FALSE;
			}
			return !$token->isExpired();
		}
		public function deduceTokenAccess( $token){
			$ret = [] ;
			try {
			$token = (new Parser())->parse( (string)$token); // Parses from a string
			//$token->getHeaders(); // Retrieves the token header
			//$token->getClaims(); // Retrieves the token claims
				$ret ['userID'] = (int) $token->getClaim('user');
				$ret ['roleID'] = (int) $token->getClaim('role');

			//echo $token->getHeader('jti'); // will print "4f1g23a12aa"
			//echo $token->getClaim('iss'); // will print "http://example.com"
			//echo $token->getClaim('uid'); // will print "1"
			}catch (Exception  $exception){
				// print "eee".$exception->getMessage();
			}
			return $ret;

		}

	}
	//$obj = new DBUsers('root' , '' , 'schoolcare');
	//$tok = $obj->createUserToken(561);
	//($obj->validateTokenAccess("3454.i."));
	//var_dump($obj->isTokenValid($tok));
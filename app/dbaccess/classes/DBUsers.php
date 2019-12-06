<?php
	declare(strict_types=1);
	/*$levl = '';
	for ($i = 0 ; $i < 17 ; $i++){

		print "{$levl}dbaccess/dbcontrol/DbManager.php";
		var_dump(file_exists("{$levl}dbaccess/dbcontrol/DbManager.php"));
		$levl.= "../";
	}
	exit;*/
	//use DbManager\DbManager;
	use Lcobucci\JWT\Builder;
	use Lcobucci\JWT\Configuration;
	use Lcobucci\JWT\Parser;
	use Lcobucci\JWT\Signer\Key;
	use Lcobucci\JWT\Signer\Rsa\Sha256;
	require_once '../../dbaccess/dbcontrol/DbManager.php';
	//var_dump(file_exists('../dbcontrol/DbManager.php'));exit;

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

		public function loginUser(string $username ,string $password):array {
			if ( $this->countRows( 'users', [ 'username' => $username ] ) < 1 ) {
				return [ 'status' => 'none' ];
			}

			$sql = mysqli_query( $this->DBCon, "SELECT password,id_role,id FROM users WHERE username = '$username'" );
			$sqlArr = mysqli_fetch_assoc( $sql );
			$dbPassword = $sqlArr[ 'password' ];
			$dbRole = (int)$sqlArr[ 'id_role' ];
			$dbUserID = (int)$sqlArr[ 'id' ];
			$accessM = '1.1,1.2,1.3';
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
			$token = (string)$this->createUserToken( $dbUserID, $dbRole );
			return [ 'status' => 'ok', 'jwt' => $token ];


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
		public function validateTokenAccess( $token){
			try {
			$token = (new Parser())->parse( (string)$token); // Parses from a string
			$token->getHeaders(); // Retrieves the token header
			$token->getClaims(); // Retrieves the token claims

			//echo $token->getHeader('jti'); // will print "4f1g23a12aa"
			//echo $token->getClaim('iss'); // will print "http://example.com"
			//echo $token->getClaim('uid'); // will print "1"

				($token->isExpired());
			}catch (Exception  $exception){
				print "eee".$exception->getMessage();
			}

		}

	}
	//$obj = new DBUsers('root' , '' , 'schoolcare');
	//$tok = $obj->createUserToken(561);
	//($obj->validateTokenAccess("3454.i."));
	//var_dump($obj->isTokenValid($tok));
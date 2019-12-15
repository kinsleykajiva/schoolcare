<?php
	//namespace DbManager;
	use DBLoggingService as log;


	require_once "DBLoggingService.php";

	class DbManager {

		private $DBCon = NULL;
		CONST SUCCESS = 'ok';
		CONST ERROR = 'error';

		protected $collection = NULL;

		protected $lastInsertAutoID = NULL;

		protected function getDBCon () {
			return $this -> DBCon;
		}
		/**
		 * Will contain the last query results . This aims to avoid calling mysql query again after getting cound of the same result
		 * This will not be null after using countRows()
		 *
		 * @var [MysqlQuery_Result]
		 */
		protected $lastCountRowsQueryResult = null ;

		/**
		 * @param  null  $DBCon
		 */
		protected function setDBCon ( $DBCon )
		: void {
			$this -> DBCon = $DBCon;

		}

		/**
		 * @return int
		 */
		protected function getLastInsertAutoID ()
		: int {
			return $this -> lastInsertAutoID = mysqli_insert_id ( $this -> DBCon );
		}

		/**Tests result for a query insert
		 *
		 * @param bool        $processResult
		 * @param string      $operationType
		 * @param string|null $reason
		 * @param array|null  $extra
		 *
		 * @return array
		 */
		protected function result ( bool $processResult , string $operationType , string $reason = NULL , array $extra = NULL )
		: array {

			return $processResult
				? array (
					'status' => self::SUCCESS ,
					'operation' => $operationType ,
					'reason' => $reason ,
					'extra'     => $extra ,
				)
				: array (
					'status' => self::ERROR ,
					'operation' => $operationType ,
					'reason' => $reason . ' Error ' ,
					'extra'     => $extra ,
				);
		}

		/**
		 * DbManager constructor.
		 *
		 * @param  null  $DBCon
		 *
		 * @throws Exception
		 */
		public function __construct ( $DBCon ) {
			$this -> DBCon = $DBCon;
			//DBLoggingService::LOG_FILE;
			//$this->collection = new \Doctrine\Common\Collections\ArrayCollection([]);
			if ( is_null ( $this -> DBCon ) ) {
				throw new Exception( "Null Database Connection" );
			}
		}

		protected function setDeleteSafely ( string $table , int $record_id  , bool $debug = false) {

			return $this -> andUpdate ( $table , array (
				'isvisible' => 0 ,
			) , [ 'id' => $record_id ] , $debug);
		}


		/**
		 * @param  string  $tableName
		 * @param  array   $conditions
		 *
		 * @return int
		 * @throws Exception
		 */
		protected function countRows ( string $tableName , array $conditions = null ,  bool $debug = false ) {
			if(!is_null($conditions)){
				$sql   = "SELECT  id  FROM {$tableName} WHERE  ";
				$WHERE = "";
				$AND   = " AND ";
				foreach ( $conditions as $column => $value ) {

					$WHERE .= $column . "='{$value}'{$AND}";
				}
				$WHERE = rtrim ( $WHERE , "{$AND}" );
				$sql .= $WHERE;
			}else {
				$sql = "SELECT  id  FROM {$tableName}  ";
			}
			if ( $debug ) {
				log ::logInfo ( $sql , "countRows()" );

			}

			$this->lastCountRowsQueryResult = $this -> rawQuery ( $sql );


			return mysqli_num_rows ( $this->lastCountRowsQueryResult );

		}

		protected function fetchAssocJson ( string $query )
		: ?string {

			if ( empty( $query ) ) {
				return NULL;
			}

			return json_encode ( $this -> fetchInArray ( $query ) );
		}
		protected function clearAllPermissions(int $id_record , string $table_name ):void{

			$this -> rawQuery( "DELETE FROM record_access_rights WHERE  id_record = $id_record  AND table_title_name = '$table_name' ");
		}
		protected function savePermissions(int $id_record , int $id_user , string $table_name , string $access_permissions):void{
			/// first delete all record

			$this -> rawQuery( "DELETE FROM record_access_rights WHERE  id_record = $id_record AND id_user = $id_user AND table_title_name = '$table_name' AND records_access_rights = '$access_permissions' ");

			$this->insert('record_access_rights' ,
				['id_record' =>$id_record , 'id_user'=>$id_user ,'table_title_name'=>$table_name,'records_access_rights' => $access_permissions]);
		}
		protected function insert ( string $table , array $data , bool $debug = FALSE ) {
			$columns   = implode ( " , " , array_keys ( $data ) );
			$valuesCol = "";
			$comma     = " , ";
			$INSERT    = "INSERT INTO  {$table} ";
			foreach ( $data as $columnKeys => $values ) {
				if ( $values === NULL ) {
					$valuesCol .= "NULL {$comma}";
				}
				else {
					$valuesCol .= "'{$values}'{$comma}";
				}

			}
			$valuesCol = rtrim ( $valuesCol , $comma );
			$query     = $INSERT . " ( {$columns}  ) VALUES ( {$valuesCol} )";

			if ( $debug ) {
				log ::logInfo ( $query , "insert()" );

			}

			return $this -> rawQuery ( $query );
		}

		protected function fetchAllInArray ( string $sqlQuery , bool $debug = FALSE )
		: array {
			$data = $this -> rawQuery ( $sqlQuery  );
			$arr  = array ();

			if ( mysqli_num_rows ( $data ) == 1 ) {
				return mysqli_fetch_assoc ( $data );
			}

			while ( $row = mysqli_fetch_assoc ( $data ) ) {
				$arr[] = $row;
			}

			return $arr;
		}

		/**
		 * @deprecated this is just  to be replaced  by @method <b>fetchAllInArray</b>
		 */
		protected function fetchInArray ( string $sqlQuery )
		: array {
			$data = $this -> rawQuery ( $sqlQuery );
			$arr  = array ();

			while ( $row = mysqli_fetch_assoc ( $data ) ) {
				$arr[] = $row;
			}

			return $arr;
		}

		protected function andUpdate ( string $table , array $dataArray , array $conditionWhere , bool $debug = FALSE ) {
			$sql = "UPDATE " . $table . " SET ";

			$setData    = "";
			$comma      = " , ";
			$whereCondi = "";
			$and        = " AND ";
			foreach ( $conditionWhere as $colunm => $value ) {
				$whereCondi .= "{$colunm} = '{$value}'{$and}";
			}
			$whereCondi = rtrim ( $whereCondi , $and );
			foreach ( $dataArray as $colunm => $value ) {
				if ( $value === NULL ) {
					$setData .= "{$colunm} = NULL {$comma}";
				}
				else {
					$setData .= "{$colunm} = '{$value}'{$comma}";
				}

			}
			$setData = rtrim ( $setData , $comma );
			$sql .= " " . $setData . " WHERE {$whereCondi}  ";
			if ( $debug ) {
				log ::logInfo ( $sql , "andUpdate()" );
			}

			return $this -> rawQuery ( $sql );
		}

		protected function justFetch ( string $table , string $conditionColumn , string $condition , array $columns = [ '*' ] , bool $debug = FALSE )
		: ?array {
			$sql = implode ( "," , $columns );
			$sql = "SELECT " . $sql . " FROM " . $table . " WHERE {$conditionColumn} = '$condition'";
			if ( $debug ) {
				log ::logInfo ( $sql , "justFetch()" );
			}
			return mysqli_fetch_assoc ( $this -> rawQuery ( $sql ) );
		}

		protected function justGet ( string $table , int $conditional_id , array $columns = [ '*' ] , bool $debug = FALSE )
		: ?array {
			$sql = implode ( "," , $columns );
			$sql = "SELECT " . $sql . " FROM " . $table . " WHERE id = " . $conditional_id;
			if ( $debug ) {
				log ::logInfo ( $sql , "justGet()" );
			}
			return mysqli_fetch_assoc ( $this -> rawQuery ( $sql ) );
		}

		protected function orUpdate ( string $table , array $dataArray , array $conditionWhere , bool $debug = FALSE ) {
			$sql = "UPDATE " . $table . " SET ";

			$setData    = "";
			$comma      = " , ";
			$whereCondi = "";
			$or         = " OR ";
			foreach ( $conditionWhere as $colunm => $value ) {
				$whereCondi .= "{$colunm} = '{$value}'{$or}";
			}
			$whereCondi = rtrim ( $whereCondi , $or );
			foreach ( $dataArray as $colunm => $value ) {
				if ( $value === NULL ) {
					$setData .= "{$colunm} = NULL {$comma}";
				}
				else {
					$setData .= "{$colunm} = '{$value}'{$comma}";
				}
			}
			$setData = rtrim ( $setData , $comma );
			$sql     = $sql . " " . $setData . " WHERE {$whereCondi}  ";
			if ( $debug ) {
				log ::logInfo ( $sql , "orUpdate()" );
			}
			if ( $debug ) {
				return $sql;
			}

			return $this -> rawQuery ( $sql );
		}

		/**This is  a SELECT * FROM  @param $tableName */
		protected function readTable ( string $tableName ) {
			return $this -> rawQuery ( "SELECT * FROM {$tableName}" );
		}

		/**
		 * @param string $query_statement
		 *
		 * @param bool $isDebug
		 * @return bool|mysqli_result
		 * @throws Exception
		 */
		protected function rawQuery ( string $query_statement , bool $isDebug = FALSE) {
			if ( $this -> DBCon === NULL ) {
				throw new Exception( 'Null Database Connection' );
			}
			if($isDebug){
				log ::logInfo ( $query_statement , "RawInsert" );
			}

			return mysqli_query ( $this -> DBCon , $query_statement );
		}
		/**
		 * Used to clean or escape NUL (ASCII 0), \n, \r, \, ', ", and Control-Z
		 *
		 * @param string $string
		 * @return string
		 */
		public function cleanSQLString(string $string):string{
			return mysqli_real_escape_string($this->DBCon , $string);
		}

		public static function nowDateTime ()
		: string {
			// to be review
			date_default_timezone_set('Africa/Harare');
			return date ( 'Y-m-d H:i:s' );
		}
		/**
		 * Do not use this function every time also do a check if the user has the access to this function
		 *
		 * @param string $tableName
		 * @return void
		 */
		public function emptyTableWithRisk(string $tableName):mysqli_result{
			$sql  = "TRUNCATE  TABLE  {$tableName}" ;
			return $this->rawQuery($sql);
		}

		/**
		 * [cleamWrite This seeks to clean string from injections ]
		 *
		 * @param  string  $data
		 *
		 * @return string [string]        [will have the cleaned out put ]
		 */
		public static function cleanWrite ( string $data )
		: string {
			return empty( $data ) ? $data : preg_replace ( '/[^\p{L}\p{N}\s]/u' , '' , trim ( $data ) );
		}


	}
	//log::logInfo ("sdas");
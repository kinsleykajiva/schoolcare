<?php

	declare(strict_types  = 1);
	require_once '../../dbaccess/dbcontrol/DbManager.php';
	class DBCompanyDetails
		extends DbManager
	{
		private $DBCon;
		private $TABLE = "company_details";
		public $NAME , $ADDRESS , $CONTACTS  , $EMAIL , $LOGO;


		public function __construct ( string $USER , string $PASSWORD , string $DATABASE )
		{

			$this->DBCon = mysqli_connect( 'localhost' , $USER , $PASSWORD , $DATABASE );
			parent::__construct( $this->DBCon );
			$data = $this->companyDetails();
			if(!$data == null ) {
				$this -> NAME     = $data[ 'title' ];
				$this -> ADDRESS  = $data[ 'address' ];
				$this -> CONTACTS = $data[ 'contacts' ];
				$this -> EMAIL    = $data[ 'email' ];
				$this -> LOGO     = $data[ 'logo' ];
			}
		}

		public function hasCompanyDetails():bool {
			return  $this->countRows($this->TABLE , null) > 0;
		}
		public function saveCompanyDetails(string $title ,  string $address , string $contacts , string $email , string $logo ):array{
			//since we want to keep only one record in thsi table we have to check of there was a  record and then we have to update that record
			if($this->countRows($this->TABLE , null)){
				 $this->emptyTableWithRisk($this->TABLE);
			}
			$result = $this->insert($this->TABLE , array(
				'title' => $title ,
				'address' => $address ,
				'contacts' =>$contacts ,
				'email' => $email ,
				'logo' => $logo
			) );

			return $this->result($result , "Saving Company" );
		}
		private function companyDetails():array{
			return $this->fetchAllInArray ("SELECT * FROM $this->TABLE LIMIT 1");
		}
		/** @deprecated use class properties **/
		public function justCompanyDetail(string $column):string {
			return $this->fetchAllInArray ("SELECT $column FROM $this->TABLE LIMIT 1")[$column];
		}

	}
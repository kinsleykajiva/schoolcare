<?php

	declare( strict_types = 1 );

	require_once '../../dbaccess/dbcontrol/DbManager.php';
	class DBAgeRanges
		extends DbManager
	{
		private $DBCon;


		public function __construct ( string $USER , string $PASSWORD , string $DATABASE )
		{


			$this->DBCon = mysqli_connect( 'localhost' , $USER , $PASSWORD , $DATABASE );
			parent::__construct( $this->DBCon );
		}
		public function getAllAgeRanges():array {
			$sql =  'SELECT * FROM age_ranges';
			return $this->fetchInArray($sql) ;
		}
		public function saveUpdateAgeRange(int $rec_id , int $start_age_in_months , int $end_age_in_months):array {
			if($start_age_in_months > $end_age_in_months ){
				return $this->result(FALSE , 'Updating Age Range','range error' );
			}
			if($this->countRows('age_ranges',[
					'start_age_in_months'=> $start_age_in_months,
					'end_age_in_months'=>$end_age_in_months
				])> 0){
				return $this->result(FALSE , 'Updating Age Range','duplicate error' );
			}
			$res= $this->andUpdate('age_ranges',[
				'start_age_in_months'=> $start_age_in_months,
				'end_age_in_months'=>$end_age_in_months
			],['id'=>$rec_id]);

			return $this->result($res , 'Updated Age Range' );
		}

		public function saveNewAgeRange(int $start_age_in_months , int $end_age_in_months):array {
			if($start_age_in_months > $end_age_in_months ){
				return $this->result(FALSE , 'Saving Age Range','range error' );
			}
			if($this->countRows('age_ranges',[
					'start_age_in_months'=> $start_age_in_months,
					'end_age_in_months'=>$end_age_in_months
				])> 0){
				return $this->result(FALSE , 'Saving Age Range','duplicate error' );
			}
			$res= $this->insert('age_ranges',[
				'start_age_in_months'=> $start_age_in_months,
				'end_age_in_months'=>$end_age_in_months
			]);

			return $this->result($res , 'Saved Age Range' );
		}

	}
<?php

	declare( strict_types = 1 );

	require_once '../../dbaccess/dbcontrol/DbManager.php';
	class DBFeesHandler
		extends DbManager
	{
		private $DBCon;


		public function __construct ( string $USER , string $PASSWORD , string $DATABASE )
		{

			$this->DBCon = mysqli_connect( 'localhost' , $USER , $PASSWORD , $DATABASE );
			parent::__construct( $this->DBCon );
		}

		public function getPostedChildrenForFinancialYear($year = ''):array {
			if(!empty($year)){
				return $this->fetchInArray("SELECT ffy.id, ffy.id_child, ffy.id_year , CONCAT(c.surname , ' ' ,c.name) AS childName
												FROM fees_financial_year ffy 
												        JOIN financial_year fy ON ffy.id_year = fy.id
												        JOIN children c ON  c.id = ffy.id_child
												        WHERE fy.year = '$year' ");
			}
			return $this->fetchInArray("SELECT ffy.id, ffy.id_child, ffy.id_year , CONCAT(c.surname , ' ' ,c.name) AS childName
												FROM fees_financial_year ffy 
												        JOIN financial_year fy ON ffy.id_year = fy.id
												        JOIN children c ON  c.id = ffy.id_child");
		}

		public function getFeesItems():array {
			return $this->fetchInArray('SELECT * FROM fees_items');
		}

		public function getFeesPackages():array {
			return $this->fetchInArray('SELECT fp.id,  fp.title,  fp.fee_items_ids,  fp.id_payment_periods ,fpp.title AS payment_period_title 
												FROM fees_packages fp 
												    JOIN fees_payment_periods fpp ON fp.id_payment_periods = fpp.id 
												    ');
		}


		public function getPaymentPeriods():array {
			return $this->fetchInArray('SELECT * FROM fees_payment_periods');
		}

		public function getPaymentMethods():array {
			return $this->fetchInArray('SELECT * FROM payment_type');
		}


		public function editFeesPackage( $id_rec , $title , $fee_items_ids ,$id_payment_periods ):array {

			return $this->result(
				$this->andUpdate('fees_packages',[
					'title' => $title,
					'fee_items_ids' => $fee_items_ids,
					'id_payment_periods' => $id_payment_periods
				] ,['id'=>$id_rec]),'Updated new package');
		}
		public function createFeesPackage( $title , $fee_items_ids ,$id_payment_periods ):array {

			return $this->result(
				$this->insert('fees_packages',[
					'title' => $title,
					'fee_items_ids' => $fee_items_ids,
					'id_payment_periods' => $id_payment_periods
				]),'saved new package');
		}
		public function saveFeesItem( $title , $costAmount ):array {
			return $this->result( $this->insert('fees_items' ,[
				'title' => $title ,
				'cost' => $costAmount
			]) , 'Saved Fees Items');
		}
		public function postChildToFeesFinancialYear( $id_child , $id_year ):array {

			return $this->result(
				$this->insert('fees_financial_year' ,[
					'id_child' => $id_child ,
					'id_year'=> $id_year
				])
				, 'Posted Child to new Financial year');
		}

		public function  saveFeesPayment( $title , $id_payment_type , $reference_txt , $id_child , $notes , $id_saved_by ):array {
			$res = $this->insert('fee_payment_ledger' ,[
				'title'=> $title ,
				'id_payment_type'=> $id_payment_type ,
				'reference_txt'=> $reference_txt ,
				'id_child'=> $id_child ,
				'notes'=> $notes ,
				'id_user_saved_by'=> $id_saved_by ,
				'date_created'=> self::nowDateTime()
			]) ;


			return $this->result($res , 'Saved Fees Payment');
		}



	}
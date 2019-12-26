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

		public function saveFeesToChild( $package_title , $fee_item_title , $fee_item_amount , $id_posted_child , $id_fee_item , $id_package_fee , $payment_period_title , $id_payment_period , $id_user ):array {
			$res= $this->insert('fees_packages_structure_for_child',[
				'package_title' => $package_title ,
				'fee_item_title' => $fee_item_title ,
				'fee_item_amount' =>$fee_item_amount ,
				'id_posted_child'=> $id_posted_child ,
				'id_fee_item' => $id_fee_item ,
				'id_package_fee' => $id_package_fee ,
				'payment_period_title' => $payment_period_title ,
				'id_payment_period'=>$id_payment_period ,
				'date_created' => self::nowDateTime(),
				'id_user_created' => $id_user
			]);


			return $this->result($res , 'Adding fees to child' );
		}

		public function getPostedChildrenForFinancialYear ( $year = '' ) : array
		{

			if ( !empty( $year ) ) {
				return $this->fetchInArray( "SELECT 
                                                            ffy.id, ffy.id_child, ffy.id_year , 
                                                            fy.year ,
                                                            (SELECT SUM(fee_payment_ledger.amount ) AS sumall FROM fee_payment_ledger WHERE fee_payment_ledger.id_child = ffy.id_child AND fee_payment_ledger.iscredit = 1 AND  SUBSTRING_INDEX(SUBSTRING_INDEX(fee_payment_ledger.date_created, ' ', 1), '-', 1) = '$year' ) AS paidamount ,
                                                            CONCAT(c.surname , ' ' ,c.name) AS childname
													   FROM fees_financial_year ffy 
													        JOIN financial_year fy ON ffy.id_year = fy.id
													        JOIN children c ON  c.id = ffy.id_child
													        WHERE fy.year = '$year' " );
			}
			return $this->fetchInArray( "SELECT 
                                                        ffy.id, ffy.id_child, ffy.id_year , 
                                                        fy.year , 
                                                        (SELECT SUM(fee_payment_ledger.amount ) AS sumall FROM fee_payment_ledger WHERE fee_payment_ledger.id_child = ffy.id_child AND fee_payment_ledger.iscredit = 1  ) AS paidamount ,
                                                        CONCAT(c.surname , ' ' ,c.name) AS childname
												   FROM fees_financial_year ffy 
												        JOIN financial_year fy ON ffy.id_year = fy.id
												        JOIN children c ON  c.id = ffy.id_child" );
		}

		public function getFinancialYears():array {
			return $this->fetchInArray('SELECT * FROM financial_year');
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


		public function editFeesItem($rec_id , $title , $costAmount ):array {
			return $this->result( $this->andUpdate('fees_items' ,[
				'title' => $title ,
				'cost' => $costAmount
			],['id'=>$rec_id]) , 'Saved Fees Items');
		}


		public function saveFeesItem( $title , $costAmount ):array {
			return $this->result( $this->insert('fees_items' ,[
				'title' => $title ,
				'cost' => $costAmount
			]) , 'Saved Fees Items');
		}

		public function getFinancialYear($year):array {
			return $this->fetchAllInArray("SELECT * FROM financial_year WHERE  financial_year.year = '$year' LIMIT 1");
		}
		public function postChildToFeesFinancialYear( $id_child , $id_year ):array {

			return $this->result(
				$this->insert('fees_financial_year' ,[
					'id_child' => $id_child ,
					'id_year'=> $id_year
				])
				, 'Posted Child to new Financial year');
		}
		/**We are saving child's payment related to the child but has no co-reaation to the financial year the child id or child we just save payments for the child and later relate when required
		 *This is subject to change in regard to accounting logic or system .
		 */
		public function  saveFeesPayment( $title , $id_payment_type , $reference_txt , $id_child , $notes , $id_saved_by , $amount ):array {
			$res = $this->insert('journal',[
				'date_created' => self::nowDateTime() ,
				'description' => $reference_txt . '\n Notes:\n' . $notes ,
				'id_user_saved_by' => $id_saved_by ,
				'amount' => $amount
			]);
			if(!$res){
				return $this->result($res , '');
			}
			$lastID = $this->getLastInsertAutoID();

			// here we immediately post the children transaction .

			$res = $this->insert('fee_payment_ledger' ,[
				'title'=> $title ,
				'id_payment_type'=> $id_payment_type ,
				'reference_txt'=> $reference_txt ,
				'id_child'=> $id_child ,
				'notes_description'=> $notes ,
				'amount' => $amount ,
				'id_journal'=> $lastID ,
				'id_user_saved_by'=> $id_saved_by ,
				'date_created'=> self::nowDateTime()
			]) ;


			return $this->result($res , 'Saved & Posted Fees Payment');
		}



	}
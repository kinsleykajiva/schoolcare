<?php

	declare(strict_types=1);

	require_once '../../dbaccess/dbcontrol/DbManager.php';
	class DBChildren
		extends DbManager	{
		private $DBCon;



		public function __construct ( string $USER , string $PASSWORD , string $DATABASE ) {

			$this->DBCon = mysqli_connect ( 'localhost' , $USER , $PASSWORD , $DATABASE );
			parent ::__construct ( $this->DBCon );
		}

		public function saveChild( $name, $surname, $sex, $dob, $notes ):array {

			$res = $this->insert('children',[
				'name' => $name ,
				'surname' => $surname ,
				'sex' => $sex ,
				'date_of_birth' => $dob ,
				'notes' => $notes ,
			]);


			return $this->result($res , 'Saved Child' ,null , ['lastID'=>$this->getLastInsertAutoID()]);
		}



	}
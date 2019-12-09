<?php

	declare(strict_types=1);

	require_once '../../dbaccess/dbcontrol/DbManager.php';
	class DBEmployees	extends DbManager	{
		private $DBCon;

		public function getLastInsertAutoID (): int
		{
			return parent::getLastInsertAutoID();
		}

		public function __construct ( string $USER , string $PASSWORD , string $DATABASE ) {

			$this->DBCon = mysqli_connect ( 'localhost' , $USER , $PASSWORD , $DATABASE );
			parent ::__construct ( $this->DBCon );
		}

		public function saveNewEmployee( $name, $surname, $date_of_birth, $id_number, $id_user_saved, $sex ,$id_job_position  ):array {

			$res = $this->insert('employees',[
				'name' => $name ,
				'surname' => $surname ,
				'date_of_birth' => $date_of_birth ,
				'id_number' => $id_number ,
				'id_user_saved' => $id_user_saved ,
				'date_created' => self::nowDateTime(),
				'sex' => $sex ,
				'id_job_position' =>$id_job_position
			]);
			return $this->result($res , 'Saving Employee');
		}

	}
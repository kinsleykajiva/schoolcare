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

		public function getAllEmployees():array {
			$sql = '
				SELECT (SELECT address FROM addresses WHERE addresses.id_table_index = e.id AND addresses.for_table="employees") AS address ,  (SELECT contacts.contact_number FROM contacts WHERE contacts.id_table_index = e.id AND contacts.for_table="employees") AS phoneContact
     			,  e.id, e. name, e.surname,e.email, e.date_of_birth, e.id_number, e.id_user_saved, e.date_created, e.sex, e.id_job_position ,job_positions.title AS Jobposition
					FROM employees e JOIN job_positions ON job_positions.id = e.id_job_position
					WHERE e.isvisible = 1 AND e.isdeleted = 0
					';

			return $this->fetchInArray($sql);
		}

		public function saveNewEmployee( $name, $surname, $date_of_birth, $id_number, $id_user_saved, $sex ,$id_job_position ,$contact,$address,$email ):array {

			$res = $this->insert('employees',[
				'name' => $name ,
				'surname' => $surname ,
				'date_of_birth' => $date_of_birth ,
				'email'=> $email ,
				'id_number' => $id_number ,
				'id_user_saved' => $id_user_saved ,
				'date_created' => self::nowDateTime(),
				'sex' => $sex ,
				'id_job_position' =>$id_job_position
			],TRUE);
			$last = $this->getLastInsertAutoID();
			$this->insert('contacts',[
				'contact_number'=> $contact , 'for_table'=>'employees' ,'isdefault'=>1 ,'id_table_index'=>$last
			]);
			$this->insert('addresses',[
				'address'=> $address , 'for_table'=>'employees' ,'isdefault'=>1 ,'id_table_index'=>$last
			]);
			return $this->result($res , 'Saving Employee');
		}

	}
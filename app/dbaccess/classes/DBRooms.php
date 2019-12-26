<?php

	declare( strict_types = 1 );

	require_once '../../dbaccess/dbcontrol/DbManager.php';
	class DBRooms
		extends DbManager
	{
		private $DBCon;


		public function __construct ( string $USER , string $PASSWORD , string $DATABASE )
		{


			$this->DBCon = mysqli_connect( 'localhost' , $USER , $PASSWORD , $DATABASE );
			parent::__construct( $this->DBCon );
		}


		public function getRooms():array {
			$sql = "SELECT r.id, r.title, r.id_age_range , CONCAT(ar.start_age_in_months , '-' , ar.end_age_in_months) AS ages FROM `rooms` r JOIN age_ranges ar ON r.id_age_range = ar.id";
			return $this->fetchInArray($sql);
		}

		public function editRoom($rec_id ,  $title , $id_range = 1 ):array {
			$res = $this->andUpdate('rooms',[
				'title'=>$title ,
				'id_age_range'=>$id_range
			],['id'=>$rec_id]);
			return $this->result($res ,'Saved Rooms');
		}

		public function saveNewRoom( $title , $id_range = 1 ):array {
			$res = $this->insert('rooms',[
				'title'=>$title ,
				'id_age_range'=>$id_range
			]);
			return $this->result($res ,'Saved Rooms');
		}

	}
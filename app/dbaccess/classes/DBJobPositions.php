<?php
	declare(strict_types=1);

	require_once '../../dbaccess/dbcontrol/DbManager.php';

	class DBJobPositions  extends DbManager	{
		private $DBCon;
		public function __construct ( string $USER , string $PASSWORD , string $DATABASE ) {

			$this->DBCon = mysqli_connect ( 'localhost' , $USER , $PASSWORD , $DATABASE );
			parent ::__construct ( $this->DBCon );
		}
		public function deletePosition(int $rec_id):array {
			$res = $this->andUpdate('job_positions' , ['isvisible'=>0 , 'isdeleted'=> 1] , ['id'=>$rec_id]);
			return $this->result($res , 'Deleting');
		}

		public function upDatePosition(int $rec_id , string $title , string $description):array {
			$res =  $this->andUpdate('job_positions',[
				'title' => $title , 'description'=> $description
			],['id'=>$rec_id]);
			return $this->result($res , 'Updating Position');
		}
		public function saveNewPosition(string $title , string $description):array {
			$res =  $this->insert('job_positions',[
				'title' => $title , 'description'=> $description
			]);
			return $this->result($res , 'Saving New Position');
		}

		public function getAllPositions():array {
			$sql = 'SELECT * FROM job_positions WHERE  isvisible  = 1 ';
			return $this->fetchInArray($sql);
		}


	}
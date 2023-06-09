<?php

	declare( strict_types = 1 );

	require_once '../../dbaccess/dbcontrol/DbManager.php';

	class DBChildren
		extends DbManager
	{
		private $DBCon;


		public function __construct ( string $USER , string $PASSWORD , string $DATABASE )
		{

			$this->DBCon = mysqli_connect( 'localhost' , $USER , $PASSWORD , $DATABASE );
			parent::__construct( $this->DBCon );
		}

		public function getStatistics():array{
			$res                   = [];
			$res ['child_counter']   = (int) $this->fetchAllInArray('SELECT COUNT(children.id) AS counter FROM children WHERE children.isvisible     = 1 AND children.isdeleted = 0 ;')['counter'];
			$today                   = date('m-d');
			$res ['birthdays_today'] = $this->fetchInArray("SELECT c.id, c.name, c.surname, c.sex, c.date_of_birth FROM children c WHERE c.isvisible = 1 AND c.isdeleted        = 0 AND substring(c.date_of_birth,6) = '$today';");
			$res ['male']            = $this->fetchAllInArray("SELECT COUNT(c.id) AS counter FROM children c WHERE c.isvisible                       = 1 AND c.isdeleted        = 0 AND c.sex = 'male';")['counter'];
			$res ['female']          = $this->fetchAllInArray("SELECT COUNT(c.id) AS counter FROM children c WHERE c.isvisible                       = 1 AND c.isdeleted        = 0 AND c.sex = 'female';")['counter'];

			return $res ;
		}

		public function getAllAttendance():array {
			$sql = "SELECT a.* ,CONCAT(c.name , ' ' , c.surname) AS childName , c.sex    FROM `attendance` a JOIN children c ON c.id = a.id_child  ";

			return $this->fetchInArray($sql);
		}

		public function saveChildAssesment( $id_child , $id_assessment_marker , $id_user_created , $id_milestone_category ):array {
			if($this->countRows('child_assessment',[
				'id_assessment_marker' => $id_assessment_marker ,
				'id_milestone_category' => $id_milestone_category ,
			]) > 0){
				// update
				$res = $this->andUpdate('child_assessment' ,[
					'id_assessment_marker' => $id_assessment_marker ,
				],[
					'id_assessment_marker' => $id_assessment_marker ,
					'id_milestone_category' => $id_milestone_category ,
				]);
			}else{

				$res = $this->insert('child_assessment' ,[
					'id_assessment_marker' => $id_assessment_marker ,
					'id_child' => $id_child ,
					'id_user_created' => $id_user_created ,
					'date_created' => self::nowDateTime() ,
					'id_milestone_category' => $id_milestone_category ,

				]);
			}
			return $this->result($res , 'Saved Assessment');
		}
		public function getAllChildAssesment():array {
			$sql ="SELECT ca.* , cam.id AS  camid,  cam.title AS  camtitle ,
                    CONCAT(c.name , ' ' , c.surname) as childname ,
                    (SELECT CONCAT(employees.surname , ' ' , employees.surname) FROM employees WHERE employees.id = u.id_employee) AS savedby
					FROM child_assessment ca
                    JOIN child_assessment_markers cam ON ca.id_assessment_marker = cam.id
                    JOIN children c ON ca.id_child = c.id
					JOIN users u ON ca.id_user_created = u.id
                    ";

			return $this->fetchInArray($sql);
		}

		public function getAllAssesmentMarkers():array {
			$sql ='SELECT * FROM child_assessment_markers';

			return $this->fetchInArray($sql);
		}


		public function clockOutAttendance($id_record  ,$time_sign_out ):array {
			$res = $this->andUpdate('attendance',[
				'time_sign_out'=> $time_sign_out ,'date_actual_clockout'=>self::nowDateTime()
			],['id'=>$id_record]);
			return $this->result($res , 'Saved Clock Out Attendance');
		}

		public function clockInAttendance($id_user_created , $time_sign_in  , $date_sign_in,$notes,$id_child,$id_room):array {
			if($this->countRows('attendance',[
					'date_sign_in'=> $date_sign_in ,'id_child'=> $id_child ,
				])> 0 ){
				// update the sign in ad
				$res = $this->andUpdate( 'attendance' , [
					'time_sign_in' => $time_sign_in ,'id_room'=>$id_room,
					'notes' => $notes
				] ,['date_sign_in'=> $date_sign_in ,'id_child'=> $id_child] );
			}else {
				// this is a new date and or diff user
				$res = $this->insert( 'attendance' , [
					'date_created' => self::nowDateTime() ,
					'date_actual_clockout'=>'--',
					'id_user_created' => $id_user_created ,
					'time_sign_in' => $time_sign_in ,
					'time_sign_out' => '--' ,
					'date_sign_in' => $date_sign_in ,
					'notes' => $notes ,
					'id_room'=> $id_room ,
					'id_staff' => 0 ,
					'id_child' => $id_child
				] );
			}
			return $this->result($res , 'Saved Clock In Attendance');
		}

		public function deleteRecord ( $record_id ) : array
		{
			$res = $this->setDeleteSafely( 'children' , (int)$record_id );

			return $this->result( $res , 'Deleted child' );
		}

		public function getChild ( $record_id ) : array
		{
			$sql = "SELECT c.id, c.name, c.surname, c.sex, c.date_of_birth,c. notes , pci.id_parent,
					       (SELECT CONCAT(child_parents.name , ' '  , child_parents.surname) FROM child_parents WHERE child_parents.id = pci.id_parent) AS parent,
					(SELECT addresses.address FROM addresses WHERE addresses.for_table = 'child_parents' AND addresses.id_table_index = pci.id_parent ) AS address,
					(SELECT contacts.contact_number FROM contacts WHERE contacts.for_table = 'child_parents' AND contacts.id_table_index = pci.id_parent ) AS contact,
					       child_parents.email , child_parents.id_number , child_parents.occupation , child_parents.sex
					FROM  children c
					JOIN parent_child_intermediary pci ON c.id = pci.id_child
					JOIN child_parents ON  pci.id_parent = child_parents.id WHERE c.id = $record_id ";

			return $this->fetchInArray( $sql );
		}

		public function getAllChildren () : array
		{
			$sql = "SELECT c.id, c.name, c.surname, c.sex, c.date_of_birth,c. notes  FROM  children c WHERE c.isvisible = 1 AND c.isdeleted = 0 ";

			return $this->fetchInArray( $sql );
		}

		public function updateChild ( $record_id , $name , $surname , $sex , $dob , $notes ) : array
		{

			$res = $this->andUpdate( 'children' , [
				'name' => $name ,
				'surname' => $surname ,
				'sex' => $sex ,
				'date_of_birth' => $dob ,
				'notes' => $notes ,
			] , [ 'id' => $record_id ] );


			return $this->result( $res , 'Updated Child Details' , null , [ 'lastID' => $this->getLastInsertAutoID() ] );
		}

		public function saveChild ( $name , $surname , $sex , $dob , $notes ) : array
		{

			$res = $this->insert( 'children' , [
				'name' => $name ,
				'surname' => $surname ,
				'sex' => $sex ,
				'date_of_birth' => $dob ,
				'notes' => $notes ,
			] );


			return $this->result( $res , 'Saved Child' , null , [ 'lastID' => $this->getLastInsertAutoID() ] );
		}


	}

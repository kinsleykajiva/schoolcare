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
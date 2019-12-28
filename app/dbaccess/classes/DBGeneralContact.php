<?php

	declare( strict_types = 1 );

	require_once '../../dbaccess/dbcontrol/DbManager.php';

	class DBGeneralContact
		extends DbManager
	{
		private $DBCon;


		public function __construct ( string $USER , string $PASSWORD , string $DATABASE )
		{

			$this->DBCon = mysqli_connect( 'localhost' , $USER , $PASSWORD , $DATABASE );
			parent::__construct( $this->DBCon );
		}
//  id, Name, Surname, Organisation,  Date Created, id_user_created, Email ,contacts,address ,Employee Full Name
		public function getContactsExport () : array
		{
			$res = "SELECT 
                    IF(gc.name = 'NULL' ,'',gc.name ) AS name_, 
                    IF(gc.surname = 'NULL' ,'',gc.surname ) AS surname_, 
                    IF(gc.organisation = 'NULL' ,'',gc.organisation ) AS organisation, 
                    gc.date_created,  gc.email ,
                    (SELECT (contacts.contact_number ) FROM contacts WHERE contacts.id_table_index = gc.id AND contacts.for_table = 'general_contacts') AS contacts ,
                    (SELECT (addresses.address ) FROM addresses WHERE addresses.id_table_index = gc.id AND addresses.for_table = 'general_contacts') AS address ,
					CONCAT(e.name , ' ' , e.surname) AS employee_fullname
					FROM general_contacts gc
					JOIN users u ON gc.id_user_created = u.id
					JOIN employees e ON e.id = u.id_employee
					WHERE gc.isvisible = 1 AND gc.isdeleted = 0
					";

			return $this->fetchInArray( $res );
		}public function getContacts () : array
		{
			$res = "SELECT gc.id, gc.name, gc.surname, gc.organisation,  gc.date_created, gc.id_user_created, gc.email ,
                    (SELECT (contacts.contact_number ) FROM contacts WHERE contacts.id_table_index = gc.id AND contacts.for_table = 'general_contacts') AS contacts ,
                    (SELECT (addresses.address ) FROM addresses WHERE addresses.id_table_index = gc.id AND addresses.for_table = 'general_contacts') AS address ,
					CONCAT(e.name , ' ' , e.surname) AS employee_fullname
					FROM general_contacts gc
					JOIN users u ON gc.id_user_created = u.id
					JOIN employees e ON e.id = u.id_employee
					WHERE gc.isvisible = 1 AND gc.isdeleted = 0
					";

			return $this->fetchInArray( $res );
		}

		public function deleteContact ( $rec_id ) : array
		{
			$res = $this->rawQuery("DELETE FROM general_contacts WHERE id = '$rec_id' ");
			if($res){
				 $this->rawQuery("DELETE FROM contacts WHERE id_table_index  = '$rec_id' AND for_table = 'general_contacts' " );
				 $this->rawQuery("DELETE FROM addresses WHERE id_table_index  = '$rec_id' AND for_table = 'general_contacts' ");
			}

			return $this->result( $res , 'Deleted Contact' );

		}
		public function updateContact ( $rec_id , $name , $surname , $org , $email , $number , $address ) : array
		{
			$name = empty( $name ) ? 'NULL' : $name;
			$surname = empty( $surname ) ? 'NULL' : $surname;
			$org = empty( $org ) ? 'NULL' : $org;
			$res = $this->andUpdate( 'general_contacts' , [
				'name' => $name ,
				'surname' => $surname ,
				'organisation' => $org ,
				'email' => $email ,
			] , [ 'id' => $rec_id ] );
			$this->andUpdate( 'contacts' , [
				'contact_number' => $number

			] , [ 'for_table' => 'general_contacts' , 'id_table_index' => $rec_id ] );

			$this->andUpdate( 'addresses' , [
							'address' => $address

						] , [ 'for_table' => 'general_contacts' , 'id_table_index' => $rec_id ] );


			return $this->result( $res , 'Saved New Contact' );

		}

		public function saveContact ( $name , $surname , $org , $email , $number , $id_user ,$address) : array
		{
			$name = empty( $name ) ? 'NULL' : $name;
			$surname = empty( $surname ) ? 'NULL' : $surname;
			$org = empty( $org ) ? 'NULL' : $org;
			$res = $this->insert( 'general_contacts' , [
				'name' => $name ,
				'surname' => $surname ,
				'organisation' => $org ,
				'date_created' => self::nowDateTime(),
				'email' => $email ,
				'id_user_created' => $id_user
			] );
			$lastID = $this->getLastInsertAutoID();

			$this->insert( 'addresses' , [
				'address' => $address ,
				'for_table' => 'general_contacts' ,
				'id_table_index' => $lastID
			] );

			$this->insert( 'contacts' , [
				'contact_number' => $number ,
				'for_table' => 'general_contacts' ,
				'id_table_index' => $lastID
			] );


			return $this->result( $res , 'Saved New Contact' );
		}

	}
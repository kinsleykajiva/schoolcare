<?php
	declare(strict_types=1);

	require_once '../../dbaccess/dbcontrol/DbManager.php';

	class DBChildParents
		extends DbManager	{
		private $DBCon;



		public function __construct ( string $USER , string $PASSWORD , string $DATABASE ) {

			$this->DBCon = mysqli_connect ( 'localhost' , $USER , $PASSWORD , $DATABASE );
			parent ::__construct ( $this->DBCon );
		}



		public function deleteRecord($record_id):array {
			$res = $this->setDeleteSafely('child_parents',(int) $record_id);

			return $this->result($res  , 'Deleted parent');
		}

		public function updateParent ( $id_record, $name, $surname, $id_number, $sex, $occupation, $email, $address ): array
		{
			$res = $this->andUpdate( 'child_parents', [
				'name' => $name,
				'surname' => $surname,
				'id_number' => $id_number,
				'sex' => $sex,
				'email' => $email,
				'occupation' => $occupation
			], [ 'id' => $id_record ] );
			$this->andUpdate( 'addresses', [
				'address' => $address,
			], [ 'for_table' => 'child_parents',
				'id_table_index' => $id_record ] );
			$this->andUpdate( 'contacts', [
				'contact_number' => $address,
			], [ 'for_table' => 'child_parents',
				'id_table_index' => $id_record ] );

			return $this->result( $res, 'Updated Parents' );
		}

		public function saveParent( $name, $surname, $id_number, $sex, $occupation, $id_user_created, $phoneNumber,$email,$address ):array {
			$res = $this->insert('child_parents',[
				'name' =>$name ,
				'surname'=>$surname ,
				'id_number'=>$id_number ,
				'sex'=>$sex ,
				'email'=>$email ,
				'date_created'=>self::nowDateTime() ,
				'occupation'=>$occupation ,
				'id_user_created'=>$id_user_created ,

			]);
			$lastID = $this->getLastInsertAutoID();
			if($res) {
				$this->insert( 'addresses', [
					'address' => $address,
					'for_table' => 'child_parents',
					'id_table_index' => $lastID
				] );
				$this->insert( 'contacts', [
					'contact_number' => $phoneNumber,
					'for_table' => 'child_parents',
					'id_table_index' => $lastID
				] );
			}

			return $this->result($res , 'Saved Parent' , null ,['lastID'=>$lastID] );
		}
		/**this is to connect the parents to the children at any point the child is connected to many parents  */
		public function saveParentChildConnection($id_parent , $id_child):array {
			$res = $this->insert('parent_child_intermediary' , [
				'id_parent' =>$id_parent ,
				'id_child' =>$id_child ,
			]);
			return $this->result($res , 'Saved Parent Child Connection');
		}


	}
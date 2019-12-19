<?php

	declare( strict_types = 1 );

	require_once '../../dbaccess/dbcontrol/DbManager.php';

	class DBLessonsAll
		extends DbManager
	{
		private $DBCon;


		public function __construct ( string $USER , string $PASSWORD , string $DATABASE )
		{

			$this->DBCon = mysqli_connect( 'localhost' , $USER , $PASSWORD , $DATABASE );
			parent::__construct( $this->DBCon );
		}

		public function getMileStonesArr ( array $ids ) : array
		{
			$arr = [];
			foreach ( $ids as $id ) {
				$sql = 'SELECT m.id, m.title, m.description, m.id_milestone_category ,mc.title AS mileCat  FROM milestones m JOIN milestone_category mc ON m.id_milestone_category = mc.id WHERE  m.id = ' . $id;

				$arr [] = $this->fetchInArray( $sql )[ 0 ];
			}
			return ( $arr );
		}

		public function getAllClasses () : array
		{
			$sql = "SELECT cc.* , l.title AS ltitle, (SELECT lessons_category.title FROM lessons_category WHERE lessons_category.id = l.id_lesson_category) AS lesson_category, l.description AS ldescr, id_age_ranges, mile_stones FROM
		             children_classes cc JOIN lessons l ON cc.id_lesson = l.id
					WHERE cc.isvisible = 1";

			return $this->fetchInArray( $sql );
		}

		public function saveClassLesson ( $id_lesson , $date_on_date , $id_user_saved_by , $rooms_ids ) : array
		{
			$res = $this->insert( 'children_classes' , [
				'id_lesson' => $id_lesson ,
				'date_on_date' => $date_on_date ,
				'id_user_saved_by' => $id_user_saved_by ,
				'rooms_ids' => $rooms_ids ,
				'date_created' => self::nowDateTime()
			] );


			return $this->result( $res , 'Added Lesson to class' );
		}

		public function getMileStones () : array
		{
			$sql = 'SELECT m.id, m.title, m.description, m.id_milestone_category AS milestonecatid, mc.title AS categorytitle  FROM milestones m 
					JOIN milestone_category mc ON m.id_milestone_category = mc.id
					WHERE m.isvisible = 1 ';

			return $this->fetchInArray( $sql );
		}

		public function getlessonsCategory () : array
		{
			$sql = 'SELECT * FROM lessons_category';
			return $this->fetchInArray( $sql );
		}

		public function deleteClass ( int $id ) : array
		{
			$res = $this->setDeleteSafely( 'children_classes' , $id );
			return $this->result( $res , 'Deleted A Lesson' );
		}

		public function getAllLessons () : array
		{
			$sql = 'SELECT l.id, l.title, l.id_lesson_category AS lesscatid, lc.title AS lesscate, l.description , l.mile_stones ,
                    concat(a.start_age_in_months , "-",a.end_age_in_months) AS age_range
					FROM lessons l 
					    JOIN age_ranges a ON a.id = l.id_age_ranges
					JOIN lessons_category lc ON l.id_lesson_category = lc.id';
			return $this->fetchInArray( $sql );
		}

		public function saveNewLesson ( $title , $id_lesson_category , $description , $id_age_ranges , $mile_stones ) : array
		{
			$res = $this->insert( 'lessons' , [
				'title' => $title ,
				'id_lesson_category' => $id_lesson_category ,
				'description' => empty( $description ) ? 'NULL' : $description ,
				'id_age_ranges' => $id_age_ranges ,
				'mile_stones' => empty( $mile_stones ) ? 'NULL' : $mile_stones ,

			] );

			return $this->result( $res , 'Saved New Lessen' );
		}

	}
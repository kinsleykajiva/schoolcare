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

		public function getMileStones ():array {
			$sql = 'SELECT m.id, m.title, m.description, m.id_milestone_category AS mileStoneCatID, mc.title AS categoryTitle  FROM milestones m 
					JOIN milestone_category mc ON m.id_milestone_category = mc.id
					WHERE m.isvisible = 1 ';

			return $this->fetchInArray($sql);
		}
		public function getlessonsCategory():array {
			$sql = 'SELECT * FROM lessons_category';
			return $this->fetchInArray($sql);
		}

		public function getAllLessons():array {
			$sql = 'SELECT l.id, l.title, l.id_lesson_category AS lessCatID, lc.title AS lessCate, l.description , l.mile_stones ,
                    concat(a.start_age_in_months , "-",a.end_age_in_months) AS age_range
					FROM lessons l 
					    JOIN age_ranges a ON a.id = l.id_age_ranges
					JOIN lessons_category lc ON l.id_lesson_category = lc.id';
			return $this->fetchInArray($sql);
		}

		public function saveNewLesson( $title ,$id_lesson_category ,$description , $id_age_ranges  , $mile_stones ):array {
			$res= $this->insert('lessons' ,[
				'title' => $title ,
				'id_lesson_category' => $id_lesson_category ,
				'description' => empty($description)? 'NULL':$description ,
				'id_age_ranges' => $id_age_ranges ,
				'mile_stones' => empty($mile_stones)? 'NULL':$mile_stones ,

			]);

			return $this->result($res , 'Saved New Lessen' );
		}

	}
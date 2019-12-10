<?php


	class FileAccess
	{
	private static  $allowed  = [ 'mp4' ,'psd' ,'svg' ,'pps' ,'ppt','wpd' ,'pptx' ,'wks' ,'tif' ,'tiff' ,'ico', 'png','jpeg' , 'jpg' , 'pdf' , 'txt' ,'xlr' , 'docx' , 'doc' ,'xls' , 'xlsx','json' , 'java'  ,'mp3' ,
	'aif','wav' , 'wma' ,'ogg' ,'7z' ,'rar','tar.gz','tar','z','zip' ,'iso','csv' ,'dat' ,'sql','xml','apk','exe' ,'jar','flv' ,'h264' ,'mkv' ,'mov','vob' ,'wmv'];
		public static function uploadSingleFiles ( string $fildFolder , string $isset_name = 'file' ): string
		{

			if ( ! file_exists ( $fildFolder ) ) {
				if ( ! mkdir ( $concurrentDirectory = $fildFolder , 0777,true ) && ! is_dir ( $concurrentDirectory ) ) {
					throw new RuntimeException( sprintf ( 'Directory "%s" was not created' , $concurrentDirectory ) );
				}

			}
				$name =  $_FILES[ $isset_name ]['name'];

				if ( $_FILES[ $isset_name ][ 'error' ] === 0 ) {
					$temp = $_FILES[ $isset_name ][ 'tmp_name' ];
					$ext = explode( '.', $name );
					$ext = strtolower( end( $ext ) );
					$name = str_replace( array( "#", "?", "/" ), '_', $name );
					$name = str_replace( array( ' ', '-', "'" ), array( '_', '_', '' ), $name );
					$filePath = $fildFolder . $name;
					if ( in_array( $ext, self::$allowed ) === TRUE && move_uploaded_file( $temp, $filePath ) === TRUE ) {
						return 'done';

					}

					return 'fail';
				}
		}
		/**
		 * @param string $isset_name
		 * @param string $fildFolder
		 * @param array $allowed
		 * @param array $succeeded
		 * @param array $failed
		 * @return array
		 */
		public static function uploadMultipleFiles ( string $fildFolder , string $isset_name = 'file' ): array
		{
			$succeeded = $failed = [] ;
			if ( ! file_exists ( $fildFolder ) ) {
				if ( ! mkdir ( $concurrentDirectory = $fildFolder , 0777,true ) && ! is_dir ( $concurrentDirectory ) ) {
					throw new RuntimeException( sprintf ( 'Directory "%s" was not created' , $concurrentDirectory ) );
				}

			}
			foreach ( $_FILES[ $isset_name ][ 'name' ] as $key => $name ) {
				if ( $_FILES[ $isset_name ][ 'error' ][ $key ] === 0 ) {
					$temp = $_FILES[ $isset_name ][ 'tmp_name' ][ $key ];
					$ext = explode( '.', $name );
					$ext = strtolower( end( $ext ) );
					$file = $temp . '.' . $ext;
					$name = str_replace( array( "#", "?", "/" ), '_', $name );
					$name = str_replace( array( ' ', '-', "'" ), array( '_', '_', '' ), $name );
					$filePath = $fildFolder . $name;
					if ( in_array( $ext, self::$allowed ) === TRUE && move_uploaded_file( $temp, $filePath ) === TRUE ) {

						$succeeded[] = array(
							'name' => $name,
							'file' => $file,
							'path' => $fildFolder,
						);

					} else {
						$failed[] = array(
							'name' => $name,
							'reason' => 'Error occurred '
						);
					}
				}
			}
			return array( $ext, $succeeded, $failed );
		}
	}
<?php


	class DBLoggingService {

		CONST LOG_FOLDER = "../../../storage/logs/";
		CONST LOG_FILE = self::LOG_FOLDER . "logger.log";

		public static function logInfo ( string $statement , string $functionName = "" )
		: void {
			if ( empty( trim ( $statement ) ) ) {
				return;
			}
			$functionName = empty( $functionName ) ? PHP_EOL : '  function:' . $functionName . PHP_EOL;
			$statement    = "[ log.Info ]" . $functionName . " " . $statement . " ";
			self ::log ( $statement . PHP_EOL );
		}


		private static function log ( string $string )
		: void {
			if ( ! file_exists ( self::LOG_FOLDER ) ) {
				if ( ! mkdir ( $concurrentDirectory = self::LOG_FOLDER , 0777 ) && ! is_dir ( $concurrentDirectory ) ) {
					throw new RuntimeException( sprintf ( 'Directory "%s" was not created' , $concurrentDirectory ) );
				}
			}
			if ( ! file_exists ( self::LOG_FILE ) ) {
				touch ( self::LOG_FILE );
				chmod ( self::LOG_FILE , 0777 );
				$f = fopen ( self::LOG_FILE , 'w+' );
				fclose ( $f );
			}

			$string = "(" . date ( 'Y-m-d H:i:s' ) . " ) " . $string;
			$style  = strlen ( $string );
			$isEven = $style % 2 == 0;
			$line   = '';
			/**This is to make the last line ---||-- */
			for ( $i = 0 ; $i < ( $style * .8 ) ; $i ++ ) {
				if ( $isEven ) {
					/** @var int $style */
					$line = $i == floor ( $style * .3 ) ? $line . '||' : $line . '-';
				}
				else {
					$line = ( $i + 1 ) == floor ( $style * .3 ) ? $line . '||' : $line . '-';
				}

			}
			$string  = $string . $line . PHP_EOL;
			$handler = fopen ( self::LOG_FILE , 'a' );
			fwrite ( $handler , $string );
			fclose ( $handler );

		}

	}
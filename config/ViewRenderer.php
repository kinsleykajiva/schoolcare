<?php

	include 'LoadModulesResources.php';

	class ViewRenderer
	{
		
		/**this will enable a check on resource files , but this will slow down the framework is set to True*/
		private $hasStrictFileCheck = FALSE;
		private $Resources = null;
		/**@var string */
		private $ROUTE_TITLE = '';
		private $MODULE_FILES = [];

		public function __construct ( string $route, array $USER_MODULES, array $SYSTEM_MAIN_NAV,array $SYSTEM_PARENT_NAV, bool $checkResourceFile = TRUE )
		{
			try {

				$route = trim( $route );

				$this->ROUTE_TITLE = $route;
				$this->hasStrictFileCheck = $checkResourceFile;

				$this->Resources = new LoadModulesResources();

				$this->Resources->USER_MODULES = $USER_MODULES;
				$this->Resources->SYSTEM_MAIN_NAV = $SYSTEM_MAIN_NAV;
				$this->Resources->SYSTEM_PARENT_NAV = $SYSTEM_PARENT_NAV;


				$this->MODULE_FILES = $this->Resources->getFocusViewResources( $route );
				//print_r($this->MODULE_FILES );exit;
			} catch ( Exception $e ) {
			}

		}


		public function renderRenderLeftNavigationBar (): string
		{

			return $this->Resources->buildSideBarNavigationBar( $this->ROUTE_TITLE );

		}






		public function pageTitle (): string
		{
			return ucwords( $this->ROUTE_TITLE ) . ' ';
		}

		/**
		 * @throws Exception
		 */
		public function setModuleCotentFile (): void
		{

			require_once $this->loadModuleFile();

		}

		/**
		 * @return string
		 * @throws Exception
		 */
		private function loadModuleFile (): string
		{

			if ( !file_exists( $this->Resources->getModuleFile() ) ) {
				throw new \RuntimeException( 'Failed to load Module File ' . $this->Resources->getModuleFile() );
			}

			return $this->Resources->getModuleFile();
		}

		public function loadModuleCSS (): void
		{

			/** @var array $this */
			//print_r($this->MODULE_FILES);exit;
			$cssFiles = $this->MODULE_FILES[ 'css' ];

			try {
				$this->printFileRefs( $cssFiles, TRUE );

			} catch ( Exception $e ) {
				$e->getMessage();
			}
		}

		/**
		 * @param array $srcArr
		 * @param bool $isCSS
		 *
		 * @throws Exception
		 */
		private function printFileRefs ( array $srcArr, bool $isCSS ): void
		{

			if ( !empty( $srcArr ) ) {
				foreach ( $srcArr as $file ) {
					$extraWrite = '';
					if ( strpos( $file, '|' ) !== FALSE ) {
						$tempArr = explode( '|', $file );
						$file = $tempArr [ 0 ];
						$extraWrite = $tempArr [ 1 ];
					}
					if ( $this->hasStrictFileCheck ) {
						if ( !file_exists( $file ) && ( strpos( $file, 'http' ) !== 0 ) ) {
							throw new Exception( "Resource File <{$file}> not Found !" );
						}
					}
					echo $isCSS ? "<link rel='stylesheet' type='text/css' href='{$file}'  {$extraWrite}>" : "<script type='text/javascript' {$extraWrite} src='{$file}'></script>";
					echo "\n";
				}
			}
		}

		public function loadModuleJSS (): void
		{

			/** @var array $this */
			$cssJS = $this->MODULE_FILES[ 'js' ];
			try {
				$this->printFileRefs( $cssJS, FALSE );


			} catch ( Exception $e ) {
				$e->getMessage();
			}
		}



	}
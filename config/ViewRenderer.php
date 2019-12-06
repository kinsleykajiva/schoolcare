<?php

	include 'LoadModulesResources.php';

	class ViewRenderer
	{
		/** @var array */
		private $frameWorkResources = NULL;
		/**this will enable a check on resource files , but this will slow down the framework is set to True*/
		private $hasStrictFileCheck = FALSE;
		private $Resources = null;
		/**@var string */
		private $ROUTE_TITLE;

		public function __construct ( string $route, array $USER_MODULES, array $SYSTEM_MAIN_NAV, bool $checkResourceFile = TRUE )
		{
			$route = trim( $route );
			$this->hasStrictFileCheck = $checkResourceFile;

			$this->Resources = new LoadModulesResources();

			$this->Resources->USER_MODULES = $USER_MODULES;
			$this->Resources->SYSTEM_MAIN_NAV = $SYSTEM_MAIN_NAV;

		}

		/**This will build the view page thus is the mainview  to which it will host the module
		 *This could be viewed as useless
		 *
		 * @param string $default_view
		 *
		 * @throws Exception
		 */
		private function buildFocusPageView ( string $default_view = "render" ): void
		{
			if ( !empty( $this->modulesLoaderObject ) ) {
				$this->frameWorkResources = $this->modulesLoaderObject->getFocusViewResources( $default_view );
				$this->buildNavigationBar();
			} else {
				throw new \RuntimeException( 'Failed to Build View' );
			}
		}

		private function buildModulePage ( string $route ): void
		{

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
				throw new Exception( "Failed to load Module File " . $this->Resources->getModuleFile() );
			}

			return $this->Resources->getModuleFile();
		}

		public function loadModuleCSS (): void
		{

			/** @var array $this */
			$cssFiles = $this->moduleResources->css;
			try {
				$this->printFileRefs( $cssFiles, TRUE );
				if ( $this->SettingsAccessControl !== NULL ):
					foreach ( $this->SettingsAccessControl->getModules() as $moduleData ):
						$this->printFileRefs( $moduleData->css, TRUE );
					endforeach;
				endif;
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
					echo $isCSS ? "<link href='{$file}' rel='stylesheet' {$extraWrite} >" : "<script {$extraWrite} src='{$file}'></script> ";
					echo "  \r\n  ";
				}
			}
		}

		public function loadModuleJSS (): void
		{

			/** @var array $this */
			$cssJS = $this->moduleResources->js;
			try {
				$this->printFileRefs( $cssJS, FALSE );

				if ( $this->SettingsAccessControl !== NULL ):
					foreach ( $this->SettingsAccessControl->getModules() as $moduleData ):
						$this->printFileRefs( $moduleData->js, FALSE );
					endforeach;
				endif;
			} catch ( Exception $e ) {
				$e->getMessage();
			}
		}

		/**Loads the css for the main page*
		 *
		 * @throws Exception
		 */
		public function loadFocusPageCSS (): void
		{
			$cssFiles = $this->frameWorkResources[ 'css' ];
			$this->printFileRefs( $cssFiles, TRUE );
		}

		/**Loads the js for the main page*
		 *
		 * @throws Exception
		 */
		public function loadFocusPageJS (): void
		{
			$jsFiles = $this->frameWorkResources[ 'js' ];
			$this->printFileRefs( $jsFiles, FALSE );
		}

		private function buildNavigationBar ()
		{

		}

	}
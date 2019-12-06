<?php
	declare(strict_types=1);

	class LoadModulesResources
	{

		private $module_def_file = "res/module-definations.json";
		private $Jmodule_def_file = [];
		private $modules_file = "res/modules.json";
		private $Jmodules_file = [];
		public $USER_MODULES = [];
		public $SYSTEM_PARENT_NAV = [];
		public $SYSTEM_MAIN_NAV = [];
		private $FilePath = "";

		public function __construct ()
		{

		}

		public function loadFiles ()
		{
			$this->Jmodule_def_file = json_decode( file_get_contents( $this->module_def_file, TRUE ), TRUE, 512, JSON_THROW_ON_ERROR );
			$this->Jmodules_file = json_decode( file_get_contents( $this->modules_file, TRUE ), TRUE, 512, JSON_THROW_ON_ERROR );
		}

		public function getModuleFile (): string
		{

			return $this->FilePath;
		}

		public function buildNavigations ( string $userAccessModules ): void
		{
			$userAccess = explode( ',', $userAccessModules );
			$userAccess = array_map( static function ( $value ) {
				return (float)$value;
			}, $userAccess );

			$hasAccessModules = [];
			$NAV = [];
			foreach ( $this->Jmodule_def_file as $item ) {

				foreach ( $item[ 'has' ] as $idItem ) {

					if ( in_array( $idItem, $userAccess, TRUE ) ) {
						$this->SYSTEM_PARENT_NAV[] = [ 'title' => $item[ 'name' ], 'id' => $item[ 'id' ] ];
						foreach ($item['sub-modules'] as $module){

							foreach ($this -> Jmodules_file  as  $itemModule){

								if($module['id'] === $itemModule['id'] ){
									$hasAccessModules[] = 	$itemModule;
									$NAV [] = [ 'title'  => $itemModule['name'] , 'link'=> $itemModule['route']];

								}

							}
						}
						//
					}
				}
			}
			$this->SYSTEM_MAIN_NAV = $NAV;
			$this->USER_MODULES = $hasAccessModules;

		}

		/**
		 * @param string $focus_view
		 *
		 * @return array
		 * @throws Exception
		 */
		public function getFocusViewResources ( string $focus_view ): array
		{
			$retVal = array();
			$focusViewsArr = $this->JResObject->main_pages;
			$availablePages = $this->JResObject->main_pages_available;
			if ( !in_array( $focus_view, $availablePages ) ) {

				throw new Exception( "Module Not Registered " );
			}

			foreach ( $focusViewsArr as $views ) {

				if ( ( $views->name ) == $focus_view ) {
					return array(
						'css' => $views->css,
						'js' => $views->js,
					);
				}
			}

			return $retVal;
		}


		/**
		 * This will get the files data required for the module to be loaded .
		 * Note: we said module not modules
		 * Also from this function we get the module ID as well this may bound to change later on in  a different code updates of the framework .
		 *
		 * @param int $moduleID
		 * @param string $route
		 *
		 * @return array
		 */
		public function getModuleResources ( int $moduleID = -10, string $route = "" ): array
		{
			$retVal = array();
			$schemaViewsArr = $this->JResObject->modules_schema;
			if ( $moduleID > 0 ) {
				foreach ( $schemaViewsArr as $view ) {
					if ( $view->id == $moduleID ) {
						$this->FilePath = $view->file_path;
						$this->ModuleID = $view->id;
						return [ $view->resources ];
					}
				}
			} else {
				foreach ( $schemaViewsArr as $view ) {
					if ( $view->route == $route ) {
						$this->FilePath = $view->file_path;
						$this->ModuleID = $view->id;
						return [ $view->resources ];
					}
				}
			}


			return $retVal;
		}

		public function getNavigationAccess ( array $userAccessIDs ): void
		{

			$this->userNavAccess = $this->JNavObject[ 'navigators' ][ 0 ];
			$saveArr = [];

			foreach ( $userAccessIDs as $accessIDs ) {
				if ( isset( $this->userNavAccess{$accessIDs} ) ) {
					$saveArr[] = $this->userNavAccess{$accessIDs};
				}
			}
			$this->userNavAccess = groupBy( 'parent', $saveArr );


		}

	}
	/*$obj= new LoadModulesResources();
	$obj->buildNavigations();
	print_r($obj->SYSTEM_PARENT_NAV);*/
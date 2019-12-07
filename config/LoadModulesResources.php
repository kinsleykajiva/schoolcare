<?php
	declare( strict_types=1 );

	class LoadModulesResources
	{

		private $module_def_file = "res/module-definations.json";
		private $Jmodule_def_file = [];
		private $modules_file = "res/modules.json";
		private $Jmodules_file = [];
		public $USER_MODULES = [];
		public $SYSTEM_PARENT_NAV = [];
		public $SYSTEM_MAIN_NAV = [];
		public $NAVIGATION_BAR = [];
		private $FilePath = "";

		private function array_to_obj ( $array, &$obj )
		{
			foreach ( $array as $key => $value ) {
				if ( is_array( $value ) ) {
					$obj->$key = new stdClass();
					$this->array_to_obj( $value, $obj->$key );
				} else {
					$obj->$key = $value;
				}
			}
			return $obj;
		}

		private function arrayToObject ( $array )
		{
			$object = new stdClass();
			return $this->array_to_obj( $array, $object );
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
			$userAccessParent = array_map( static function ( $value ) {
				return (int)explode( '.', $value )[ 0 ];
			}, $userAccess );

			$userAccess = array_map( static function ( $value ) {
				return (float)$value;
			}, $userAccess );

			$hasAccessModules = [];
			$NAV = [];
			foreach ( $this->Jmodule_def_file as $item ) {
				if ( isset( $this->SYSTEM_PARENT_NAV[ 'id' ] ) ) {
					if ( ( $this->SYSTEM_PARENT_NAV[ 'id' ] !== $item[ 'id' ] ) ) {
						$this->SYSTEM_PARENT_NAV[] = [ 'title' => $item[ 'name' ], 'id' => $item[ 'id' ] ];
					}
				} else {
					$this->SYSTEM_PARENT_NAV[] = [ 'title' => $item[ 'name' ], 'id' => $item[ 'id' ] ];
				}

			}

			foreach ( $this->Jmodule_def_file as $item ) {

				foreach ( $item[ 'has' ] as $idItem ) {

					if ( in_array( $idItem, $userAccess, TRUE ) ) {


						foreach ( $item[ 'sub-modules' ] as $module ) {

							foreach ( $this->Jmodules_file as $itemModule ) {

								if ( $module[ 'id' ] === $itemModule[ 'id' ] ) {
									$hasAccessModules[] = $itemModule;
									$NAV [] = [ 'title' => $itemModule[ 'name' ], 'link' => $itemModule[ 'route' ] ];

								}

							}
						}
						//
					}
				}
			}
			$this->SYSTEM_MAIN_NAV = $NAV;
			//$this->USER_MODULES = ($hasAccessModules);
			$this->USER_MODULES = $this->unique_multidim_array( $hasAccessModules, 'id' );
			//$this->USER_MODULES = array_unique(array_merge( $hasAccessModules , $this->USER_MODULES ));
			$this->buildNavigation();
		}

		private function unique_multidim_array ( $array, $key )
		{
			$temp_array = array();
			$i = 0;
			$key_array = array();

			foreach ( $array as $val ) {
				if ( !in_array( $val[ $key ], $key_array ) ) {
					$key_array[ $i ] = $val[ $key ];
					$temp_array[ $i ] = $val;
				}
				$i++;
			}
			return $temp_array;
		}

		private function buildNavigation (): void
		{
			$parentMenuTitle = '<ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">';
			$linkArr = [];
			$link = '';
			foreach ( $this->SYSTEM_PARENT_NAV as $parent ) {
				$parent_id = (int)$parent[ 'id' ];
				$parentMenuTitle .= '<li><a data-toggle="tab" href="#head_' . $parent_id . '"><i class="notika-icon notika-mail"></i> ' . $parent[ 'title' ] . '</a></li>';
				$link .= '<div id="head_' . $parent_id . '" class="tab-pane in notika-tab-menu-bg animated flipInX">
					<ul class="notika-main-menu-dropdown">';

				foreach ( $this->USER_MODULES as $MODULE ) {
					$parentOfID = (int)explode( '.', (string)$MODULE[ 'id' ] )[ 0 ];
					if ( $parent_id === $parentOfID ) {
						$link .= '<li><a href="render-' . $MODULE[ 'route' ] . '">' . $MODULE[ 'route' ] . '</a></li>';
					}
				}
				$link .= '</ul> </div>';

				//$linkArr[$parent_id] = $link ;

			}
			$parentMenuTitle .= '</ul>';
			//print_r($linkArr) ;
			$this->NAVIGATION_BAR = [ 'parent' => $parentMenuTitle, 'links' => $link ];

		}

		/**
		 * @param string $focus_view
		 *
		 * @return array
		 * @throws Exception
		 */
		public function getFocusViewResources ( string $route ): array
		{

			$retVal = array();
			$focusViewsArr = $this->USER_MODULES;


			foreach ( $focusViewsArr as $views ) {

				if ( ( $views[ 'route' ] ) === $route ) {
					$this->FilePath = $views[ 'file_path' ];
					return array(
						'css' => $views[ 'resources' ][ 'css' ],
						'js' => $views[ 'resources' ][ 'js' ],
					);
				}
			}

			return $retVal;
		}

		/**
		 * @param string $key
		 * @param array $data
		 *
		 * @return array
		 */
		private function groupBy ( string $key, array $data ): array
		{
			$result = array();
			foreach ( $data as $val ) {

				if ( array_key_exists( $key, $val ) ) {

					$result[ $val[ $key ] ][] = $val;
				} else {
					$result[ "" ][] = $val;
				}

			}

			return $result;
		}


	}

	/*$obj = new LoadModulesResources();
	$obj->loadFiles();
	$obj->buildNavigations( "1.1,1.2,2.1" );*/
	//print_r($obj->SYSTEM_MAIN_NAV);
	//print_r( $obj->SYSTEM_PARENT_NAV );
	//print_r( $obj->USER_MODULES );
	//	print_r($obj->getFocusViewResources('home'));
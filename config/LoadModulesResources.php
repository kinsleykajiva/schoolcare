<?php
	declare(strict_types=1);

	class LoadModulesResources{

		private  $module_def_file = "res/module-definations.json";
		private  $Jmodule_def_file = [];
		private  $modules_file = "res/modules.json";
		private  $Jmodules_file = [];
		public  $USER_MODULES = [] ;
		public  $SYSTEM_PARENT_NAV = [] ;
		public  $SYSTEM_MAIN_NAV = [] ;

		public function __construct (){
			$this->loadFiles();
		}

		private function loadFiles ()
		{
			$this -> Jmodule_def_file = json_decode( file_get_contents( $this->module_def_file, TRUE ), TRUE, 512, JSON_THROW_ON_ERROR );
			$this -> Jmodules_file = json_decode( file_get_contents( $this->modules_file, TRUE ), TRUE, 512, JSON_THROW_ON_ERROR );
		}



		public function buildNavigations():void {
			$userAccess = explode(',' , '1.1,1.21');
			$userAccess = array_map( static function( $value) {return (float)$value;}, $userAccess);

			$hasAccessModules = [];
			$NAV = [] ;
			foreach ($this -> Jmodule_def_file  as $item){

				foreach ($item['has'] as $idItem){


					if( in_array( $idItem, $userAccess, TRUE ) ){
						$this->SYSTEM_PARENT_NAV[] = ['title'=> $item['name'] , 'id'=>$item['id']];
						foreach ($item['sub-modules'] as $module){

							foreach ($this -> Jmodules_file  as  $itemModule){

								if($module['id'] === $itemModule['id'] ){
									$arrTemp =
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
			///print_r($NAV);exit;
			$this->USER_MODULES = $hasAccessModules;


		}

	}
	/*$obj= new LoadModulesResources();
	$obj->buildNavigations();
	print_r($obj->SYSTEM_PARENT_NAV);*/
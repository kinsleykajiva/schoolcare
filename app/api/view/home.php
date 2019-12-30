<?php
  include '../checkReqst.php';
  // print $USER_ID ;
  // print $ROLE_ID ;

  include_once '../../dbaccess/classes/DBChildren.php';

  $childrenObj = new DBChildren(USER, PASSWORD, DATABASE);
  $view = [] ;

  if(isset($_GET['get_def'])){
      $view['children'] = $childrenObj->getStatistics();

      print json_encode($view);
  }

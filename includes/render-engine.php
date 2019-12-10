<?php
	session_start();
	if ( !isset( $_SESSION ) || !isset( $_SESSION[ 'USER_MODULES' ] ) ) {
		header( 'Location: log?msg=auth' );
		exit;
	}
	$USER_MODULES = $_SESSION[ 'USER_MODULES' ];// array
	$SYSTEM_MAIN_NAV = $_SESSION[ 'SYSTEM_MAIN_NAV' ];// array
	$SYSTEM_PARENT_NAV = $_SESSION[ 'SYSTEM_PARENT_NAV' ];// array

	require_once 'config/ViewRenderer.php';

	$url_fetch = $_GET[ 'fetch' ] ?? '';

	$viewObject = new ViewRenderer ( $url_fetch, $USER_MODULES, $SYSTEM_MAIN_NAV,$SYSTEM_PARENT_NAV, TRUE );


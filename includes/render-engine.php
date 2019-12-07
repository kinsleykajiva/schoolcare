<?php
	session_start();
	if ( !isset( $_SESSION ) || !isset( $_SESSION[ 'USER_MODULES' ] ) ) {
		header( 'Location: log?msg=auth' );
		exit;
	}
	$USER_MODULES = $_SESSION[ 'USER_MODULES' ];// array
	$SYSTEM_MAIN_NAV = $_SESSION[ 'SYSTEM_MAIN_NAV' ];// array
	$NAVIGATION_BAR = $_SESSION[ 'NAVIGATION_BAR' ];// array
	require_once 'config/ViewRenderer.php';

	$url_fetch = $_GET[ 'fetch' ] ?? '';

	$viewObject = new ViewRenderer ( $url_fetch, $USER_MODULES, $SYSTEM_MAIN_NAV, $NAVIGATION_BAR, TRUE );


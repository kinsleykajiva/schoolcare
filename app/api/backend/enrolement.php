<?php

	include '../checkReqst.php';
	// print $USER_ID ;
	// print $ROLE_ID ;

	include_once '../../dbaccess/classes/DBChildParents.php';
	include_once '../../dbaccess/classes/DBChildren.php';
	$res = [];
	if ( isset( $_POST[ 'childrenJson' ] ) ) {
		$childrenJson = $_POST[ 'childrenJson' ];
		$parentJson = $_POST[ 'parentJson' ];
		$childrenJson = json_decode( $childrenJson , TRUE , 512 , JSON_THROW_ON_ERROR );
		$parentJson = json_decode( $parentJson , TRUE , 512 , JSON_THROW_ON_ERROR );
		//print_r($childrenJson);exit;
		//print_r($parentJson);exit;
		$parentObj = new DBChildParents( USER , PASSWORD , DATABASE );
		$childObj = new DBChildren( USER , PASSWORD , DATABASE );
		$lastChildID = $lastParentID = [];
		// register the child
		foreach ( $childrenJson as $child ) {
			$child = $child[ 'data' ];
			//print_r($child);exit;
			$res = $childObj->saveChild( $child[ 'childName' ] , $child[ 'childSurname' ] , $child[ 'childSex' ] , $child[ 'childDOB' ] , $child[ 'childNotes' ] );
			if ( $res[ 'status' ] === 'ok' ) {
				$lastChildID[] = $res[ 'extra' ][ 'lastID' ];
			}
		}
		// register the parent
		foreach ( $parentJson as $parent ) {
			$parent = $parent[ 'data' ];
			$res = $parentObj->saveParent( $parent[ 'parentName' ] , $parent[ 'parentSurname' ] , $parent[ 'parentIDNumber' ] , $parent[ 'parentSex' ] , $parent[ 'parentOccupation' ] , $USER_ID , $parent[ 'parentPhone' ] , $parent[ 'parentEmail' ] , $parent[ 'parentHomeAddress' ] );
			if ( $res[ 'status' ] === 'ok' ) {
				$lastParentID[] = $res[ 'extra' ][ 'lastID' ];
			}
		}
		// now connect the parents to all the children
		if ( count( $lastChildID ) > 0 ) {
			foreach ( $lastParentID as $parentID ) {
				foreach ( $lastChildID as $childID ) {
					$parentObj->saveParentChildConnection( $parentID , $childID );
				}

			}
		}

		print json_encode( $res , JSON_THROW_ON_ERROR , 512 );
		exit;
	}
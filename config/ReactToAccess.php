<?php
	interface ReactToAccess {
		function rejectPageAccess ():void;
		function sendToWelcome($userID):void;
		function sendToSetUp($userID):void;
		function sessionTimeOutReaction(string $lastFilePath):void;
	}
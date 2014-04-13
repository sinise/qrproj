<?php	
	
	$mysqli = new mysqli("localhost", "root", "", "qrproj");
	
	
	// Prepare statement for inserting information in actors
	$stmt_insertActors = $mysqli -> prepare("INSERT INTO actors (EventId, UserId, RankId) VALUES (:EventId, :UserId, :RankId)");
	$stmt_insertActors -> bindParam(':EventId', $eventId);
	$stmt_insertActors -> bindParam(':UserId', $userId);
	$stmt_insertActors -> bindParam(':RankId', $rankId);
	/*
	// Prepare statement for inserting information in Ads
	$stmt_insertActors = $mysqli -> prepare("INSERT INTO ads (EventId, UserId, RankId) VALUES (:EventId, :UserId, :RankId)");
	$stmt_insertActors -> bindParam(':EventId', $eventId);
	$stmt_insertActors -> bindParam(':UserId', $userId);
	$stmt_insertActors -> bindParam(':RankId', $rankId);
		*/
	/*** Script that inserts an entity in Actors ***/
	function insertIntoActors($eventId, $userId, $rankId)
	{
		// execute insertion
		if(!$stmt_insertActors -> execute())
		{
			Echo "Error: Couldn't insert in Actors";
		}
	}
	/*** Script that inserts an entity in Ads ***/
	/*** Script that inserts an entity in Categories ***/
	/*** Script that inserts an entity in Events ***/
	/*** Script that inserts an entity in Permissions ***/
	/*** Script that inserts an entity in Tickets ***/
	/*** Script that inserts an entity in Users ***/
	/*** Script that inserts an entity in visits ***/
	
	
	insertIntoActors(1,1,2);

?>

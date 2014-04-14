<?php

	class Cipher 
	{
		private $securekey, $iv;
		function __construct($textkey) 
		{
			$this->securekey = hash('sha256',$textkey,TRUE);
			$this->iv = mcrypt_create_iv(32);
		}
		function encrypt($input) 
		{
			return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->securekey, $input, MCRYPT_MODE_ECB, $this->iv));
		}
		function decrypt($input) 
		{
			return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->securekey, base64_decode($input), MCRYPT_MODE_ECB, $this->iv));
		}
	}
	
	
	$mysqli = new mysqli("localhost", "root", "", "qrproj");
	
	/*** Checks if id in events exists ***/
	function eventsHasId($eventId)
	{
		// Prepare statement for inserting information in actors
		$stmt = $GLOBALS['mysqli'] -> prepare("SELECT EventId FROM events WHERE EventId = ? ");
		$stmt -> bind_param("i", $eventId);
		
		// execute stmt
		if(!$stmt -> execute())
		{
			Echo "Error: Couldn't check if eventId exists";
		}
		while($stmt -> fetch())
		{
			// if a row is found, return true
			return true;
		}
		
		// if you are still inside this function it's because you didn't find any rows with the id.
		return false;
	}
		
	/*** Checks if id in ads exists ***/
	function adsHasId($adsId)
	{
		// Prepare statement
		$stmt = $GLOBALS['mysqli'] -> prepare("SELECT AdId FROM ads WHERE AdId = ? ");
		$stmt -> bind_param("i", $adsId);
		
		// execute stmt
		if(!$stmt -> execute())
		{
			Echo "Error: Couldn't check if adId exists";
		}
		while($stmt -> fetch())
		{
			// if a row is found, return true
			return true;
		}
		
		// if you are still inside this function it's because you didn't find any rows with the id.
		return false;
	}
		
	/*** Checks if id in users exists ***/
	function usersHasId($userId)
	{
		// Prepare statement for inserting information in actors
		$stmt = $GLOBALS['mysqli'] -> prepare("SELECT UserId FROM users WHERE UserId = ? ");
		$stmt -> bind_param("i", $userId);
		
		// execute stmt
		if(!$stmt -> execute())
		{
			Echo "Error: Couldn't check if userId exists";
		}
		while($stmt -> fetch())
		{
			// if a row is found, return true
			return true;
		}
		
		// if you are still inside this function it's because you didn't find any rows with the id.
		return false;
	}
		
	/*** Returns an array of all category names ***/
	function retrieveCategoryList()
	{
		// Prepare statement
		$stmt = $GLOBALS['mysqli'] -> prepare("SELECT CategoryId, CatName FROM categories");
		
		$stmt->bind_result($catId, $catName);
		
		// initialise array for results
		$result = new arrayObject();
		
		// execute statement
		if(!$stmt -> execute())
		{
			Echo "Error: Couldn't retrieve category";
		}
		
		// fetch rows
		while($stmt -> fetch())
		{
			$result -> append(array($catId,$catName));
		}
		return $result;
	}
		
	/*** Returns an array of all public future events 
	 * return an array with following indices per row:
	 * 0: EventId
	 * 1: CategoryId
	 * 2: AdId
	 * 3: EventName
	 * 4: EventStart
	 * 5: EventEnd
	 * 6: Description
	 * 7: Location
	 * 8: Venue
	 * 9: URLName
	***/
	function retrievePublicFutureEvents()
	{
		// Prepare statement
		$stmt = $GLOBALS['mysqli'] -> prepare("SELECT EventId, CategoryId, AdId, EventName, EventStart, EventEnd, Description, Location, Venue, URLName FROM events WHERE EventStart > '2014-02-02 23:23:23' AND publicity=TRUE");
		
		$stmt->bind_result($eventId, $categoryId, $adId, $eventName, $eventStart, $eventEnd, $description, $location, $venue, $URLName);
		
		// initialise array for results
		$result = new arrayObject();
		
		// execute statement
		if(!$stmt -> execute())
		{
			Echo "Error: Couldn't retrieve event";
		}
		
		// fetch rows
		while($stmt -> fetch())
		{
			$result -> append(array($eventId, $categoryId, $adId, $eventName, $eventStart, $eventEnd, $description, $location, $venue, $URLName));
		}
		return $result;
	}
	
	/** checks if password/email matches 
	 * returns userId, if error, then return -1
	**/
	function loginAuthorisation($email, $password)
	{
		// Prepare statement
		$stmt = $GLOBALS['mysqli'] -> prepare("SELECT UserId FROM users WHERE email = ? AND password = ? ");
		$stmt -> bind_param("ss", $emailEncrypted, $passwordEncrypted);
		$stmt->bind_result($userId);
		
		// encrypt email
		$cipher = new Cipher('We need to make up a secret passphrase');
		$emailEncrypted = $cipher->encrypt($email);
		
		// encrypt password
		$cipher = new Cipher('We need to make up a secret passphrase');
		$passwordEncrypted = $cipher->encrypt($password);
		
		var_dump($passwordEncrypted);
		// execute stmt
		if(!$stmt -> execute())
		{
			Echo "Error: Couldn't check if adId exists";
		}
		while($stmt -> fetch())
		{
			// if a row is found, return true
			return $userId;
		}
		
		// if you are still inside this function it's because you didn't find any rows with the id.
		return -1;
	}
	
	$test = loginAuthorisation("kylling@gmail.com", "yeahright");
	var_dump($test);
	
?>
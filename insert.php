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


	
	/*** Script that inserts an entity in Actors ***/
	function insertIntoActors($eventId, $userId, $rankId)
	{
		// Prepare statement for inserting information in actors
		$stmt_insertActors = $GLOBALS['mysqli'] -> prepare("INSERT INTO actors (EventId, UserId, RankId) VALUES ( ? , ? , ? )");
		$stmt_insertActors -> bind_param("iii", $eventId, $userId, $rankId);
		
		// execute insertion
		if(!$stmt_insertActors -> execute())
		{
			Echo "Error: Couldn't insert in Actors";
		}
	}
	
	
	/*** Script that inserts an entity in Ads ***/
	function insertIntoAds($adName, $adPicture)
	{
		// Prepare statement for inserting information in actors
		$stmt_insertAds = $GLOBALS['mysqli'] -> prepare("INSERT INTO ads (AdName, AdPicture) VALUES ( ? , ? )");
		$stmt_insertAds -> bind_param("ss", $adName, $adPicture);
		
		// execute insertion
		if(!$stmt_insertAds -> execute())
		{
			Echo "Error: Couldn't insert in Ads";
		}
	}

	/*** Script that inserts an entity in Categories ***/
	function insertIntoCategories($categoryName)
	{
		// Prepare statement for inserting information in actors
		$stmt_insertCategories = $GLOBALS['mysqli'] -> prepare("INSERT INTO categories (CategoryName) VALUES ( ? )");
		$stmt_insertCategories -> bind_param("s", $categoryName);
		
		// execute insertion
		if(!$stmt_insertCategory -> execute())
		{
			Echo "Error: Couldn't insert in Categories";
		}
	}
	
	/*** Script that inserts an entity in Events ***/
	function insertIntoEvents($categoryId, $adId, $eventName, $eventStart, $eventEnd, $description, $location, $venue, $URLName, $publicity)
	{
		// Prepare statement for inserting information in actors
		$stmt_insertEvents = $GLOBALS['mysqli'] -> prepare("INSERT INTO categories (CategoryId, AdId, EventName, EventStart, EventEnd, Description, Location, Venue, URLName, Publicity) VALUES ( ? , ? , ? , ? , ? , ? , ? , ? , ? , ? )");
		$stmt_insertEvents -> bind_param("iissssssss", $categoryId, $adId, $eventName, $eventStart, $eventEnd, $description, $location, $venue, $URLName, $publicity);
		
		// do some regex
		
		// execute insertion
		if(!$stmt_insertEvents -> execute())
		{
			Echo "Error: Couldn't insert in Events";
		}
	}
	
	/*** Script that inserts an entity in Permissions ***/
	function insertIntoPermissions($rankName, $organise, $scannerman, $scan)
	{
		// Prepare statement for inserting information in actors
		$stmt_insertPermissions = $GLOBALS['mysqli'] -> prepare("INSERT INTO permissions (RankName, Organise, Scannerman, Scan) VALUES ( ? , ? , ? , ? )");
		$stmt_insertPermissions -> bind_param("siii", $rankName, $organise, $scannerman, $scan);
		
		// execute insertion
		if(!$stmt_insertPermissions -> execute())
		{
			Echo "Error: Couldn't insert in Permissions";
		}
	}
	
	/*** Script that inserts an entity in Tickets ***/
	function insertIntoTickets($userId, $eventId, $details)
	{
		// Prepare statement for inserting information in actors
		$stmt_insertTickets = $GLOBALS['mysqli'] -> prepare("INSERT INTO tickets (UserId, EventId, Details, QRcode, IP) VALUES ( ? , ? , ? , ? , ? )");
		$stmt_insertTickets -> bind_param("iisss", $userId, $eventId, $details, $QRcode, $ip);
		
		// do some code to generate QR code. (need to check if QR code already exists)
		$QRcode = "QRQRQRQRQRQRQR";
		
		// Get ip address
		$ip = $_SERVER["REMOTE_ADDR"];
		
		// execute insertion
		if(!$stmt_insertTickets -> execute())
		{
			Echo "Error: Couldn't insert in Tickets";
		}
	}
	
	/*** Script that inserts an entity in Users ***/
	function insertIntoUsers($firstName, $lastName, $email, $password)
	{
		// Prepare statement for inserting information in actors
		$stmt_insertUsers = $GLOBALS['mysqli'] -> prepare("INSERT INTO users (FirstName, LastName, Email, Password) VALUES ( ? , ? , ? , ? )");
		$stmt_insertUsers -> bind_param("ssss", $firstName, $lastName, $emailEncrypted, $passwordEncrypted);
		
		// encrypt password
		$cipher = new Cipher('We need to make up a secret passphrase');
		$passwordEncrypted = $cipher->encrypt($password);
		
		// encrypt email
		$cipher = new Cipher('We need to make up a secret passphrase');
		$emailEncrypted = $cipher->encrypt($email);
		
		// validate email...
		
		// execute insertion
		if(!$stmt_insertUsers -> execute())
		{
			Echo "Error: Couldn't insert in Users";
		}
	}
	
	/*** Script that inserts an entity in visits ***/
	function insertIntoVisits($page)
	{
		// Prepare statement for inserting information in actors
		$stmt_insertVisits = $GLOBALS['mysqli'] -> prepare("INSERT INTO visits (Page, IP, TARDIS) VALUES ( ? , ? , CURRENT_TIMESTAMP )");
		$stmt_insertVisits -> bind_param("sss", $page, $ip);
		
		// Get ip address
		$ip = $_SERVER["REMOTE_ADDR"];
		
		// execute insertion
		if(!$stmt_insertUsers -> execute())
		{
			Echo "Error: Couldn't insert in visits";
		}
	}
	
	
	//insertIntoActors(2,2,2);
	insertIntoUsers("zoo", "does more farts", "kylling@gmail.com", "yeahright");

?>

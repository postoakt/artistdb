<?php
	class JsonResponse{
		public $success = false;
		public $message = "";
		public $data;
		
		function __construct($status, $msg, $data){
			$this->success = $status;
			$this->message = $msg;
			$this->data = $data;
		}
		
		function getStatus(){
			return $this->success;
		}
		
		function setStatus($status){
			$this->success = $status;
		}
		
		function getMessage(){
			return $this->message;
		}
		
		function setMessage($msg){
			$this->message = $msg;
		}
		
		function Send(){
			echo json_encode($this);
		}
	}
	
	class Artist{
		public $id;
		public $name;
		public $description;
		public $imgurl;
		public $albums;
		
		function __construct($id){
			$sql = "SELECT * FROM artists "
			     . "WHERE id = " . $id;
			$result = ExecuteSQL($sql);
			if ($result->num_rows >= 1){
				$row = mysqli_fetch_assoc($result);
				$this->setId($id);
				$this->setName($row["name"]);
				$this->setDescription($row["description"]);
				$this->setImgUrl($row["imgurl"]);
				$this->LoadAlbums();
			}
			else{
				Fail("Failure retrieving data.");
			}
		}
		
		function getId(){
			return $this->id;
		}
		
		function setId($id){
			$this->id = $id;
		}
		
		function getName(){
			return $this->name;
		}
		
		function setName($name){
			$this->name = $name;
		}
		
		function getDescription(){
			return $this->description;
		}
		
		function setDescription($description){
			$this->description = $description;
		}
		
		function getImgUrl(){
			return $this->imgurl;
		}
		
		function setImgUrl($imgurl){
			$this->imgurl = $imgurl;
		}
		
		function LoadAlbums(){
			$this->albums = [];
			$sql = "SELECT * FROM albums WHERE artistid = " . $this->getId();
			$result = ExecuteSQL($sql);
			while ($row = $result->fetch_assoc()){
				$album = new Album($row["id"]);
				array_push($this->albums, $album);
			}
		}
		
		function Update(){
			$sql = "UPDATE `artists` "
				 . "SET `name`='" . getName() . "',"
				 . "`description`='" . getDescription() . "',"
				 . "`imgurl`='" . getImgUrl() . "', "
				 . "WHERE 'id'=" . getId();
			ExecuteSQL($sql);
		}
		
		function Delete(){
			$sql = "DELETE FROM 'artists' WHERE 'id'=" . getId();
			ExecuteSQL($sql);
		}
	}
	
	
	class Album{
		public $id;
		public $artistid;
		public $name;
		public $imgurl;
		public $songs;
		public $releaseyear;
		
		function __construct($id){
			$sql = "SELECT * FROM albums "
			     . "WHERE id = " . $id;
			$result = ExecuteSQL($sql);
			if ($result->num_rows >= 1){
				$row = mysqli_fetch_assoc($result);
				$this->setId($id);
				$this->setArtistId($row["artistid"]);
				$this->setName($row["name"]);
				$this->setImgUrl($row["imgurl"]);
				$this->setReleaseYear($row["releaseyear"]);
				$this->LoadSongs();
			}
			else{
				Fail("Failure retrieving data.");
			}
		}
		
		function getId(){
			return $this->id;
		}
		
		function setId($id){
			$this->id = $id;
		}
		
		function getArtistId(){
			return $this->artistid;
		}
		
		function setArtistId($artistid){
			$this->artistid = $artistid;
		}
		
		function getName(){
			return $this->name;
		}
		
		function setName($name){
			$this->name = $name;
		}
		
		function getImgUrl(){
			return $this->imgurl;
		}
		
		function setImgUrl($imgurl){
			$this->imgurl = $imgurl;
		}
		
		function getReleaseYear(){
			return $this->releaseyear;
		}
		
		function setReleaseYear($releaseyear){
			$this->releaseyear = $releaseyear;
		}
		
		function LoadSongs(){
			$this->songs = [];
			$sql = "SELECT id FROM songs WHERE artistid=" . $this->getArtistId() . " AND albumid=" . $this->getId();
			$result = ExecuteSQL($sql);
			while ($row = $result->fetch_assoc()){
				$song = new Song($row["id"]);
				array_push($this->songs, $song);
			}
		}
		
		function Update(){
			$sql = "UPDATE `albums` "
				 . "SET `name`='" . getName() . "',"
				 . "`artistid`='" . getDArtistId() . "',"
				 . "`imgurl`='" . getImgUrl() . "',"
				 . "'releaseyear'=" . getReleaseYear() . "', "
				 . "WHERE 'id'=" . getId();
			ExecuteSQL($sql);
		}
		
		function Delete(){
			$sql = "DELETE FROM 'artists' WHERE 'id'=" . getId();
			ExecuteSQL($sql);
		}
	}
	
	class Song{
		public $id;
		public $artistid;
		public $albumid;
		public $name;
		public $length;
		public $tracknumber;
		
		function __construct($id){
			$sql = "SELECT * FROM songs "
				 . "WHERE id = " . $id;
			$result = ExecuteSQL($sql);
			if ($result->num_rows >= 1){
				$row = mysqli_fetch_assoc($result);
				$this->setId($row["id"]);
				$this->setArtistId($row["artistid"]);
				$this->setAlbumId($row["albumid"]);
				$this->setName($row["name"]);
				$this->setLength($row["length"]);
				$this->setTrackNumber($row["tracknumber"]);
			}
			else{
				Fail("Failure retrieving data.");
			}
		}
		
		function getId(){
			return $this->id;
		}
		
		function setId($id){
			$this->id = $id;
		}
		
		function getArtistId(){
			return $this->artistid;
		}
		
		function setArtistId($id){
			$this->artistid = $id;
		}
		
		function getAlbumId(){
			return $this->albumid;
		}
		
		function setAlbumId($albumid){
			$this->albumid = $albumid;
		}
		
		function getName(){
			return $this->name;
		}
		
		function setName($name){
			$this->name = $name;
		}
		
		function getLength(){
			return $this->length;
		}
		
		function setLength($length){
			$this->length = $length;
		}
		
		function getTrackNumber(){
			return $this->tracknumber;
		}
		
		function setTrackNumber($tracknumber){
			$this->tracknumber = $tracknumber;
		}
		
		function Update(){
			$sql = "UPDATE `songs` "
				 . "SET `name`='" . getName() . "',"
				 . "`artistid`='" . getArtistId() . "',"
				 . "'albumid'=" . getAlbumId() . "',"
				 . "`length`='" . getLength() . "',"
				 . "'tracknumber'=" . getTrackNumber() . "', "
				 . "WHERE 'id'=" . getId();
			ExecuteSQL($sql);
		}
		
		function Delete(){
			$sql = "DELETE FROM 'artists' WHERE 'id'=" . getId();
			ExecuteSQL($sql);
		}
	}
	
	function ExecuteSQL($sql){
		$conn = new mysqli(SERVER, USERNAME, PASSWORD, DB);
		if ($conn->connect_errno){
			Fail("Failed to connect to database.");
		}
		$result = $conn->query($sql);
		if (!$result){
			 Fail("Statement failed to execute. (" . $conn->error . ")");
		}
		$conn->close();
		return $result;
	}
	
	function GetID($sql){
		$conn = new mysqli(SERVER, USERNAME, PASSWORD, DB);
		if ($conn->connect_errno){
			Fail("Failed to connect to database.");
		}
		$result = $conn->query($sql);
		if (!$result){
			Fail("Statement failed to execute. (" . $conn->error . ")");
		}
		$id = $conn->insert_id;
		$conn->close();
		return $id;
	}
	
	function Fail($err){
		$r = new JsonResponse(false, $err, new stdClass());
		$r->Send();
		exit();
	}
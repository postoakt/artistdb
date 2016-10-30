<?php
	require("db.php");
	require("utility.php");
	
	function main(){
		$data = json_decode($_POST["data"], true);
		$method = isset($_POST["method"]) ? $_POST["method"] : "";
		switch($method){
			case "newartist": NewArtist($data->artist);
				break;
			case "updateartist": UpdateArtist($data->artist);
				break;
			case "deleteartist": DeleteArtist($data->artist);
				break;
			case "newalbum": NewAlbum($data->album);
				break;
			case "updatealbum": UpdateAlbum($data->album);
				break;
			case "deletealbum": DeleteAlbum($data->album);
				break;
			case "newsong": NewSong($data->song);
				break;
			case "updatesong": UpdateSong($data->song);
				break;
			case "deletesong": DeleteSong($data->song);
				break;
			case "getartist": GetArtist($data->artist);
				break;
			case "searchbands": SearchBands($data["keywords"]);
				break;
			default: Fail("Invalid method.");
				break;
		}
	}
	
	function NewArtist($_artist){
		if (isset($_artist)){
			$sql = "INSERT INTO `artists`"
			     . "('name', `description`) "
				 . "VALUES "
				 . "('" . $_artist->name . "', '" . $_artist->description . "')";
			$id = GetID($sql);
			$artist = new Artist($id);
			$response = new JsonResponse(true, "Succesfully entered new artist.", $artist);
			$response->Send();
		}
		else{
			Fail("Invalid parameters.");
		}
	}
	
	function UpdateArtist($_artist){
		if (isset($_artist)){
			$artist = new Artist($_artist->id);
			$artist->setName($_artist->name);
			$artist->setDescription($_artist->description);
			$artist->setImgUrl($_artist->imgurl);
			$artist->Update();
			$response = new JsonResponse(true, "Artist info successfully updated.", $artist);
			$response->Send();	
		}
		else{
			Fail("Invalid parameters.");
		}
	}
	
	function DeleteArtist($_artist){
		if (isset($_artist)){
			$artist = new Artist($_artist->id);
			$artist->Delete();
			$response = new JsonResponse(true, "Artist successfully deleted.");
			$response->Send();
		}
		else{
			Fail("Invalid parameters.");
		}
	}
	
	function NewAlbum($_album){
		if (isset($_album)){
			$sql = "INSERT INTO `albums`"
			     . "('artistid', `name`, 'imgurl', 'releaseyear') "
				 . "VALUES "
				 . "('" . $_album->artistid . "', '" . $_album->name . "', "
				 . "'" . $_album->imgurl . "', '" . $_album->releaseyear . "')";
			$id = GetID($sql);
			$album = new Album($id);
			$response = new JsonResponse(true, "Succesfully entered new album.", $album);
			$response->Send();
		}
		else{
			Fail("Invalid parameters.");
		}
	}
	
	function UpdateAlbum($_album){
		if (isset($_album)){
			$album = new Album($_album->id);
			$album->setArtistId($_artist->artistid);
			$album->setName($_artist->name);
			$album->setImgUrl($_artist->imgurl);
			$album->setReleaseYear($_artist->releaseyear);
			$album->Update();
			$response = new JsonResponse(true, "Album info successfully updated.", $artist);
			$response->Send();	
		}
		else{
			Fail("Invalid parameters.");
		}
	}
	
	function DeleteAlbum($_album){
		if (isset($_album)){
			$album = new Album($_album->id);
			$album->Delete();
			$response = new JsonResponse(true, "Album successfully deleted.");
			$response->Send();
		}
		else{
			Fail("Invalid parameters.");
		}
	}
	
	function NewSong($_song){
		if (isset($_song)){
			$sql = "INSERT INTO `songs`"
			     . "('artistid', 'albumid', 'name', `length`, 'tracknumber') "
				 . "VALUES "
				 . "('" . $_song->artistid . "','" . $_song->albumid . "','" . $_song->name . "','" . $_song->length . "','" . $_song->tracknumber . "','" . "')";
			$id = GetID($sql);
			$song = new Song($id);
			$response = new JsonResponse(true, "Succesfully entered new song.", $song);
			$response->Send();
		}
		else{
			Fail("Invalid parameters.");
		}
	}
	
	function UpdateSong($_song){
		if (isset($_song)){
			$song = new Song($_song->id);
			$song->setArtistId($_song->artistid);
			$song->setAlbumId($_song->albumid);
			$song->setName($_song->name);
			$song->setLength($_song->length);
			$song->setTrackNumber($_song->tracknumber);
			$song->Update();
			$response = new JsonResponse(true, "Song info successfully updated.", $song);
			$response->Send();	
		}
		else{
			Fail("Invalid parameters.");
		}
	}
	
	function DeleteSong($_song){
		if (isset($_song)){
			$song = new Song($_song->id);
			$song->Delete();
			$response = new JsonResponse(true, "Song successfully deleted.");
			$response->Send();
		}
		else{
			Fail("Invalid parameters.");
		}
	}
	
	function SearchBands($keywords){
		if (isset($keywords)){
			$sql = "SELECT id "
			     . "FROM artists "
				 . "WHERE "
				 . "name LIKE '%" . $keywords . "%'";
			$result = ExecuteSQL($sql);
			$data = [];
			while ($row = $result->fetch_assoc()){
				$artist = new Artist($row["id"]);
				array_push($data, $artist);
			}
			$response = new JsonResponse(true, "Search successful.", $data);
			$response->Send();
		}
		else{
			Fail("Invalid parameters.");
		}
	}
	
	main();
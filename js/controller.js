app.controller("appController", function($scope, searchService){
	
	$scope.searchResponse = [];
	$scope.currentBand = {
		name: "",
		description: "",
		imgurl: "",
		albums: []
	};
	
	$scope.search = function(){
		searchService.search($scope.keywords).then(function(response){
			var obj = JSON.parse(response);
			if (obj.success){
				$scope.searchResponse = obj.data;
			}
		});
	};
	
	$scope.LoadBand = function(band){
		$scope.currentBand = band;
	}
	
	$scope.NewArtist = function(){
		console.log("New Artist");
	}
	
	$scope.EditArtist = function(){
		console.log("Edit Artist");
	}
	
	$scope.DeleteArtist = function(){
	}
	
	$scope.NewAlbum = function(){
		console.log("New Album");
	}
	
	$scope.EditAlbum = function(){
		console.log("Edit Album");
	}
	
	$scope.DeleteAlbum = function(){
	}
	
	$scope.ToMinutesSeconds = function(t){
		var minutes = "0" + Math.floor(t / 60);
		var seconds = "0" + (t - minutes * 60);
		return minutes.substr(-2) + ":" + seconds.substr(-2);
	}
	
});
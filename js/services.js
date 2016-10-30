const SERVER = "http://localhost/";
const API = SERVER + "artistdb/api/";
 
app.service("searchService", function($http){
		this.search = function(keywords){
			var data = JSON.stringify({keywords: keywords});
			var params = {
				method: "searchbands",
				data: data
			};
			return $.post(API, params);
		}
});

app.service("newArtist", function($http){
});

app.service("editArtist", function($http){
});

app.service("deleteArtist", function($http){
});

app.service("newAlbum", function($http){
});

app.service("editAlbum", function($http){
});

app.service("deleteAlbum", function($http){
});

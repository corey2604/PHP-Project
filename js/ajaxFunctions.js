function insertMovieIntoDb(title, overview, posterPath, genres) {
  //This method serves to pass movie data from the browser to the web server (addMovieToFavourites.php) and obtain a response
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      //If a response is successfully received then it is output to the "alertLocation" span element which was previously hidden
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("alertLocation").innerHTML = this.responseText;
        }
    };
    //Create the request and add the appropriate query parameters in key - value pairs to be read by the web server
    xmlhttp.open("GET", "../../php/functions/addMovieToFavourites.php?title=" + title + "\&overview=" + overview + "\&posterPath=" + posterPath + "\&genres=" + genres, true);
    xmlhttp.send();
}

function removeMovieFromDb(id) {
  //This method serves to pass the movie id from the browser to the web server (removeMovieFromFavourites.php) and obtain a response
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      //If a response is successfully received then it is output to the "alertLocation" span element which was previously hidden
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("alertLocation").innerHTML = this.responseText;
        }
    };
    //Create the request and add the appropriate query parameters in key - value pairs to be read by the web server
    xmlhttp.open("GET", "../../php/functions/removeMovieFromFavourites.php?id=" + id, true);
    xmlhttp.send();
}

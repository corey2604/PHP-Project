function insertMovieIntoDb(title, overview, posterPath, genres) {
var titleVal = title;
var overviewVal = overview;
var posterPathVal = posterPath;
var genresVal = genres;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("errorLocation").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../../php/functions/addMovieToFavourites.php?title="+titleVal+"\&overview="+overviewVal+"\&posterPath="+posterPathVal+"\&genres="+genresVal, true);
        xmlhttp.send();
}

// function getRecommendationsForMovie(title, genres) {
// var titleVal = title;
// var genresVal = genres;
// var request = $.ajax({
//   method: "POST",
//   url: "../../php/pages/movieRecommendations.php",
//   data: { title: titleVal, genres: genresVal },
//   success: function(){
//     window.location.href = "movieRecommendations.php?title="+titleVal+"\&genres="+genresVal";
//   },
//   error: function() {
//     getErrorMessage("Something went wrong");
//   }
// })
// }

function removeMovieFromDb(id) {
  var idVal = id;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("errorLocation").innerHTML = this.responseText;
              }
          };
          xmlhttp.open("GET", "../../php/functions/removeMovieFromFavourites.php?id="+idVal, true);
          xmlhttp.send();
}

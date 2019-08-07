function insertMovieIntoDb(title, overview, posterPath) {
var titleVal = title;
var overviewVal = overview;
var posterPathVal = posterPath;
var request = $.ajax({
  method: "POST",
  url: "../../php/functions/addMovieToFavourites.php",
  data: { title: titleVal, overview: overviewVal, posterPath: posterPathVal },
  success: function(e){alert('success:' + e);},
  error: function(e){
                console.log(e.message);
            }
})
}

function removeMovieFromDb(id) {
var idVal = id;
alert(idVal);
var request = $.ajax({
  method: "POST",
  url: "../../php/functions/removeMovieFromFavourites.php",
  data: { id: idVal },
  success: function(e){alert('success:' + e);},
  error: function(e){
                console.log(e.message);
            }
})
}

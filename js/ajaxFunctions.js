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
// var request = $.ajax({
//   method: "POST",
//   url: "../../php/functions/addMovieToFavourites.php",
//   data: { title: titleVal, overview: overviewVal, posterPath: posterPathVal, genres: genresVal },
//   success: function(e){
//     alert(e);
//     if (e) {
//       document.getElementById("errorLocation").innerHTML = "<div class=\"alert alert-success\"><strong><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Success!</strong> "+titleVal+" was successfully stored as a favourite!.</div>";
//     } else {
//       document.getElementById("errorLocation").innerHTML = "<div class=\"alert alert-error\"><strong><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Error!</strong> "+titleVal+" was unable to be added as a favourite!.</div>";
//     }
//     return false;
//   },
//   error: function(e){
//                 console.log(e.message);
//             }
// })
// }

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

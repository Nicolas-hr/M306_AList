function SendNote(score, event) {
  if (event) {
    event.preventDefault();
  }

  let url_string = document.URL;
  let url = new URL(url_string);
  let idAnime = url.searchParams.get("idAnime");
  let date = new Date($("#dateWatched").val());
  
  $.ajax({
    type: "post",
    url: "./php/scoreAnime.php",
    data: {score: score, idAnime: idAnime}, dateWatched: date,
    dataType: "json",
    success: (response) => {
      window.location.reload();
    },
    error: err => {
      console.log(err);
    }
  });
}
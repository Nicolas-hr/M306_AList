function SendNote(score, event) {
  if (event) {
    event.preventDefault();
  }

  $.ajax({
    type: "post",
    url: "./php/scoreAnime.php",
    data: {score: score},
    dataType: "json",
    success: (response) => {
      window.location.reload();
    },
    error: err => {
      console.log(err);
    }
  });
}
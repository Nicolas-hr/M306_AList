/**
 * @author Hoarau Nicolas
 * 
 * @brief Update score given to the anime in the database
 * 
 * @param {int} score score given to the anime
 * @param {*} event 
 */
 function SendNote(score, event) {
  if (event) {
    event.preventDefault();
  }

  let url_string = document.URL;
  let url = new URL(url_string);
  let idAnime = url.searchParams.get("idAnime");
  let date = $("#dateWatched").val();

  $.ajax({
    type: "post",
    url: "./php/scoreAnime.php",
    data: { score: score, idAnime: idAnime, dateWatched: date },
    dataType: "json",
    success: (response) => {
      switch (response.ReturnCode) {
        case 0:
          CalculateScoreAvg(idAnime);
          break;
      case 1:
        alert(response.Error);
        break;
      }
    },
    error: err => {
      console.log(err);
    }
  });
}

/**
 * @author Hoarau Nicolas
 * 
 * @brief Update the score average of the anime
 * 
 * @param {int} idAnime id of the anime
 */
function CalculateScoreAvg(idAnime) {
  $.ajax({
    type: "post",
    url: "./php/avgCalculator.php",
    data: {idAnime: idAnime},
    dataType: "json",
    success: (response) => {
      switch (response.ReturnCode) {
        case 0:
          window.location.reload();
          break;
      case 1:
        alert(response.Error);
        break;
      }
    },
    error: (error) => {
      console.log(error);
    }
  });
}
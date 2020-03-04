$(document).ready(() => {
  GetAnimeData();
});

/**
 * @author Hoarau Nicolas
 * @brief Get the anime data
 */
function GetAnimeData() {
  let url_string = document.URL;
  let url = new URL(url_string);
  let idAnime = url.searchParams.get("idAnime");

  $.ajax({
    type: "post",
    url: "./php/getAnime.php",
    data: { idAnime: idAnime },
    dataType: "json",
    success: data => {
      ShowAnime(data);
    }
  });
}

/**
 * @author Hoarau Nicolas
 * @brief Show a specific anime
 * 
 * @param {array} data anime data
 */
function ShowAnime(data) {
  let html =
    '<div class="container">' +
      '<div class="row">' +
        '<div class="col col-sm-auto">' +
          '<img src="' + data.cover + '" alt="anime cover" height="200" width="150">' +
        "</div>" +
        '<div class="col col-lg-10">' +
          "<br>" +
          data.descritpion +
        "</div>" +
      "</div>" +
      "<br>" +
      "<table>" +
        "<tr>" +
          "<th>My Score</th>" +
          "<th>Score Average</th>" +
        "</tr>" +
        "<tr>" +
          "<td>" + data.userScore + "</td>" +
          "<td>" + data.avgScore + "</td>" +
        "</tr>" +
      "</table>" +
    "</div>";

    $('#anime').html(html);
}

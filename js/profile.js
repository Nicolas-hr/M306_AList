function GetUserData(idUser) {
  $.ajax({
    type: "post",
    url: "./php/getProfile.php",
    data: { idUser: idUser },
    dataType: "json",
    success: data => {
      console.log(data);

      ShowProfil(data);
    }
  });
}

function ShowProfil(data) {
  let userData = data.userData;
  let animeData = data.animeData;

  let html =
    `<div id="container">
    <img src="./assets/img/${userData.logo}" alt="userProfilePicture" height="35" width="35">
    ${userData.username}
    <div calss="container">
    <table id="animeTable">
    <tr>
    <th>Anime title</th>
    <th>Note</th>
    <th>Date watched</th>
    </tr>`;
  $.each(animeData, (index, anime) => {
    html += `<tr>
      '<td>
        <img src="${anime.cover}" alt="animeCover">
        ${anime.title}
      </td>
      <td>
      ${anime.note}
      </td>
      "</tr>`;
  });
  html += `</table></div></div>`;

  $("#profil").html(html);
}

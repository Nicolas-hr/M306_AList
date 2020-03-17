/**
 * @author Hoarau Nicolas
 * @brief Get the user data
 * 
 * @param {int} idUser user id
 */
function GetUserData(idUser) {
  if (idUser != null) {
    $.ajax({
      type: "post",
      url: "./php/getProfile.php",

      data: { idUser: idUser },
      success: (data) => {
        ShowProfil(data);
      },
      error: (error) => {
        console.log(error);
      }
    });
  } else {
    window.location.href = './index.php';
  }
}

/**
 * @author Hoarau Nicolas
 * 
 * @brief Show the data et from the function GetUserData
 * 
 * @param {array} data user data and his library
 */
function ShowProfil(data) {
  let userData = data.userData;
  let animeData = data.libraryData;

  let html =
    `<div class="container">
    <img src="./assets/img/${userData.logo}" alt="userProfilePicture" height="35" width="35">
    ${userData.username}
    <div class="container">
    <table id="animeTable">
    <tr>
    <th>Anime title</th>
    <th>Note</th>
    <th>Date watched</th>
    </tr>`;

    for (let i = 0; i < animeData.length; i++) {
      const anime = animeData[i];
      
      html += `<tr>
        <td>
          ${anime.name}
        </td>
        <td>
        ${anime.note}
        </td>
        </tr>`;
    }
  html += `</table></div></div>`;

  $("#profil").html(html);
}

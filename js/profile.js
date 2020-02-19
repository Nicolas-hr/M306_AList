$(document).ready(() => {
  GetUserData();
});

function GetUserData() {
  let url_string = document.URL;
  let url = new URL(url_string);
  let idUser = url.searchParams.get("idUser");

  $.ajax({
    type: "post",
    url: "./lib/profile.php",
    data: {idUser: idUser},
    dataType: "json",
    success: data => {
      ShowProfil(data);
    }
  });
}

function ShowProfil(userData) {
  
}

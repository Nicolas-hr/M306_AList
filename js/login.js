$(document).ready(() => {
  $("#btnSendPosts").click(Login);
});

function Login(event) {
  if (event) {
    event.preventDefault();
  }

  // intialisation
  let username = $("#nicknameUser").val();
  let password = $("#password").val();

  // processing
  if (username.length == 0) {
    $("#nicknameUser").css("border-color", "red");
    $("#nicknameUser").focus();
    return;
  } else {
    $("#nicknameUser").css("border-color", "");
  }

  if (password.length == 0) {
    $("#password").css("border-color", "red");
    $("#password").focus();
    return;
  } else {
    $("#password").css("border-color", "");
  }

  $.ajax({
    type: "post",
    url: "./lib/register.php",
    data: {"username": username, "password": password},
    dataType: "json",
    success: response => {},
    error: () => {}
  });
}

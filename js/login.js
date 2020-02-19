$(document).ready(() => {
  $("#btnLogUser").click(Login);
});

function Login(event) {
  if (event) {
    event.preventDefault();
  }

  // intialisation
  let username = $("#nickname").val();
  let password = $("#password").val();

  // processing
  if (username.length == 0) {
    $("#nickname").css("border-color", "red");
    $("#nickname").focus();
    return;
  } else {
    $("#nickname").css("border-color", "");
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
    data: { username: username, password: password },
    dataType: "json",
    success: response => {
      window.location.href = "./index.php";
    },
    error: () => {}
  });
}

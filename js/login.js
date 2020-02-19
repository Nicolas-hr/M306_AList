$(document).ready(() => {
  $("#btnLogUser").click(Login);
});

function Login(event) {
  if (event) {
    event.preventDefault();
  }

  // intialisation
  let email = $("#email").val();
  let password = $("#password").val();

  // processing
  if (username.length == 0) {
    $("#email").css("border-color", "red");
    $("#email").focus();
    return;
  } else {
    $("#email").css("border-color", "");
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
    data: { email: email, password: password },
    dataType: "json",
    success: response => {
      window.location.href = "./index.php";
    },
    error: () => {}
  });
}

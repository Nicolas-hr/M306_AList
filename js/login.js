$(document).ready(() => {
  $("#btnLogUser").click(Login);
});

/**
 * @author Hoarau Nicoals
 * 
 * @brief send log data with an ajax call
 * @param {event} event on click event
 */
function Login(event) {
  if (event) {
    event.preventDefault();
  }

  // intialisation
  let email = $("#email").val();
  let password = $("#password").val();

  // processing
  if (email.length == 0) {
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
    url: "./php/login.php",
    data: { email: email, password: password },
    dataType: "json",
    success: response => {
      switch (response.ReturnCode) {
        case 0:
          window.location.href = "./profile.php";
          break;
        case 1:
          $('#error').text(response.Error);
          break;
      }
    }
  });
}

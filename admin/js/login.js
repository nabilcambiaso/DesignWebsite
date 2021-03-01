//show password link

function showPassword() {
  var x = document.getElementById("inputPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
//authentificate
function login() {
  var password = $("#inputPassword").val();
  var email = $("#inputEmail").val();
  $.ajax({
    type: "post",
    url: "crud/authentication.php",
    data: {
      Email: email,
      Password: password,
      Login: "login"
    },
    success: function (response) {
     
      try {
       
          response=JSON.parse(response);
          sessionStorage.setItem("Name", response.First_Name+" "+response.Last_Name);
          window.location.href = "./dashboard";
        
      } catch {
        $(".alert").html(
          "<span class='error' > Email Adress Or Password Incorrect ! </span>"
        );
      }

    }
  });
}


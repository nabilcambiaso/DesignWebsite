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

//forgot pass changer
function forgotPass()
{

  var email=$("#exampleInputEmail1").val();
  var hint=$("#exampleInputHint").val();
  var password1=$("#exampleInputPassword1").val();
  var password2=$("#exampleInputPassword2").val();
  if(password1==password2)
  {
    $.ajax({
      type: "post",
      url: "crud/authentication.php",
      data: {
        Email:email,
        Hint:hint,
        Password:password2,
        ForgotPass:"forgotPass"
      },
      success: function (response) {
        console.log(response);
        if(response=="1")
        {
          $(".alert").html("<span class='success'> Password Changed succesfully !</span>");
         
        }
        else
        {
          $(".alert").html("<span class='error'> Email or Hint Incorrect !</span>");
        }

      }
    });

  }
  else{
    $(".alert").html("<span class='error'> Passwords Not Identical Make Sure to Enter the Same Pass !</span>");
  }

}

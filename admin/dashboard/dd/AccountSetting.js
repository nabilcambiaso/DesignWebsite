var phpUrl = "PhpFiles/AccountSettings.service.php";
// datatables------
$("#example").dataTable();
$("#example1").dataTable();

//on load ------------------------------------
var tDelete = $("#example").DataTable();
var t = $("#example1").DataTable();
loadEmployees();
function loads()
{
  tDelete.clear().draw();
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { load: "load" },
    success: function (response) {
      $.each(JSON.parse(response), function (key, val) {
        tDelete.row
          .add([
            val.employee_id,
            val.first_name + " " + val.last_name,
            val.department,
            val.location,
            val.country,
            val.short_number,
            val.job_position,
            "<a onclick=ReturnEmployee('" +
              val.employee_id +
              "')><i class='icon-arrow-left  font-large-1 green' onclick=ReturnEmployee(('" +
              val.employee_id +
              "') name='ReturnSelectedEmployee'></i></a>"
          ])
          .draw(false);

          
         
      });
      var selectedEmployee = $("#loadAllEmployees").children("option:selected").val();
      loadSingelEmployeeData(selectedEmployee);
    }
  });
}

//fill add select employee
function loadEmployees()
{
$.ajax({
  type: "post",
  url: phpUrl,
  data: {loademployees:""},
  success: function (response) {
    response=JSON.parse(response);
    console.log(response[1].UserId);

   if(response[0].nbr=='0')
   {
    $.each(response[1], function (indexInArray, val) { 
    $("#loadAllEmployees").append(
      `<option value='${val.UserId }'>${val.First_Name} ${val.Last_Name}</option>`
    );
  });

   }
   else{
    $.each(response[1], function (indexInArray, val) { 
      $("#loadAllEmployees").append(
        `<option value='${val.employee_id  }'>${val.first_name} ${val.last_name}</option>`
      );
    });

   }

  }
});
}


$(function() { 
  $("#loadAllEmployees").change(function() { 
    var selectedEmployee = $(this).children("option:selected").val();
    setTimeout(() => {
    $("#addEmployeeId").val(selectedEmployee);   
    }, 200);

    loadSingelEmployeeData(selectedEmployee);
  });
});

function loadSingelEmployeeData(id) {
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { loadSingle: "loadSingle", id:id },
    success: function (res) {
      if(res=="")
      {
    $("#addEmployeeId").val(id);   
         
      }
      else{
        response = JSON.parse(res);
      
        $("#UserFNameSubscribe").val(`${response.first_name}`);
        $("#addEmployeeId").val(response.employee_id);
        $("#UserLNameSubscribe").val(`${response.last_name}`);
        $("#EmailSubscribe").val(`${response.first_name}.${response.last_name}@nomac.com`);
        $("#PasswordSubscribe").val(`${response.first_name}.${response.last_name}123`);
        $("#ConfirmPasswordSubscribe").val(`${response.first_name}.${response.last_name}123`);
        $("#HintSubscribe").val("");
      }

    }
  });
}

 //call load 
 loads();
 //verification delete user *
 function ReturnEmployeeVerification(id)
 {
   $.ajax({
     type: "post",
     url: phpUrl,
     data: {idModalUser:id},
     success: function (response) {
       
       response=JSON.parse(response);
       $("#ReturnEmployeeName").html(response[0].First_Name+" "+response[0].Last_Name);
       $("#ReturnEmployeeCode").val(response[0].UserId);
     }
   });

 }
 function ReturnEmployee(id){
    $.ajax({
      type: "post",
      url: phpUrl,
      data: {
        ReturnSelectedEmployee:"Return",
         EmployeeId:id
        },
      success: function (response) {
      loads();     
      }
    });
  }
  // ------------------end DeletedEmployeeeeeee-----------------------------------------
  function loadsAccount()
{

t.clear().draw();
$.ajax({
  type: "post",
  url: phpUrl,
  data: { load1:"load1" },
  success: function (response) {
   
    $.each(JSON.parse(response), function (key, val) {
      t.row
        .add([
          val.UserId,
          val.First_Name + " " + val.Last_Name,
          val.Email,
          "<a data-toggle='modal' data-target='#detailModal' onclick=detailsUser('" +
          val.UserId +
          "')><i class=' icon-server font-large-1 '></i></a>",
          "<a data-toggle='modal' data-target='#deleteModal' onclick=deleteUserVerification('" +
            val.UserId +
            "')><i class='icon-bin font-large-1 red' ></i></a>"
              
        ])
        .draw(false);
    });
  }
});
}

loadsAccount();




function AddAccount() {
  if($("#UserIdSubscribe").val()!="")
  {
  var UserId = $("#loadAllEmployees").children("option:selected").val();
  var FirstName = $("#UserFNameSubscribe").val();
  var LastName = $("#UserLNameSubscribe").val();
  var Email = $("#EmailSubscribe").val();
  var Password = $("#PasswordSubscribe").val();
  var OldPass=$("#PasswordSubscribe").val();
  var ConfirmPasswords=$("#ConfirmPasswordSubscribe").val();
  var Hint = $("#HintSubscribe").val();

if(Password==ConfirmPasswords)
{
  $.ajax({
    type: "post",
    url: phpUrl,
    data: {
      AddUser: "AddUser",
      UserId: UserId,
      FirstName: FirstName,
      LastName: LastName,
      Email: Email,
      Password:Password,
      Hint: Hint,
      OldPass:OldPass
      
    },
    success: function (response) {

      window.location.href="./AccountSetting?Validate";
    }
    
  });
 }
}
 
 else{
   $(".alertAddModal").html("<span class='alert alert-danger>Please Fill All Fields *</alert>'");
 }

}
//details User *
function detailsUser(id) {
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { idModalUser: id },
    success: function (response) {
      $("#tableModalDetails").html("");
      response = JSON.parse(response);
      response = response[0];
      $("#tableModalDetails").append(
        "<tr><td>User Id</td><td>" + response.UserId+ "</td></tr>"
      );
      $("#tableModalDetails").append(
        "<tr><td>Full Name</td><td>" +
          response.First_Name +
          " " +
          response.Last_Name +
          "</td></tr>"
      );
      $("#tableModalDetails").append(
        "<tr><td>Email</td><td>" + response.Email + "</td></tr>"
      );
  
      $("#tableModalDetails").append(
        "<tr><td>Password</td><td>" +
          response.OldPass +
          "</td></tr>"
      );
      $("#tableModalDetails").append(
        "<tr>Location<td>Hint </td><td>" +
          response.hint +
          "</td></tr>"
      );

     
    }
  });

}
 //verification delete user *
 function deleteUserVerification(id)
 {
   $.ajax({
     type: "post",
     url: phpUrl,
     data: {idModalUser:id},
     success: function (response) {
       
       response=JSON.parse(response);
       $("#deletedUserName").html(response[0].First_Name+" "+response[0].Last_Name);
       $("#deletedUserCode").val(response[0].UserId);
     }
   });

 }

//delete User *
function DeleteUser(){
  deleteUserNumber=$("#deletedUserCode").val();
 $.ajax({
   type: "post",
   url: phpUrl,
   data: {
    ArchiveSelectedUser: "ArchiveSelectedUser",
    UserId:deleteUserNumber
     },
   success: function (response) {
   loadsAccount();     
   }
 });
}

function ModifySelectItems()
{
  
   $.ajax({
      type: "post",
      url: phpUrl,
      data: { ModifyAdmin:"ModifyAdmin" },
      success: function (response) {
        response = JSON.parse(response);
        response = response[0];
        $("#FNameAdmin").val(response.First_Name);
        $("#LNameAdmin").val(response.Last_Name);
        $("#EmailAdmin").val(response.Email);
        $("#HintAdmin").val(response.hint);

      }
    })
  
}
ModifySelectItems();
//modify User *
function ModifyUser() {
  var FirstName = $("#FNameAdmin").val();
  var LastName = $("#LNameAdmin").val();
  var Email = $("#EmailAdmin").val();
  var OldPassword=$("#PasswordAdmin").val();
  var NewPassword = $("#NewPasswordAdmin").val();
  var Hint = $("#HintAdmin").val();
if(NewPassword!="" && OldPassword!="")
{
  $.ajax({
    type: "post",
    url: phpUrl,
    data: {
      EditSelectedUser: "Edit",
      FirstName: FirstName,
      LastName: LastName,
      Email: Email,
      OldPassword:OldPassword,
      Password: NewPassword,
      Hint:Hint
    },
    success: function (response) {
      if(response == 'success') {
        window.location.href="./AccountSetting?Send";

        
      } else {
        $("#alertForPass").html("<div style='color:red'>please enter correct old password*</div>");
      }
    }
  });
}
else{
  $(".alertAddModal1").html("<div class='alert alert-danger'>Please enter password*</div>");
}
 
}

$(document).ready(function () {
  if(window.location.href.indexOf("Validate")>-1)
{
  $("#a2").trigger('click');
}
});
$(document).ready(function () {
  if(window.location.href.indexOf("Send")>-1)
{
  $("#a3").trigger('click');
}
});


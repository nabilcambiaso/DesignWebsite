//variables-----------------------------------
var phpUrl = "PhpFiles/Settings/category_products.service.php";
var globalCode=-1;
//on load *------------------------------------
var t = $("#showData");
$(".alerts").hide();
function loads() {
  $("#alert1").hide();
  t.html("");

  $.ajax({
    type: "post",
    url: phpUrl,
    data: { loadCategorys: "loadCategorys" },
    success: function (response) {
      console.log(response);
      response = JSON.parse(response);
      if (response.length == 0) {
        $(".CategoryEmpty").html(
          "<div class='alert alert-danger'>No Category Added !</div>"
        );
      } else {
        $.each(response, function (key, val) {
          t.append(`<tr>
            <td>${val.id}</td>
            <td>${val.catLabel}</td>
            <td>${val.catDate}</td>
            <td>
            <a onclick = "Load_Edit_Category('${val.id}')"   data-target="#editModal" data-toggle="modal">
            <i class='icon-edit font-large-1 blue')></i>
            </a>      
            </td>
            <td>
            <a onclick = "Load_Delete_Category('${val.id}')"  data-target="#deleteModal"  data-toggle="modal">
               <i class="fas fa-trash fa-2x red"></i>
            </a>
            </td>
            </tr>`);
        });
      }
    },
  });
}
// Load Page Data:
loads();

// Add New Data to Category List *
function AddCategory() {
  $("#alert1").hide();
  $("#alert2").hide();

  $.ajax({
    type: "post",
    url: phpUrl,
    data: {
      AddNewCategory: "AddNewCategory",
      Category_Name: $("#CategoryName").val()
    },
    success: function (response) {
      console.log(response);
      if (response == "success") {
        $("#exampleModal").modal("hide");
        $(".alerts").html(
          "<div class='alert alert-success'>A new Category has been Added succesfully</div>"
        );
        $(".alerts").slideDown();
        setTimeout(() => {
          loads();
        }, 100);

        setTimeout(() => {
          $(".alerts").hide();
        }, 7000);
        $("#CategoryName").val("");
      } else {
        $(".alertId").html(
          "<div class='row text-center alert alert-warning'>Warning: The Category Name already exists, Please try to enter a different one !</div>"
        );
      }
    },
  });
}

//Delete from Category List *
function Load_Delete_Category(code) {
  globalCode=code;
}

function Delete_Category()
{
  $.ajax({
    type: "post",
    url: phpUrl,
    data: {
      Delete_Category: "Delete_Category",
      Category_Id: globalCode,
    },
    success: function (response) {
      if (response == "success") {
        $(".alerts").html(
          "<div class='alert alert-success'>Category has been Deleted Successfully !</div>"
        );
        $(".alerts").slideDown();
        setTimeout(() => {
          $(".alerts").hide();
        }, 7000);
      } else {
        $(".alerts").html(
          "<div class='alert alert-danger'>Warning: Error Occured !</div>"
        );
        $(".alerts").slideDown();
        setTimeout(() => {
          $(".alerts").hide();
        }, 7000);
      }
    },
  });
  setTimeout(() => {
    loads();
  }, 300);
}
//edit from Category List *
function Load_Edit_Category(code) {
  globalCode=code;
}

//function edit category
function edit_Category()
{
  $.ajax({
    type: "post",
    url: phpUrl,
    data: {
      edit_Category: "edit_Category",
      Category_Id: globalCode,
      Category_Name:$("#inputCatNameEdit").val()
    },
    success: function (response) {
      if (response == "success") {
        $(".alerts").html(
          "<div class='alert alert-success'>Category has been edited Successfully !</div>"
        );
        $(".alerts").slideDown();
        setTimeout(() => {
          $(".alerts").hide();
        }, 7000);
      } else {
        $(".alerts").html(
          "<div class='alert alert-danger'>Warning: Error Occured !</div>"
        );
        $(".alerts").slideDown();
        setTimeout(() => {
          $(".alerts").hide();
        }, 7000);
      }
    },
  });
  setTimeout(() => {
    loads();
  }, 300);
}

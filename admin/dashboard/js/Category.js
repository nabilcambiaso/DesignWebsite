//variables-----------------------------------
var phpUrl = "PhpFiles/Settings/category.service.php";
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


/*
  $("#CategoryCountry, #Edit_CategoryCountry").html("");
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { loadCountrys: "loadCountrys" },
    success: function (response) {
      response=JSON.parse(response);
      console.log(response.length);
      if(response.length>0)
      {
        $.each(response, function (key, val) {
          $("#CategoryCountry, #Edit_CategoryCountry").append(
            "<option value='" +
              val.country_code +
              "'>" +
              val.country_name +
              "</option>"
          );
        });
      }
      else{
        $("#CategoryCountry, #Edit_CategoryCountry").append(
          "<option value=''>Must Add A country First</option>"
        );
      }

    }
  });
}

// Add New Data to Category List *
function AddCategory() {
  $("#alert1").hide();
  $("#alert2").hide();

  $.ajax({
    type: "post",
    url: phpUrl,
    data: {
      AddNewCategory: "AddNewCategory",
      Category_ID: $("#CategoryId").val(),
      Category_Name: $("#CategoryName").val(),
      Category_Country: $("#CategoryCountry option:selected").val(),
      Category_Address: $("#CategoryAddress").val(),
    },
    success: function (response) {
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
        $("#CategoryCountry option:selected").val("");
        $("#CategoryAddress").val("");
        Add_Event("Add New Category", `${$("#CategoryName").val()}`);
        $("#CategoryId").val("");
        $("#CategoryName").val("");
      }else if(response=='2'){
        $(".alertId").html(
          "<div class='row text-center alert alert-warning'>Warning: Add A country in the Country Page ! <a href='./country'><b>Country</b></a> </div>"
        );
      } else {
        $(".alertId").html(
          "<div class='row text-center alert alert-warning'>Warning: The Category id already exists, Please try to enter a different id!</div>"
        );
      }
    },
  });
}



//load Data Befor Make An Edit *
function Load_Edit_Category(id) {
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { loadCategory: "loadCategory", Category_ID: id },
    success: function (response) {
      var data = JSON.parse(response);
      $("#Edit_CategoryId").val(data.Category_id);
      $("#Edit_CategoryName").val(data.Category_name);
      $("#Edit_CategoryCountry").prepend(
        "<option selected value='" +
          data.country_code +
          "'>" +
          data.country_name +
          "</option>"
      );
      $("#Edit_CategoryAddress").val(data.Category_adress);
    },
  });
}

// Edit Category *
function Edit_Category() {
  $.ajax({
    type: "post",
    url: phpUrl,
    data: {
      Edite_Category: "Edite_Category",
      Category_ID: $("#Edit_CategoryId").val(),
      Category_Name: $("#Edit_CategoryName").val(),
      Category_Country: $("#Edit_CategoryCountry option:selected").val(),
      Category_Address: $("#Edit_CategoryAddress").val(),
    },
    success: function (response) {
      if (response == "success") {
        $("#editModal").modal("hide");
        setTimeout(() => {
          loads();
          Add_Event("Edit A Category", `${$("#Edit_CategoryName").val()}`);
          $(".alerts").html(
            "<div class='alert alert-success'>Category Information has been edited successfully</div>"
          );
          $(".alerts").slideDown();
          setTimeout(() => {
            $(".alerts").hide();
          }, 7000);
        }, 300);
      }
    },
  });
}

*/

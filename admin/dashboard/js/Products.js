// Design js
//variables-----------------------------------
var phpUrl = "PhpFiles/Products.service.php";
var globalId=-1;
// datatables---------------------------------
$("#example").dataTable();
var t = $("#example").DataTable();
//on load ------------------------------------
function loads() {
  t.clear().draw();
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { load: "load" },
    success: function (response) {
      $.each(JSON.parse(response), function (key, val) {
       
        t.row
          .add([
            "<br><br><a  style='width:100px; height:100px' href='assign?id=" +
              val.idProducts +
              "'>" +
              val.catLabel +
              "</a>",
            "<br><br><a  href='assign?id=" +
              val.idProducts +
              "'>" +val.label+
              "</a>",
              "<br><br>"+val.description,
              "<br><br>"+val.date,
            "<a data-toggle='modal' data-target='#detailModal'><img style='width:100px; height:100px' src='../../assets/img/products/"+val.image1+"' ></img></a>",
            "<br><br><a  onclick=detailsproduct('" +
              val.idProducts +
              "')><i class='fas fa-cog fa-2x'></i></a>",
            "<br><br><a data-toggle='modal' data-target='#deleteModal' onclick=CodeVerification('" +
            val.idProducts +
            "')><i class='fas fa-trash fa-2x'></i></a>"
          ])
          .draw(false);
      });
    },
  });
}
//call load
loads();

//load categories in the add modal
function loadCategories() {
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { loadCategories: "load" },
    success: function (response) {

      $.each(JSON.parse(response), function (key, val) {
        $("#productCategoryAdd").append(
          `<option value="${val.id}">${val.catLabel}</option>`
        );
      });
    },
  });
}
loadCategories();


// show images selected by input file *
$("#fileimagesAdd").change(function () {

  var i=0;
  var file1 = document.getElementById("fileimagesAdd").files;
  var fileLength=file1.length;
  var stinterval= setInterval(function () { 
  var reader = new FileReader();
     reader.onload = function () {
        
          $("#image" + i).attr("src", reader.result);
        }

       reader.readAsDataURL(file1[i]);
       i=i+1;
       if(i==fileLength)
       {
          clearInterval(stinterval);
       }
},100);
})




//verification delete Design *
function CodeVerification(id) {
globalId=id;
}
//delete Design *
function Deleteproduct() {
  $.ajax({
    type: "post",
    url: phpUrl,
    data: {
      deleteproduct: "delete",
      productId: globalId
    },
    success: function (response) {
      loads();
    },
  });
}

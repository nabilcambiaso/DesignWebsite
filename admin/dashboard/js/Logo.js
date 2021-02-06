//variables-----------------------------------
var phpUrl = "PhpFiles/Logo.service.php";



// load logo ------------------------------------
function loads() {
    $.ajax({
        type: "post",
        url: phpUrl,
        data: { loadLogo: "load" },
        success: function (response) {
            response=JSON.parse(response);
            $(".logoImg").html(`<img src=${"./../../assets/img/logo/"+response[0].logoLabel} width="300" >`);

        },
    });
}



//call load
loads();
// show images selected by input file *
$("#fileimagesAdd").change(function () {

    var i = 0;
    var file1 = document.getElementById("fileimagesAdd").files;
    var fileLength = file1.length;
    var stinterval = setInterval(function () {
        var reader = new FileReader();
        reader.onload = function () {

            $("#image" + i).attr("src", reader.result);
        }

        reader.readAsDataURL(file1[i]);
        i = i + 1;
        if (i == fileLength) {
            clearInterval(stinterval);
        }
    }, 100);
})
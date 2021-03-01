const phpUrl="./phpFiles/details.service.php";
var urlString=window.location.href;
var url=new URL(urlString).searchParams.get("id");
var urlType=new URL(urlString).searchParams.get("type");
//if the id doesn't fill or doesn't exist , redirect to the main page
if(url==null || url=="")
{
    window.location.href="./";
}
else{
    if(urlType=="1")
    {
    function load() { 

        $.ajax({
            type: "post",
            url: phpUrl,
            data: {loadDetails:"load",
            idDesign:url
            },
            success: function (response) {
                response=JSON.parse(response);
                console.log(response[0]);
                $("#carosuelimg1").append(`
                <img  src="assets/img/designs/${response[0].image1}" class="d-block w-100" alt="design">
                `);
                if(response[0].image2=="")
                {
                    $("#carosuelimg2").append(`
                    <img  src="assets/img/designs/${response[0].image1}" class="d-block w-100" alt="design">
                    `);
                }
                else{
                    $("#carosuelimg2").append(`
                    <img  src="assets/img/designs/${response[0].image2}" class="d-block w-100" alt="design">
                    `);
                }
                if(response[0].image3=="")
                {
                    $("#carosuelimg3").append(`
                    <img  src="assets/img/designs/${response[0].image1}" class="d-block w-100" alt="design">
                    `);
                }
                else{
                    $("#carosuelimg3").append(`
                    <img  src="assets/img/designs/${response[0].image3}" class="d-block w-100" alt="design">
                    `);
                }
                $("#lblId").html(response[0].label);
                $("#counter").html(response[0].likes);
            }
        });
     }
    }
    else{
        function load() { 

            $.ajax({
                type: "post",
                url: phpUrl,
                data: {loadProducts:"load",
                idProduct:url
                },
                success: function (response) {
                    response=JSON.parse(response);
                    console.log(response[0]);
                    $("#carosuelimg1").append(`
                    <img  src="assets/img/products/${response[0].image1}" class="d-block w-100" alt="products">
                    `);
                    if(response[0].image2=="")
                    {
                        $("#carosuelimg2").append(`
                        <img  src="assets/img/products/${response[0].image1}" class="d-block w-100" alt="products">
                        `);
                    }
                    else{
                        $("#carosuelimg2").append(`
                        <img  src="assets/img/products/${response[0].image2}" class="d-block w-100" alt="products">
                        `);
                    }
                    if(response[0].image3=="")
                    {
                        $("#carosuelimg3").append(`
                        <img  src="assets/img/products/${response[0].image1}" class="d-block w-100" alt="products">
                        `);
                    }
                    else{
                        $("#carosuelimg3").append(`
                        <img  src="assets/img/products/${response[0].image3}" class="d-block w-100" alt="products">
                        `);
                    }
                    $("#lblId").html(response[0].label);
                    $("#counter").html(response[0].likes);
                }
            });
         } 
    }
     load();
}
function sendMessages()
{
    
    $.ajax({
        type: "post",
        url: "phpFiles/sendEmail.php",
        data: {
            sentMessage:"sent",
            fullName:$("#fullName").val(),
            from:$("#fromEmail").val(),
            message:$("#messageEmail").val(),
            subject:$("#fromSubject").val(),
            telephone:$("#telephoneEmail").val(),
            url:urlString
        },
        success: function (response) {
            $("#fullName").val("");
            $("#fromEmail").val(""),
            $("#messageEmail").val(""),
            $("#fromSubject").val(""),
            $("#telephoneEmail").val("")
        }
    });
}


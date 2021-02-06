$(function(){
    //--write names in their places
  $(".UserName").html(sessionStorage.getItem("Name"));
    //logout button 
    $(".Logout").click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: ".././crud/authentication.php",
            data: {
                Logout:"Logout"
            },
            success: function (response) {
                sessionStorage.clear();
                window.location.href=".././";
            }
        });
        
    });

})



// load logo ------------------------------------
function loads() {
    $.ajax({
        type: "post",
        url: "PhpFiles/Logo.service.php",
        data: { loadLogo: "load" },
        success: function (response) {
            response=JSON.parse(response);
            console.log(response);
            $(".logoImg").html(`
            <img alt="branding logo" src=${"./../../assets/img/logo/"+response[0].logoLabel} class="brand-logo logo1" width="150">`);
            $(".logoImg2").html(`
            <img src=${"./../../assets/img/logo/"+response[0].logoLabel} alt="avatar"></img>`);


        },
    });
}



//call load
loads();
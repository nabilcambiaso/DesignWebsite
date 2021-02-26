

// load logo ------------------------------------
function loads() {
    $.ajax({
        type: "post",
        url: "./PhpFiles/master.service.php",
        data: { loadLogo: "load" },
        success: function (response) {
            response=JSON.parse(response);
            $("#logoMaster").html(`
            <a href="./"><img src=${"./assets/img/logo/"+response[0].logoLabel} width="100px" alt="benaji" title="logo" /></a>`);
            
            
        },
    });
}
loads();
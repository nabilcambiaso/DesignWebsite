
$("#sendMessage").click(function (e) { 
    $.ajax({
        type: "post",
        url: "phpFiles/sendEmail.php",
        data: {
            sentMessage:"sent",
            fullName:$("#fullName").val(),
            from:$("#fromEmail").val(),
            message:$("#messageEmail").val(),
            subject:$("#fromSubject").val(),
            telephone:$("#telephoneEmail").val()
        },
        success: function (response) {
            console.log(response);
        }
    });  
});


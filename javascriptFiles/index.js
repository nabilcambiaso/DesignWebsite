const phpUrl="./phpFiles/index.service.php";

function load() {
$.ajax({
    type: "post",
    url: phpUrl,
    data: {load:"load"},
    success: function (response) {
        response=JSON.parse(response);
        $.each(response, function (key, val) { 
             $(".threeLatestDesigns").append(`
             <div class="col-md-6 col-lg-4">
             <div class="block-blog text-center" >
               <a href="./design"><img src="assets/img/designs/${val.image1}" style="width:350px;height:250px;" class="img-responsive" alt="img"></a>
               <div class="content-blog">
                 <h4 style="color:#329178;">${val.label}</h4>
                 <h6>${val.description}</h6>
                 <br>
                 <span style="color:#C8C8C8;">${val.date}</span>
                 <a class="pull-right readmore" style="color:#71C55D;" href="./design">See More Designs</a>
               </div>
             </div>
           </div>
             `);
        });
    }
});
  }
  load();

  function sendmessage()
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
            url:''
        },
        success: function (response) {
            console.log(response);
        }
    });
}
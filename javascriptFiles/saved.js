const phpUrl="./phpFiles/saved.service.php";
if(localStorage.getItem("savedItems")!=null)
{
    var savedItems=JSON.parse(localStorage.getItem("savedItems"));
    loadSaved(savedItems);
 console.log(savedItems);
}else{
    $(".designsSavedCards").append(`<div data-aos="fade-up" class="col-md-12">
    <span class="alert alert-warning">No saved Items !</span></div>`);
}

function loadSaved(array)
{
    $.ajax({
        type: "post",
        url: phpUrl,
        data: {saved:array},
        success: function (response) {
            response=JSON.parse(response);
            $.each(response, function (key, val) { 
                 $(".designsSavedCards").prepend(`
                 <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                     <div class="feature-block">
                         <img src="assets/img/designs/${val.image1}" alt="img" style="width:100%;">
                         <h4>${val.label}</h4>
                         <a href="./details?id=${val.idDesign}">See More</a>
                     </div>
                 </div> 
                 `);
            });
        }
    });
}
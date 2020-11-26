
//show hide logo on click on the i three lines
$(".showHide").click(function (e) {
    e.preventDefault();
    $(".logo1").toggle();
  });


  var url=window.location.href;
  //toggle the active class state from dashboard template
  if(url.indexOf("employee")>-1)
  {
    $(".navigateEmployee").attr("class", "active");
  }
  else if(url.indexOf("products")>-1)
  {
    $(".navigateProducts").attr("class", "active");
  }
  else if(url.indexOf("country")>-1 || url.indexOf("departement")>-1 || url.indexOf("location")>-1){
    $(".navigateGeneral").css("background", "#009879");
  }



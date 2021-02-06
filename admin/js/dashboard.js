
//show hide logo on click on the i three lines
$(".showHide").click(function (e) {
    e.preventDefault();
    $(".logo1").toggle();
  });


  var url=window.location.href;
  //toggle the active class state from dashboard template

  if(url.indexOf("design")>-1 )
  {
    $(".navigateDesign").attr("class", "active");
  }
  else if(url.indexOf("products")>-1)
  {
    $(".navigateProducts").attr("class", "active");
  }
 


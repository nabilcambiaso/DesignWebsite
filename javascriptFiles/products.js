const phpUrl="./phpFiles/products.service.php";
var searchs="";
var newId="";
function load(id,search) { 
    $.ajax({
        type: "post",
        url: phpUrl,
        data: {load:"load",
        productsId:id,
        search:search
    },
        success: function (response) {
            response=JSON.parse(response);
            $(".productsPic").html("");
            $.each(response, function (key, val) { 
              
                 $(".productsPic").append(`
                 <div style="margin-top:18px; cursor:pointer;" class="col-md-4 col-sm-6 col-xs-6 col-lg-3 designCard" data-aos="zoom-in" data-aos-delay="100">
      <div class="team-block bottom">
         <!--picture here -->
         <a href="./details?id=${val.idProducts}"><img src="assets/img/products/${val.image1}" style="width:100%; cursor:pointer;" title="See More !" class="img-responsive" alt="img"></a>
        <div class="team-content">
          <ul class="list-unstyled">
            <li>
            <div>
            <a title="Like" onclick="like(${val.idProducts})"><i style="margin-bottom:-22px;" class="fa fa-heart"></i></a>
              <!--likes Number Here -->
              <div class="fa-layers-counter" id="counter${val.idProducts}" style="color:#FF797E; font-weight:bold;  margin-left:22px; margin-top:-22px;">${val.likes}</div>
            </div>
           </li>
            <li><a title="Send Email About this Design" href="./details?id=${val.idProducts}">       
               <i class="fa fa-envelope"></i></a>
            </li>
            <li><a class="savedBookmark" onclick="saveDesign(${val.idProducts})" ><i class="fa fa-bookmark"></i></a></li>

          </ul>
          <h4>${val.label}</h4>
          <span>${val.description}</span>

        </div>
      </div>
    </div>
                 `);
            });
        }
    });
}
load(newId,searchs);

//function load Categories
function loadCategories() {
    $.ajax({
        type: "post",
        url: phpUrl,
        data: {loadCategories:"load"},
        success: function (response) {
            response=JSON.parse(response);
            $.each(response, function (key, val) { 
                 $("#selectCategoryProducts").append(`
                 <option value="${val.id}">${val.catLabel}</option>
                 `);
            });
        }
    });
  }
  loadCategories();

  $("#selectCategoryProducts").change(function (e) { 
      e.preventDefault();
     newId= $("#selectCategoryProducts").val();
     searchs="";
      load(newId,searchs);
  });

  $("#SearchDesignInput").on("input", function () {
       searchs=$("#SearchDesignInput").val();
      load(newId,searchs);
  });

  //like designs function
  function like(id) {
      if(localStorage.getItem("key"+id)==null)
      {
       localStorage.setItem("key"+id,"1");
    localStorage.setItem("key"+id,"1");
      $.ajax({
          type: "post",
          url: phpUrl,
          data: {like:"like",
          likeId:id},
          success: function (response) {
              console.log(response);
              var counter= parseInt($("#counter"+id).text())+1;
              $("#counter"+id).html(counter.toString());
          }
      });
    }
  }
  //fill local storage with saved designs
   function saveDesign(id) { 
     if(localStorage.getItem("savedItems")==null)
     {
       var savedItems=[];
       savedItems.push(id);
       localStorage.setItem("savedItems",JSON.stringify(savedItems));
     }
     else
     {
       var exist=-1;
      var retrievedData =JSON.parse(localStorage.getItem("savedItems"));
      retrievedData.forEach(element => {
        if(element==id)
        {
          exist=1;
        }
      });
      if(exist==-1)
      {
        retrievedData.push(id);
        localStorage.setItem("savedItems",JSON.stringify(retrievedData));
      }
     }
  }
 
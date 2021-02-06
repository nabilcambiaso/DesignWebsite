<?php include '../crud/dashboardTemplate.php'?>
<?php nav() ?>
<div class="container">
   <div class="container mt-3">
      <div class="row">
         <div class="container alerts" style="display: inline;">
         </div>
      </div>
     
      <button type="button" class="btn btn-success btn-small mb-4 " data-toggle="modal" data-target="#updateLogo">
        <span><i class="icon-plus"></i></span> Update Logo
      </button>
      <br /><br />
      <div class="row">
      <div class="col-md-12">
      <div class="col-md-12">
      <hr>
      </div>
      <h1>Current Logo :</h1>
      <hr>

      </div>
         <div class="col-md-12">
            <div class='logoImg'>
             
            </div>
         </div>
         
      </div>
   </div>

<!--update logo modal-->
   <div class="modal fade" id="updateLogo" tabindex="-1" role="dialog" aria-labelledby="updateLogoLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="updateLogoLabel"><span><i class="icon-pencil2"></i> Update Application Logo </span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <!-- add new Modal *********************-->
         <div class="modal-body">
            <!-- form-->
            <div class="container">
            <form method="post" action="phpFiles/Logo.service.php" enctype="multipart/form-data">
                  <div class="row">
                  <div class="form-group col-md-12">
                <label style="cursor:pointer;" class="form-control" for="fileimagesAdd"> Update Logo <sup>*</sup>&nbsp; <i class="icon-image"></i></label>
                                <div class="controls">
                                    <input type="file" hidden id="fileimagesAdd" name="image[]"   value="select 3 images"  multiple>
                                </div>
                </div>
                <div class="form-group col-md-12">
                <div class="controls">          
                                        <div class="col-md-4"><img class="form-control" src="" alt="" id="image1" 
                                        style="width: 100px; border: 1px dotted gray; padding-right: 10px;"></div>
                              
                </div>
                </div>
                  </div>
                

                  <div class="row">
                     <div class="alertAddModal"></div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                     </button>
                     <button type="submit" name="updateLogo" class="btn btn-primary">
                        Validate
                     </button>
                  </div>
               </form>
            </div>
         </div>

</div>
      </div>
   </div>
</div>
 
<!--scripts here -->
<script src="./js/Logo.js"></script>
<?php footer() ?>
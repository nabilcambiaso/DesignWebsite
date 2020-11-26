<?php include '../crud/dashboardTemplate.php'?>
<?php nav() ?>
<div class="container">
   <div class="container mt-3">
      <div class="row">
         <div class="container alerts" style="display: inline;">
         </div>
      </div>
      <button type="button" class="btn btn-success btn-small mb-4 " data-toggle="modal" data-target="#exampleModal">
        <span><i class="icon-plus"></i></span> Add New Category
      </button>
      <br /><br />
      <div class="row">
         <div class="col-md-12">
            <div class='table-responsive'>
               <table class='table table-striped'>
                  <thead>
                     <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Added At :</th>
                        <th>Edit</th>
                        <th>Remove</th>
                     </tr>
                  </thead>
                  <tbody id="showData">
                  </tbody>
               </table>
            </div>
         </div>
         <div class="container">
            <div class="row">
               <br>
               <br>
               <div class="col-md-12 CategoryEmpty"></div>
               <br>
               <br>
               <br>

            </div>
         </div>
      </div>
   </div>
   <!--end Main Content ____-->
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Add New Category *</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <!-- add new Modal *********************-->
            <div class="modal-body">
               <!-- form-->
               <div class="container">
                  <form>
                     <div class="form-group">
                        <label>Category Name <span class="verified"> *</span></label>
                        <input type="text" class="form-control" id="CategoryName" required />
                     </div>
                     <div class="container alertId">
                     </div>

                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                           Close
                        </button>
                        <button type="submit" class="btn btn-primary" onclick="AddCategory()">
                           Validate Action
                        </button>
                     </div>
                     </from>
               </div>
            </div>
         </div>
      </div>
   </div>



   <!--delete Modal -->
   <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Delete Category *</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <!-- delete new Modal *********************-->
            <div class="modal-body">
               <!-- form-->
               <div class="container">
                  <form>
                     <div class="form-group">
                        <h3 class="red"><span><i class="icon-trash-a"></i></span>Are You Sure You Want To Delete This Category ?</h3>
                     </div>
                     
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                           Close
                        </button>
                        <button type="submite" data-dismiss="modal" class="btn btn-primary" onclick="Delete_Category()">
                           Validate Action
                        </button>
                     </div>
                     </from>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!--edit Modal -->
   <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Category *</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <!-- edit new Modal *********************-->
            <div class="modal-body">
               <!-- form-->
               <div class="container">
                  <form>
                     <div class="form-group">
                     Category Name : <input type="text" id="inputCatNameEdit">
                     </div>
                     
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                           Close
                        </button>
                        <button type="submite" data-dismiss="modal" class="btn btn-primary" onclick="edit_Category()">
                           Validate Action
                        </button>
                     </div>
                     </from>
               </div>
            </div>
         </div>
      </div>
   </div>

</div>
<!--scripts here -->
<script src="js/Category.js"></script>
<?php footer() ?>
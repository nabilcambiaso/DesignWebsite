<?php include '../crud/dashboardTemplate.php'?>
<!--css style -->
<style>
   textarea {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      width: 100%;
   }

   td,
   th {
      font-size: smaller;
      text-align: center;
   }

   #tableModalDetails td {
      text-align: left;
   }

   #tableModalHeadDetails th {
      font-size: larger;
      color: #5a95d9;
   }

   #detailCloseButton {
      border: #da4453 1px solid;
      border-radius: 4px;
      color: #da4453;
   }

   #EditModalLabel {
      color: #5a95d9;
   }

   #spanExport {
      font-size: larger;
   }

   .labelLinkDesign {
      text-align: center;
   }

   .filterToggle:hover {
      background-color: #E7E7E7;
   }
</style>
<?php nav(); ?>
<!--modal delete Design -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="modal-title" id="deleteModalLabel"><i class="fas fa-trash fa-1x"></i> Delete Design</h3>
         </div>
         <div class="modal-body">
            <div class="container">
               <h4><i class="fas fa-exclamation-triangle red"></i> Are You sure You Want To Delete <span
                     style=" font-family: 'Times New Roman', Times, serif;" id="deletedDesignName"></span> From
                  Designs List ?</h4>
               <input type="text" id="deletedDesignCode" hidden>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" id="detailCloseButton" class="btn btn-secondary" data-dismiss="modal">
               Cancel
            </button>
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Delete" onclick="DeleteDesign()">
         </div>
      </div>
   </div>
</div>
<!--end modal delete Design  -->

<!-- success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content grey">

         <div class="modal-body transparent">
            <div class="container">
               <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6"><i class="icon-checkmark font-large-5 green"></i></div>
                        <div class="col-md-3"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3"></div>
            </div>
            <div class="row">
               <div class="col-md-3"></div>
               <div class="col-md-6">
                  <h1 class="black">Assigned Successfully</h1>
               </div>
               <div class="col-md-3"></div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- main content _____________________________-->
<div class="main">
   <!--main here -->
   <!-- Button trigger modal -->
   <button type="button" hidden class="btn btn-primary" data-toggle="modal" id="SuccesAssign"
      data-target="#successModal">
   </button>

   <!-- add button * -->
   <div class="row">
      <button type="submit" class="btn btn-success btn-small mb-4 " data-toggle="modal" data-target="#addDesignModal"
         onclick="fillSelectItems('none')">
         <i class="icon-plus"></i>
         Add New Design
      </button>
      <br /><br />
   </div>


   <!--table Design *-->
   <table class="table table-striped" id="example">
      <thead>
         <tr>
            <th>Design Id</th>
            <th>Design Label</th>
            <th>Added At</th>
            <th>Description</th>
            <th>Image</th>
            <th>Operations</th>
         </tr>
      </thead>
      <tbody id="tbodyInfos"></tbody>
   </table>
</div>
<!--end Main Content ____________________________-->


<!-- Modal Add new Design _____________________________________________________________________________-->
<div class="modal fade" id="addDesignModal" tabindex="-1" role="dialog" aria-labelledby="addDesignModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="addDesignModalLabel"><span><i class="icon-pencil2"></i> Add New Design </span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <!-- add new Modal *********************-->
         <div class="modal-body">
            <!-- form-->
            <div class="container">
               <form>
                  <div class="row">
                  <div class="form-group col-md-12">
                <label style="cursor:pointer;" class="form-control" for="fileimagesAdd"> Add Pictures <sup>*</sup>&nbsp; <i class="icon-image"></i></label>
                                <div class="controls">
                                    <input type="file" hidden id="fileimagesAdd" name="image[]"   value="select 4 images"  multiple>
                                </div>
                </div>
                <div class="form-group col-md-12">
                <div class="controls">          
                                        <div class="col-md-3"><img class="form-control" src="" alt="" id="image1" 
                                        style="width: 100px; border: 1px dotted gray; padding-right: 10px;"></div>
                                        <div class="col-md-3"><img class="form-control" src="" alt="" id="image2" 
                                        style="width: 100px; border: 1px dotted gray; padding-right: 10px;"></div>
                                        <div class="col-md-3"><img class="form-control" src="" alt="" id="image3" 
                                        style="width: 100px; border: 1px dotted gray; padding-right: 10px;"></div>
                                        <div class="col-md-3"><img class="form-control" src="" alt="" id="image4" 
                                        style="width: 100px; border: 1px dotted gray; padding-right: 10px;"></div>
   
                </div>
                </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Design Label <span class="verified"><i class="icon-eye"></i></span></label>
                        <input type="text" class="form-control" id="DesignFNameSubscribe" aria-describedby="emailHelp"
                           required />
                     </div>

                     <div class="form-group col-md-6">
                     <label for="exampleInputEmail1">Design Category <span class="verified"><i class="icon-sina-weibo"></i></span></label>
                     <select name="line" class="form-control" id="designCategories">
                        <!--categories here-->
                     </select>
                     </div>
                  </div>

                  <div class="row">
                   <div class="form-group">
                     <label for="exampleInputEmail1">Design Description <span class="verified"><i class="icon-paper"></i></span></label>
                     <br />
                     <textarea name="Adress" id="AdressSubscribe" cols="83" rows="3" required></textarea>
                   </div>
                  </div>

                  <div class="row">
                     <div class="alertAddModal"></div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                     </button>
                     <button type="button" class="btn btn-primary" onclick="AddDesign()">
                        Validate
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!--end Modal Add new Design___________________________________________________________________________-->

<!--modal2 Design details -->
<div class="modal modalD fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="designDetailsLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="desinDetailsLabel">Design Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="container">
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead id="tableModalHeadDetails">
                        <tr>
                           <th colspan="2">Informations</th>
                        </tr>
                     </thead>
                     <tbody id="tableModalDetails"></tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" id="detailCloseButton" class="btn btn-secondary" data-dismiss="modal modalD">
               Close
            </button>
         </div>
      </div>
   </div>
</div>
<!--end modal 2 Design details -->


<!-- Modal Edit Selected Design _____________________________________________________________________________-->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="EditModalLabel"><i class='icon-edit font-large-0 blue '></i> Edit Design *
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <!--  edit Modal *********************-->
         <div class="modal-body">
            <!-- form-->
            <div class="container">
               <form>
                  <div class="row">
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">First Name <span class="verified"> *</span></label>
                        <input type="text" class="form-control" id="DesignFNameEdit" aria-describedby="emailHelp"
                           required />
                     </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Last Name <span class="verified"> *</span></label>
                        <input type="text" class="form-control" id="DesignLNameEdit" aria-describedby="emailHelp"
                           required />
                     </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Email Adress <span class="verified"> *</span></label>
                        <input type="Email" class="form-control" id="EmailEdit" aria-describedby="emailHelp" required />
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Line Manager <span class="verified"> *</span></label>
                     <select name="line" class="form-control" id="lineEdit">
                        <!--line manager here-->
                     </select>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Departement <span class="verified"> *</span></label>
                        <select name="Departement" class="form-control" id="DepartementEdit">
                           <!--departments here-->
                        </select>
                     </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Country <span class="verified"> *</span></label>
                        <select name="Country" class="form-control" id="countryEdit">
                           <!--Country here-->
                        </select>
                     </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Location <span class="verified"> *</span></label>
                        <select name="location" class="form-control" id="locationEdit">
                           <!--location here-->
                        </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Mobile Number <span class="verified"> *</span></label>
                        <input type="number" class="form-control" id="MobileEdit" aria-describedby="emailHelp"
                           required />
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Short Number <span class="verified"> *</span></label>
                        <input type="number" class="form-control" id="shortNumberEdit" aria-describedby="emailHelp"
                           required />
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Job Position <span class="verified"> *</span></label>
                        <select name="jobPosition" class="form-control" id="jobPositionEdit">
                           <!--position here-->
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Nationality <span class="verified"> *</span></label>
                        <select name="nationality" class="form-control" id="nationalityEdit">
                           <!--nationality here -->
                        </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Joining Date <span class="verified"> *</span></label>
                        <br />
                        <input type="date" class="datepicker" id="DateEdit" />
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Adress <span class="verified"> *</span></label>
                     <br />
                     <textarea name="Adress" id="AdressEdit" cols="60" rows="3" required></textarea>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                     </button>
                     <button type="button" class="btn btn-primary" onclick="ModifyDesign()">
                        Modify
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!--end Modal Edit Selected Design___________________________________________________________________________-->



<!-- Modal Assign Material to Design _____________________________________________________________________________-->
<div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="modal-title" id="assignModalLabel"><i class='icon-desktop font-large-0 grey '></i>&nbsp; Assign
               Products </h3>
         </div>
         <!--  assign Modal *********************-->
         <div class="modal-body">
            <!-- form-->
            <div class="container">
               <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                     <h2><i class="icon-cog font-large-5 grey"></i><i class="icon-desktop font-large-5 grey"></i><i
                           class="icon-tablet font-large-5 grey"></i><i class="icon-printer font-large-5 grey"></i></h2>
                  </div>
                  <div class="col-md-2"></div>
               </div>
               <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8 grey labelLinkDesign">Link Hardware and Software to <span id="fnameDesign"
                        class="black"></span><span> </span><span id="lnameDesign" class="black"></span> </div>
                  <div class="col-md-2"></div>
               </div>
               <div class="row">

                  <div class="form-group">
                     <select class="form-control" id="categoryAssign">
                     </select>
                  </div>
                  <div class="form-group">
                     <!--hardware assign -->
                     <div class="hardwareAssign">
                        <hr>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-md-4"><label for="" class="form-control white bg-grey">Product Asset
                                    Type</label></div>
                              <div class="col-md-8">
                                 <select class="form-control" id="HadwareAssetTypeAssign">
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="form-group">
                           <div class="row">
                              <div class="col-md-4"><label for="" class="form-control white bg-grey">Product Model Name
                                 </label></div>
                              <div class="col-md-8">
                                 <select class="form-control" id="HardwareModelNameAssign">
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="form-group">
                           <div class="row">
                              <div class="col-md-4"><label for="" class="form-control white bg-grey">Product Serial
                                    Number</label></div>
                              <div class="col-md-8">
                                 <select class="form-control" id="HadwareSerialAssign">
                                 </select>
                              </div>
                           </div>
                        </div>

                        <div class="form-group">
                           <div class="row">
                              <div class="col-md-4"><label for="" class="form-control white bg-grey">Product Condition
                                 </label></div>
                              <div class="col-md-8">
                                 <select class="form-control" id="assetConditionAssign">
                                    <option value="Brand-New">Brand New</option>
                                    <option value="Excellent">Excellent</option>
                                    <option value="Good">Good</option>
                                    <option value="Poor-Condition">Poor Condition</option>
                                 </select>
                              </div>
                              <div class="col-md-12">
                                 <hr>
                              </div>
                           </div>
                        </div>

                        <div class="form-group">
                           <div class="row">
                              <div class="col-md-3 "><span class="form-control">&nbsp; <input type="checkbox"
                                       id="antivirusCheck"> &nbsp; Antivirus </span></div>
                              <div class="col-md-3"><span class="form-control">&nbsp; <input type="checkbox"
                                       id="zipChek"> &nbsp; 7 Zip </span></div>
                              <div class="col-md-3"><span class="form-control">&nbsp; <input type="checkbox"
                                       id="sapCheck"> &nbsp; SAP GUI </span></div>
                              <div class="col-md-3"><span class="form-control">&nbsp; <input type="checkbox"
                                       id="vpnCheck"> &nbsp; VPN </span><br></div>
                           </div>

                           <div class="row">
                              <div class="col-md-3 "><span class="form-control">&nbsp; <input type="checkbox"
                                       id="opCheck"> &nbsp; Operating System </span></div>
                              <div class="col-md-3"><span class="form-control">&nbsp; <input type="checkbox"
                                       id="firewallCheck"> &nbsp; Firewall Disabled </span></div>
                              <div class="col-md-3"><span class="form-control">&nbsp; <input type="checkbox"
                                       id="adbCheck"> &nbsp; Adobe Reader </span><br></div>
                              <div class="col-md-3"><span class="form-control">&nbsp; <input type="checkbox"
                                       id="removedCheck"> &nbsp; Removed banned apps </span><br></div>

                           </div>
                           <div class="row">
                              <div class="col-md-4 "><span class="form-control">&nbsp; <input type="checkbox"
                                       id="encryptionCheck"> &nbsp; Encryption </span></div>
                              <div class="col-md-4"><span class="form-control">&nbsp; <input type="checkbox"
                                       id="printersCheck"> &nbsp; Printers </span></div>
                              <div class="col-md-4"><span class="form-control">&nbsp; <input type="checkbox"
                                       id="assetTagCheck"> &nbsp; Asset Tag </span><br></div>
                           </div>
                           <div class="row ">
                              <div class="col-md-8"><span class="form-control">&nbsp; <input type="checkbox"
                                       id="domainCheck"> &nbsp; Domain/Local User added to Local Users & Groups </span>
                              </div>
                              <div class="col-md-4"><span class="form-control">&nbsp; <input type="checkbox"
                                       id="adminCheck"> &nbsp; Admin Rights </span></div>
                           </div>


                        </div>
                        <div class="alertDesignAdd"></div>

                     </div>
                  </div>
                  <!-- software assign -->
                  <div class="SoftwareAssign">
                     <hr>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-4"><label for="" class="form-control white bg-grey">Software Name</label>
                           </div>
                           <div class="col-md-8">
                              <select class="form-control" id="SoftwareModelNameAssign"></select>
                           </div>
                        </div>
                     </div>

                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-4"><label for="" class="form-control white bg-grey">Software Serial
                                 Number</label></div>
                           <div class="col-md-8">
                              <select class="form-control" id="SoftwareSerialAssign">
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-4"><label for="" class="form-control white bg-grey">Installed By</label>
                           </div>
                           <div class="col-md-8">
                              <input class="form-control" id="installedByAssign" type="text">
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="alertDesignAdd"></div>

                  </div>



                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                     </button>
                     <button type="button" class="btn btn-primary" onclick="assignProduct()">
                        Assign Product
                     </button>
                  </div>

               </div>
            </div>
         </div>
      </div>
   </div>
   <!--end Modal assign material to Design___________________________________________________________________________-->



   <!-- Button trigger modal -->


   <!--scripts -->
   <script src="js/Design.js"></script>
   <?php footer() ?>
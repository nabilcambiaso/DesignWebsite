<?php
include '../crud/dashboardTemplate.php';
if($_SESSION["admin"]!='0'){
    // redirect them to your desired location
    header('location:./index');
    exit;
}
?>
<?php nav(); ?>
<style>
   @font-face {

      src: url('https://css-tricks.com/examples/RoundButtons/fonts/fontello.eot');
      src: url('https://css-tricks.com/examples/RoundButtons/fonts/fontello.eot?#iefix') format('embedded-opentype'),
         url('https://css-tricks.com/examples/RoundButtons/fonts/fontello.woff') format('woff'),
         url('https://css-tricks.com/examples/RoundButtons/fonts/fontello.ttf') format('truetype'),
         url('https://css-tricks.com/examples/RoundButtons/fonts/fontello.svg#fontello') format('svg');

   }

   [class*="icon-home"],
   [class*="icon-cog"],
   [class*="icon-cw"],
   [class*="icon-location1"],
   [class*="icon-Histor"] {
      font-family: 'fontello';
      font-style: normal;
      font-size: 3em;
      speak: none;
   }

   li {
      font-weight: 700;
   }

   .icon-home:after {
      content: "\1F4AC";
   }

   .icon-cog:after {
      content: "\1F465";
   }

   .icon-cw:after {
      content: "\1F527";
   }

   .icon-location1:after {
      content: "\2B05";
   }

   .icon-Histor:after {
      content: "\1F4D5";
   }

   * {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      margin: 0;
      padding: 0;
   }

   a {
      text-decoration: none;
      color: #DD6C4F;
   }

   a:hover {
      text-decoration: underline;
   }

   a:focus {
      outline: none;
   }

   .na1 {
      list-style: none;
      text-align: center;
   }

   .na1 li {
      position: relative;
      display: inline-block;
      margin-right: -4px;
      transition: all .4s ease-in-out;
   }

   .na1 li:before {
      content: "";
      display: block;
      border-top: 1px solid #ddd;
      border-bottom: 1px solid #fff;
      width: 100%;
      height: 1px;
      position: absolute;
      top: 50%;
      z-index: -1;
   }

   .na1 a {
      transition: all .4s ease-in-out;
   }

   .na1 a:link,
   .na1 a:visited {
      display: block;
      background-color: #C4C8CB;
      color: #009879;
      margin: 36px;
      width: 144px;
      height: 144px;
      position: relative;
      text-align: center;
      line-height: 144px;
      border-radius: 50%;
      box-shadow: 0px 10px 22px #aaa, inset 0px 8px 22px #ddd;
      border: solid 1px transparent;
   }

   .na1 a:before {
      content: "";
      display: block;
      background: #fff;
      border-top: 2px solid #ddd;
      position: absolute;
      top: -18px;
      left: -18px;
      bottom: -18px;
      right: -18px;
      z-index: -1;
      border-radius: 50%;
      box-shadow: inset 0px 8px 48px #ddd;
   }

   .na1 a:active {
      box-shadow: inset 0px 32px 64px #ddd;
   }

   .na1 a:hover {
      text-decoration: none;
      color: #555;
      background: #009879;
   }

   < .na1 a.current {
      box-shadow: inset 0px 32px 64px #ddd;
   }
</style>

<style>
   #btnDel {
      display: none;
      position: absolute;
      right: 5px
   }

   .tdS,
   .thS {
      font-size: smaller;
      text-align: center;
      justify-content: space-between;
      display: flex;
   }

   #myIcon,
   input[type='checkbox'] {
      cursor: pointer;
   }

   input[type='checkbox'] {
      border: 1px solid blue;
   }
</style>
<script>
   $(document).ready(function () {
      $("#a1").click(function () {
         $('#table1').hide();
         $('#Settings').hide();
         $('#History').hide();
         $('#table').show();
      });
      $("#a2").click(function () {
         $('#table').hide();
         $('#Settings').hide();
         $('#History').hide();
         $('#table1').show();
      });
      $("#a3").click(function () {
         $('#table').hide();
         $('#table1').hide();
         $('#History').hide();
         $('#Settings').show();

      });

      $("#a4").click(function () {
         $('#table').hide();
         $('#table1').hide();
         $('#Settings').hide();
         $('#History').show();

      });

      $("#Close").click(function () {
         $('#table').hide();
         $('#table1').hide();
         $('#Settings').hide();

      });


   });
   function check(input) {
      if (input.value != document.getElementById('PasswordSubscribe').value) {
         input.setCustomValidity('Password Must be Matching.');
      } else {
         // input is valid -- reset the error message
         input.setCustomValidity('');
      }
   }
</script>
<div class="main">
   <!--main here -->
   <div class="row" id="tableid">

      <div class="sub-main">
         <ul class="na1">
            <li>Deleted Employees<a href="#" id="a1" class="icon-home current"></a></li>
            <li>Create Account<a href="#" id="a2" class="icon-cog"></a></li>
            <li>Settings<a href="#" id="a3" class="icon-cw"></a></li>
            <li>History<a href="#" id="a4" class="icon-Histor"></a></li>
            <li>Close<a href="index" class="icon-location1 "></a></li>

         </ul>

         <!-- table Delete -->
         <div style="display:none;" id="table">

            <table class="table-success" id="example" style="text-align:center;">
               <thead>
                  <tr>
                     <th>Employee Id</th>
                     <th>Full Name</th>
                     <th>Department</th>
                     <th>Location</th>
                     <th>Country</th>
                     <th>Short N'</th>
                     <th>Job Position</th>
                     <th>Return</th>

                  </tr>
               </thead>
               <tbody></tbody>
            </table>
         </div>




         <!-- table User -->
         <div style="display:none;" id="table1">
            <button type="Button" class="btn btn-success btn-small mb-4 " data-toggle="modal"
               data-target="#exampleModal">
               <i class="icon-user"></i>
               Add New Account
            </button>

            <br><br>
            <table class="table-success" id="example1" style="text-align:center;">
               <thead>
                  <tr>
                     <th>UserId</th>
                     <th>Full Name</th>
                     <th>Email</th>
                     <th>Details</th>
                     <th>Delete</th>
                  </tr>
               </thead>
               <tbody></tbody>
            </table>

         </div>
      </div>
   </div>
</div>

<!-- modals add account -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Account *</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <!-- add new Modal *********************-->
         <div class="modal-body">
            <!-- form-->
            <div class="container">
               <form id="contactForm">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-7">
                           <label for="exampleInputEmail1">Select Employee By Full Name <span class="verified">
                                 *</span></label>
                           <select name="line" class="form-control" id="loadAllEmployees" required>
                           </select>
                           <option value=""></option>
                        </div>
                        <div class="col-md-5">
                           <label for="exampleInputEmail1">Employee Id<span class="verified"> *</span></label>
                           <input type="text" class="form-control" id="addEmployeeId" disabled>
                        </div>
                     </div>

                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">First Name <span class="verified"> *</span></label>
                        <input type="text" class="form-control" id="UserFNameSubscribe" aria-describedby="emailHelp"
                           required />
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Last Name <span class="verified"> *</span></label>
                        <input type="text" class="form-control" id="UserLNameSubscribe" aria-describedby="emailHelp"
                           required />
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Email Adress <span class="verified"> *</span></label>
                     <input type="Email" class="form-control" id="EmailSubscribe" aria-describedby="emailHelp"
                        required />
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="exampleInputPassword">Password <span class="verified"> *</span></label>
                        <input type="text" class="form-control" id="PasswordSubscribe" aria-describedby="emailHelp"
                           required />
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputPassword">Confirm Password <span class="verified"> *</span></label>
                        <input type="text" class="form-control" id="ConfirmPasswordSubscribe"
                           aria-describedby="emailHelp" oninput="check(this)" required />
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputhint">hint <span class="verified"> *</span></label>
                     <input type="text" class="form-control" id="HintSubscribe" aria-describedby="emailHelp" required />
                  </div>
                  <div class="row">
                     <div class="alertAddModal"></div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                     </button>
                     <button type="submit" class="btn btn-primary" onclick="AddAccount()">
                        Validate
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!--modal2 User details -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
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
            <button type="button" id="detailCloseButton" class="btn btn-secondary" data-dismiss="modal">
               Close
            </button>
         </div>
      </div>
   </div>
</div>
<!-- modals delete user -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
   aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="modal-title red" id="deleteModalLabel"><i class="icon-bin2"></i> Delete User</h3>
         </div>
         <div class="modal-body">
            <div class="container">
               <h3><i class="icon-question"></i> Are You sure You Want To Delete This User ?</h3>
               <div class="row">
                  <div class="col-md-3"><input type="text" id="deletedUserCode" hidden></div>
                  <div class="col-md-6">
                     <hr>
                     <h3 id="deletedUserName"></h3>
                     <hr>
                  </div>
                  <div class="col-md-3"></div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" id="detailCloseButton" class="btn btn-secondary" data-dismiss="modal">
               Close
            </button>
            <input type="button" class="btn btn-danger" data-dismiss="modal" value="Delete" onclick="DeleteUser()">
         </div>
      </div>

   </div>
</div>
<!-- end modals -->
<!-- Modal Edit Selected User _____________________________________________________________________________-->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="EditModalLabel"><i class='icon-edit font-large-0 blue '></i> Edit Employee *
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
                  <div class="form-group">
                     <label for="exampleInputEmail1">User Id <span class="verified"> *</span></label>
                     <input type="text" class="form-control" id="UserIdEdit" aria-describedby="emailHelp" disabled />
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">First Name <span class="verified"> *</span></label>
                        <input type="text" class="form-control" id="UserFNameEdit" aria-describedby="emailHelp"
                           required />
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Last Name <span class="verified"> *</span></label>
                        <input type="text" class="form-control" id="UserLNameEdit" aria-describedby="emailHelp"
                           required />
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Email Adress <span class="verified"> *</span></label>
                     <input type="Email" class="form-control" id="EmailEdit" aria-describedby="emailHelp" required />
                  </div>

                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Old Password <span class="verified">*</span></label>
                        <input type="Password" class="form-control" id="OldPassEdit" aria-describedby="emailHelp"
                           disabled>

                     </div>

                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> New Password<span class="verified"> *</span></label>
                        <input type="Password" class="form-control" id="NewPassEdit" aria-describedby="emailHelp"
                           required>
                     </div>
                  </div>
                  <div class="form-group ">
                     <label for="exampleInputEmail1">Hint <span class="verified"> *</span></label>
                     <input type="Text" class="form-control" id="HintEdit" aria-describedby="emailHelp" required>





                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                           Close
                        </button>
                        <button type="submit" class="btn btn-primary" data-dismiss="modal" onclick="ModifyUser()">
                           Modify
                        </button>
                     </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!--end Modal Edit Selected User___________________________________________________________________________-->
</div>
<!-- Settings Admin -->
<div class="container" id="Settings" style="display:none;">
   <h3>Settings*</h3>
   <br>

   <form>

      <div class="form-row">

         <div class="form-row">
            <div class="col-md-6 mb-3">
               <label for="">First Name:</label>
               <input type="text" class="form-control" id="FNameAdmin" placeholder="First name">
            </div>
            <div class="col-md-6 mb-3">
               <label for="">Last Name:</label>

               <input type="text" class="form-control" id="LNameAdmin" placeholder="Last name">
            </div>
         </div>
         <div class="form-row">
            <div class="col-md-12 mb-3">
               <label for="">Email:</label>
               <input type="Email" class="form-control" id="EmailAdmin" placeholder="Email">
            </div>
            <div class="form-row">
               <div class="col-md-6 mb-3">
                  <label for="">Old Password:</label>
                  <input type="Password" class="form-control" id="PasswordAdmin" placeholder="Old Password">

                  <label id="alertForPass"></label>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="">New Password:</label>

                  <input type="Password" class="form-control" id="NewPasswordAdmin" minlength="3"
                     placeholder=" New Password">

               </div>
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label for="">Hint:</label>

                     <input type="text" class="form-control" id="HintAdmin" placeholder="Hint">
                  </div>
               </div>
               <div style="text-align:center;">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" id="Close">
                     Close
                  </button>
                  &nbsp;
                  <button type="button" class="btn btn-primary" onclick="ModifyUser()">
                     Send
                  </button>


               </div>
               <br>
               <div class="alertAddModal1"></div>

   </form>
</div>
</div>
</div>
</div>
<br>

<div id="History" style="display:none">
   <div class="container mt-5">
      <br /><br />
      <div class="form-group row">
         <div class="col-md-6">
            <label for="example-date-input" class="col-2 col-form-label">Date<span class="verified"> *</span></label>
            <div class="col-10">
               <input class="form-control inputDate" type="date" id="example-date-input">
            </div>
         </div>

         <div class="col-md-6">
            <label for="exampleInputEmail1" class="col-2 col-form-label">Location Country <span class="verified">
                  *</span></label>
            <select name="event" class="form-control" id="Myselect">
               <option value="0" selected>Show All Events</option>
               <option value="Add">Add</option>
               <option value="Assign">Assign</option>
               <option value="Transfer">Transfer</option>
               <option value="Edit">Edit</option>
               <option value="Delete">Delete</option>
               <option value="change">Change Password</option>
               <option value="Turn Back">Turn Back</option>
            </select>
         </div>
      </div>

      <div class="row mb-1">
         <div class="col-md-12">
            <button type="button" id="btnDel" class="btn btn-danger btn-avrage mb-1 float-right"
               onclick="Delete_Selected_Event()">
               <i class="icon-trash"></i>
               Delete
            </button>
         </div>
      </div>
      <br />
      <div class="row bg-white ">
         <div class="col-md-12">
            <table class="table table-striped ">
               <thead>
                  <tr>
                     <th scope="col">
                        <h4 id="myOwnId"></h4>
                     </th>
                  </tr>
               </thead>
               <tbody id="showData1">
               </tbody>
            </table>
         </div>
      </div>
   </div>

   <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Event Details (Commits)*</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="container">
                  <table class="table table-striped">
                     <thead>
                     </thead>
                     <tbody id="filldata1">

                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end Settings--------------------------------------------------- -->
<script src="js/AccountSetting.js"></script>
<script src="js/SettingsAdmin.js"></script>

<?php footer();?>
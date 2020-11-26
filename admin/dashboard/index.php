<?php
include '../crud/dashboardTemplate.php';?>
<?php nav(); ?>
<div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body" style="">
          <div class="row">
            <div class="col-xl-3 col-lg-6 col-xs-12">
                <div class="card shadow-card" style="border-right: solid 3px #2494be;border-radius: 4px;">
                    <div class="card-body">
                        <div class="media">
                            <div class="p-2 text-xs-center bg-info media-left media-middle">
                                <i class="icon-pencil font-large-2 white"></i>
                            </div>
                            <div class="p-2 media-body">
                            <div id="allemploye"></div>
                                <span class="text-bold-500">Total Designs</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-xs-12">
                <div class="card shadow-card" style="border-right: solid 3px #2b957a;border-radius: 4px;">
                    <div class="card-body">
                        <div class="media">
                            <div class="p-2 text-xs-center bg-success media-left media-middle">
                                <i class="icon-mail2 font-large-2 white"></i>
                            </div>
                            <div class="p-2 media-body">
                            <div id="allproduct"></div>
                                 <span class="text-bold-500">Total Messages</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-xs-12">
                <div class="card shadow-card" style="border-right: solid 3px #f4a911;border-radius: 4px;">
                    <div class="card-body">
                        <div class="media">
                            <div class="p-2 text-xs-center bg-warning media-left media-middle">
                            <i class="icon-file-pdf font-large-2 white"></i>
                            
                            </div>
                            <div class="p-2 media-body">
                            <div id="allassign"></div>
                                <span class="text-bold-500">Transfers assets</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
          </div>
        </div>
        <div class="row">
        <div class="col-md-6">
        <table class="table">
  <thead>
  <h3>Plants Statistics</h3>
  <tr class="table-success"style="text-align: center;font-size: 10px; ">
      <th>PLANT NAME</th>
      <th>TOTAL EMPLOYEES</th>
      <th>TOTAL Assign</th>

    </tr>
  </thead>
  <tbody id="tbodyS">
  </tbody>
</table>
        </div>

        </div>
      </div>
<?php footer();?>
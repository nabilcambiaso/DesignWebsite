// Design js
//variables-----------------------------------
var phpUrl = "PhpFiles/Design.service.php";

// datatables---------------------------------
$("#example").dataTable();
var t = $("#example").DataTable();
var deleteDesignNumber = "";
var assignDesignNumber = "";
var first_name = "";
var last_name = "";
var DesignIds="";
$(function(){
  $("#categoryAssign").append(`
  <option value="Hardware">Hardware</option>
  <option value="Software">Software</option>
  `);
})


//on load ------------------------------------
function loads() {
  t.clear().draw();
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { load: "load" },
    success: function (response) {
      $.each(JSON.parse(response), function (key, val) {
        first_name = val.first_name;
        last_name = val.last_name;
        t.row
          .add([
            "<a  href='assign?id=" +
              val.Design_id +
              "'>" +
              val.Design_id +
              "</a>",
            "<a  href='assign?id=" +
              val.Design_id +
              "'>" +
              first_name +
              " " +
              last_name +
              "</a>",
            val.departement_name,
            val.location_name,
            val.short_number,
            "<a  href='assign?id=" +
              val.Design_id +
              "'><i class='icon-file-pdf font-large-1'></i></a>",
            "<a data-toggle='modal' data-target='#assignModal' onclick=fillAssettypeByChange('Hardware','" +
              val.Design_id +
              "','" +
              val.first_name +
              "','" +
              val.last_name +
              "')><i class=' icon-desktop font-large-1 '></i></a>",
            "<a data-toggle='modal' data-target='#detailModal' onclick=detailsDesign('" +
              val.Design_id +
              "')><i class='fas fa-users-cog fa-2x'></i></a>",
          ])
          .draw(false);
      });
    },
  });
}
//call load
loads();

//***************************Add delete edit Design ****************************************** */
//fill select elements *
function fillSelectItems(id) {
  if (id != "none") {
    //fill all fields to be able to edit them
    $.ajax({
      type: "post",
      url: phpUrl,
      data: { idModalDesign: id },
      success: function (response) {
        response = JSON.parse(response);
        response = response[0];
        $("#DesignIdEdit").val(response.Design_id);
        $("#DesignFNameEdit").val(response.first_name);
        $("#DesignLNameEdit").val(response.last_name);
        $("#EmailEdit").val(response.email_adress);
        $("#lineEdit").append(
          "<option value='" +
            response.UserId +
            "'>" +
            response.First_Name +
            " " +
            response.Last_Name +
            "</option>"
        );
        $("#locationEdit").append(
          "<option  value='" +
            response.location_id +
            "' Selected>" +
            response.location_name +
            "</option>"
        );
        $("#countryEdit").append(
          "<option value='" +
            response.country_code +
            "'>" +
            response.country_name +
            "</option>"
        );
        $("#DepartementEdit").append(
          "<option value='" +
            response.departement_id +
            "'>" +
            response.departement_name +
            "</option>"
        );
        $("#nationalityEdit").append(
          "<option>" + response.nationality + "</option>"
        );
        $("#MobileEdit").val(response.mobile_number);
        $("#shortNumberEdit").val(response.short_number);
        $("#DateEdit").val(response.date);
        $("#AdressEdit").val(response.adress);
      },
    });
  }

  //fill nationalities  *
  $.ajax({
    type: "get",
    url: "js/json/nationalities.json",
    success: function (response) {
      $("select").html("");
      $.each(response, function (key, val) {
        $("#nationalitySubscribe, #nationalityEdit").append(
          "<option>" + val + "</option>"
        );
      });
    },
  });

  //fill country *
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { country: "country" },
    success: function (response) {
      $("#countrySubscribe, #countryEdit").val("");
      response = JSON.parse(response);
      $.each(response, function (key, val) {
        $("#countrySubscribe, #countryEdit").append(
          "<option value='" +
            val.country_code +
            "'>" +
            val.country_name +
            "</option>"
        );
      });
      //fill location by selected country
      var countryId = $("#countryEdit option:selected ").val();
      changeCountry(countryId);
      var countryId2 = $("#countrySubscribe option:selected ").val();
      changeCountry(countryId2);
    },
  });

  //fill position *
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { position: "position" },
    success: function (response) {
      response = JSON.parse(response);
      $.each(response, function (key, val) {
        $("#jobPositionSubscribe, #jobPositionEdit").append(
          "<option value='" +
            val.position_id +
            "'>" +
            val.designation +
            "</option>"
        );
      });
    },
  });

  //fill line manager *
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { line: "line" },
    success: function (response) {
      console.log(response);
      response = JSON.parse(response);
      
      $.each(response, function (key, val) {
        if(val.Design_id==null)
        {
          $("#lineSubscribe, #lineEdit").append(
            "<option value='" +
              val.UserId +
              "'>" +
              val.First_Name +
              " " +
              val.Last_Name +
              "</option>");
        }
        else{
          $("#lineSubscribe, #lineEdit").append(
            "<option value='" +
              val.Design_id +
              "'>" +
              val.first_name +
              " " +
              val.last_name +
              "</option>"
          );
        }

      });
    },
  });

  //fill department *
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { department: "line" },
    success: function (response) {
      response = JSON.parse(response);
      $.each(response, function (key, val) {
        $("#DepartementSubscribe, #DepartementEdit").append(
          "<option value='" +
            val.departement_id +
            "'>" +
            val.departement_name +
            "</option>"
        );
      });
    },
  });
}

//verification delete Design *
function deleteDesignVerification(id) {
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { idModalDesign: id },
    success: function (response) {
      response = JSON.parse(response);
      $("#deletedDesignName").html(
        response[0].first_name + " " + response[0].last_name
      );
      $("#deletedDesignCode").val(response[0].Design_id);
    },
  });
}

//delete Design *
function DeleteDesign() {
  deleteDesignNumber = $("#deletedDesignCode").val();
  $.ajax({
    type: "post",
    url: phpUrl,
    data: {
      ArchiveSelectedDesign: "delete",
      DesignId: deleteDesignNumber,
    },
    success: function (response) {
      loads();
      Add_Event("Delete An Design", `Emplyee Id :${deleteDesignNumber}`);
    },
  });
}

//validate new enployee *
function AddDesign() {
  if ($("#DesignIdSubscribe").val() != "") {
    var DesignId = $("#DesignIdSubscribe").val();
    var FirstName = $("#DesignFNameSubscribe").val();
    var LastName = $("#DesignLNameSubscribe").val();
    var Email = $("#EmailSubscribe").val();
    var Country = $("#countrySubscribe option:selected").val();
    var Location = $("#locationSubscribe option:selected").val();
    var Departement = $("#DepartementSubscribe option:selected").val();
    var LineManager = $("#lineSubscribe option:selected").val();
    var MobileNumber = $("#MobileSubscribe").val();
    var ShortNumber = $("#shortNumberSubscribe").val();
    var JobPosition = $("#jobPositionSubscribe option:selected").val();
    var Nationality = $("#nationalitySubscribe option:selected").val();
    var JoinDate = $("#DateSubscribe").val();
    var Address = $("#AdressSubscribe").val();

    $.ajax({
      type: "post",
      url: phpUrl,
      data: {
        AddDesign: "cydtyydtdty",
        DesignId: DesignId,
        FirstName: FirstName,
        LastName: LastName,
        Line: LineManager,
        Email: Email,
        Country: Country,
        Location: Location,
        Departement: Departement,
        MobileNumber: MobileNumber,
        ShortNumber: ShortNumber,
        JobPosition: JobPosition,
        Nationality: Nationality,
        JoinDate: JoinDate,
        Address: Address,
      },
      success: function (response) {
        Add_Event(
          "Add An Design",
          `ID :${DesignId}, Full Name : ${FirstName} ${LastName}`
        );
        loads();
        window.location.href = "./Design";
      },
    });
  } else {
    $(".alertAddModal").html(
      "<span class='alert alert-danger>Please Fill All Fields *</alert>'"
    );
  }
}

//on change country fill location AddSection *
$("#countrySubscribe").change(function (e) {
  e.preventDefault();
  var countryId = $("#countrySubscribe option:selected").val();
  $("#locationSubscribe ,#locationEdit").html("");
  //fill location
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { locationChange: "location", countryChange: countryId },
    success: function (response) {
      response = JSON.parse(response);
      $.each(response, function (key, val) {
        $("#locationSubscribe").append(
          "<option value='" +
            val.location_id +
            "'>" +
            val.location_name +
            "</option>"
        );
      });
    },
  });
});

//details Design *
function detailsDesign(id) {
  DesignIds=id;
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { idModalDesign: id },
    success: function (response) {

      $("#tableModalDetails").html("");
      response = JSON.parse(response);
        response = response[0];
      if(response.UserId==null)
      {
        
        $("#tableModalDetails").append(
          "<tr><td>Design Id</td><td>" + response.Design_id + "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Full Name</td><td>" +
            response.first_name +
            " " +
            response.last_name +
            "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Email Adress</td><td>" + response.adress + "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Line Manager</td><td>" +
            response.first_name +
            " " +
            response.last_name +
            "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Departement</td><td>" +
            response.departement_name +
            "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr>Location<td>Location </td><td>" +
            response.location_name +
            "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Country</td><td>" + response.country_name + "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Mobile Number </td><td>" +
            response.mobile_number +
            "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Short Number</td><td>" + response.short_number + "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Job Position</td><td>" + response.job_position + "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Nationality</td><td>" + response.nationality + "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Date</td><td>" + response.date + "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Adress</td><td>" + response.adress + "</td></tr>"
        );
        $("#tableModalDetails").append(
          `<tr>
            <th>
              Actions : 
            </th>
            <td>
              <a data-toggle='modal' data-target='#deleteModal' onclick=deleteDesignVerification('${response.Design_id}')>
              <i data-dismiss="modal" data-target='#detailModal' class="fas fa-trash fa-2x red"></i>
              </a>
              <a style="margin-left:25px" data-toggle='modal' data-target='#EditModal' onclick=fillSelectItems('${response.Design_id}')>
              <i  data-target='#detailModal' data-dismiss="modalD" class="fas fa-edit fa-2x blue-grey"></i>
              </a>
            </td>
          </tr>`
        );
      }
      else{
        
        $("#tableModalDetails").append(
          "<tr><td>Design Id</td><td>" + response.Design_id + "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Full Name</td><td>" +
            response.first_name +
            " " +
            response.last_name +
            "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Email Adress</td><td>" + response.adress + "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Line Manager</td><td>" +
            response.First_Name +
            " " +
            response.Last_Name +
            "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Departement</td><td>" +
            response.departement_name +
            "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr>Location<td>Location </td><td>" +
            response.location_name +
            "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Country</td><td>" + response.country_name + "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Mobile Number </td><td>" +
            response.mobile_number +
            "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Short Number</td><td>" + response.short_number + "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Job Position</td><td>" + response.job_position + "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Nationality</td><td>" + response.nationality + "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Date</td><td>" + response.date + "</td></tr>"
        );
        $("#tableModalDetails").append(
          "<tr><td>Adress</td><td>" + response.adress + "</td></tr>"
        );
        $("#tableModalDetails").append(
          `<tr>
            <th>
              Actions : 
            </th>
            <td>
              <a data-toggle='modal' data-target='#deleteModal' onclick=deleteDesignVerification('${response.Design_id}')>
              <i data-dismiss="modal" data-target='#detailModal' class="fas fa-trash fa-2x red"></i>
              </a>
              <a style="margin-left:25px" data-toggle='modal' data-target='#EditModal' onclick=fillSelectItems('${response.Design_id}')>
              <i  data-target='#detailModal' data-dismiss="modalD" class="fas fa-edit fa-2x blue-grey"></i>
              </a>
            </td>
          </tr>`
        );
      }
 
    }
  });
}

//modify Design *
function ModifyDesign() {
  var FirstName = $("#DesignFNameEdit").val();
  var LastName = $("#DesignLNameEdit").val();
  var Email = $("#EmailEdit").val();
  var Country = $("#countryEdit option:selected").val();
  var Location = $("#locationEdit option:selected").val();
  var Departement = $("#DepartementEdit option:selected").val();
  var LineManager = $("#lineEdit option:selected").val();
  var MobileNumber = $("#MobileEdit").val();
  var ShortNumber = $("#shortNumberEdit").val();
  var JobPosition = $("#jobPositionEdit option:selected").val();
  var Nationality = $("#nationalityEdit option:selected").val();
  var JoinDate = $("#DateEdit").val();
  var Address = $("#AdressEdit").val();

  $.ajax({
    type: "post",
    url: phpUrl,
    data: {
      EditSelectedDesign: "Edit",
      DesignId: DesignIds,
      FirstName: FirstName,
      LastName: LastName,
      Line: LineManager,
      Email: Email,
      Country: Country,
      Location: Location,
      Departement: Departement,
      MobileNumber: MobileNumber,
      ShortNumber: ShortNumber,
      JobPosition: JobPosition,
      Nationality: Nationality,
      JoinDate: JoinDate,
      Address: Address,
    },
    success: function (response) {
      Add_Event(
        "Edit Design Informations",
        `ID :${DesignIds} FullName : ${FirstName} ${LastName}`
      );
      loads();
      $("#detailModal").modal("hide");
      $("#EditModal").modal("hide");
    },
  });
}

//on change country fill location editSection *
$("#countryEdit").change(function (e) {
  e.preventDefault();
  var countryId = $("#countryEdit option:selected").val();
  changeCountry(countryId);
});

//change country fill location *
function changeCountry(countryId) {
  //fill location
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { locationChange: "location", countryChange: countryId },
    success: function (response) {
      
  $("#locationSubscribe").html("");
  $("#locationEdit").html("");
      response = JSON.parse(response);
      $.each(response, function (key, val) {
        $("#locationEdit, #locationSubscribe").append(
          "<option value='" +
            val.location_id +
            "'>" +
            val.location_name +
            "</option>"
        );
      });
    },
  });
}

//**************************filter side ********************************************* */
//filter toggle
$(".filterToggle").click(function (e) {
  e.preventDefault();
  $(".filterForm").slideToggle();
});
$(".filterForm").hide();

//filter fill select items
function fillFilterItems() {
  //fill filter country
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { country: "country" },
    success: function (response) {
      response = JSON.parse(response);
      $.each(response, function (key, val) {
        $("#filterCountry").append(
          "<option value='" +
            val.country_code +
            "'>" +
            val.country_name +
            "</option>"
        );
      });
    },
  });

  //fill filter position
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { position: "position" },
    success: function (response) {
      response = JSON.parse(response);
      $.each(response, function (key, val) {
        $("#filterPosition").append(
          "<option value='" +
            val.position_id +
            "'>" +
            val.designation +
            "</option>"
        );
      });
    },
  });
}

//call function fillFilterItems
fillFilterItems();

//on change country fill add
$("#filterCountry").change(function (e) {
  e.preventDefault();
  var countryId = $("#filterCountry option:selected").val();

  $("#filterLocation").html("");
  //fill location
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { locationChange: "location", countryChange: countryId },
    success: function (response) {
      response = JSON.parse(response);
      $.each(response, function (key, val) {
        $("#filterLocation").append(
          "<option value='" +
            val.location_id +
            "'>" +
            val.location_name +
            "</option>"
        );
      });
    },
  });
});

$("#exportDesignExcel").click(function (e) {
  e.preventDefault();

  $.ajax({
    type: "post",
    url: phpUrl,
    data: { DesignExport: "ExportDesign" },
    success: function (response) {},
  });
});

//*******************assign product to Design ************************* */
//hide hardware and software divs on  load
$(".SoftwareAssign").hide();
// fill asset type when choosing category *
function fillAssettypeByChange(assetType, id, fname, lname) {
  assignDesignNumber = id;
  first_name = fname;
  last_name = lname;
  $("#fnameDesign").html(fname);
  $("#lnameDesign").html(lname);

  $("#SoftwareModelNameAssign").html("");
  $("#HadwareAssetTypeAssign").html("");
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { AssetTypeFillByCategoryChange: assetType },
    success: function (response) {
      response = JSON.parse(response);
      $.each(response, function (key, val) {
        if (assetType == "Hardware") {
          $("#HadwareAssetTypeAssign").append(
            "<option value='" +
              val.asset_code +
              "'>" +
              val.assetType_name +
              "</option>"
          );
        } else {
          $("#SoftwareModelNameAssign").append(
            "<option value='" +
              val.model_name +
              "'>" +
              val.model_name +
              "</option>"
          );
        }
      });
    },
  });
}

// change modal sliding div on category change *
$("#categoryAssign").on("change", function (e) {
  e.preventDefault();
  var categoryAssign = $("#categoryAssign option:selected").val();
  if (categoryAssign == "Hardware") {
    fillAssettypeByChange(
      "Hardware",
      assignDesignNumber,
      first_name,
      last_name
    );
    $(".hardwareAssign").slideDown();
    $(".SoftwareAssign").hide();
  } else {
    fillAssettypeByChange(
      "Software",
      assignDesignNumber,
      first_name,
      last_name
    );
    $(".hardwareAssign").hide();
    $(".SoftwareAssign").slideDown();
  }
});

//assign material modelNameCHange *
function assetTypeAssign() {
  var assetType_name = $("#HadwareAssetTypeAssign").val();
  $("#HardwareModelNameAssign").html("");
  $.ajax({
    type: "post",
    url: phpUrl,
    data: { HardwareAssetTypeAssign: assetType_name },
    success: function (response) {
      $("#HardwareModelNameAssign").html("");
      response = JSON.parse(response);
      $.each(response, function (key, val) {
        $("#HardwareModelNameAssign").append(
          "<option selected value='" +
            val.model_name +
            "'>" +
            val.model_name +
            "</option>"
        );
      });
    },
  });
}
$("#HadwareAssetTypeAssign").on("click , change", function (e) {
  e.preventDefault();
  assetTypeAssign();
});

//fill serial number when choosing model name *
$("#HardwareModelNameAssign , #SoftwareModelNameAssign").on(
  "click ,change ",
  function (e) {
    e.preventDefault();
    var category = $("#categoryAssign").val();
    if (category == "Hardware") {
      var model_name = $("#HardwareModelNameAssign").val();
    } else {
      var model_name = $("#SoftwareModelNameAssign").val();
    }
    $("#HadwareSerialAssign").html("");
    $("#SoftwareSerialAssign").html("");
    $.ajax({
      type: "post",
      url: phpUrl,
      data: { fillSerialNumberByModelNameChange: model_name },
      success: function (response) {
        response = JSON.parse(response);
        $.each(response, function (key, val) {
          if (category == "Hardware")
            $("#HadwareSerialAssign").append(
              "<option value='" +
                val.serial_number +
                "'>" +
                val.serial_number +
                "</option>"
            );
          else
            $("#SoftwareSerialAssign").append(
              "<option value='" +
                val.serial_number +
                "'>" +
                val.serial_number +
                "</option>"
            );
        });
      },
    });
  }
);

//assign Product
function assignProduct() {
  var categoryAssign = $("#categoryAssign").val();
  if (categoryAssign == "Hardware") {
    var assetAssign = $("#HadwareAssetTypeAssign").val();
  var modelNameAssign = $("#HardwareModelNameAssign").val();
  var serialNumberAssign = $("#HadwareSerialAssign").val();
  var assetCondition = $("#assetConditionAssign").val();
        if(assetAssign!=null || modelNameAssign!=null || serialNumberAssign!=null ){
    var antivirus,
    zip,
    sap,
    vpn,
    opsystem,
    firewall,
    adobe,
    encryption,
    printers,
    assetTag,
    removedCheck,
    domainCheck,
    adminCheck;
  
  if ($("#antivirusCheck").is(":checked")) {
    antivirus = "Yes";
  } else {
    antivirus = "No";
  }
  if ($("#zipChek").is(":checked")) {
    zip = "Yes";
  } else {
    zip = "No";
  }
  if ($("#sapCheck").is(":checked")) {
    sap = "Yes";
  } else {
    sap = "No";
  }
  if ($("#vpnCheck").is(":checked")) {
    vpn = "Yes";
  } else {
    vpn = "No";
  }
  if ($("#opCheck").is(":checked")) {
    opsystem = "Yes";
  } else {
    opsystem = "No";
  }
  if ($("#firewallCheck").is(":checked")) {
    firewall = "Yes";
  } else {
    firewall = "No";
  }
  if ($("#adbCheck").is(":checked")) {
    adobe = "Yes";
  } else {
    adobe = "No";
  }
  if ($("#encryptionCheck").is(":checked")) {
    encryption = "Yes";
  } else {
    encryption = "No";
  }
  if ($("#printersCheck").is(":checked")) {
    printers = "Yes";
  } else {
    printers = "No";
  }
  if ($("#assetTagCheck").is(":checked")) {
    assetTag = "Yes";
  } else {
    assetTag = "No";
  }
  if ($("#domainCheck").is(":checked")) {
    domainCheck = "Yes";
  } else {
    domainCheck = "No";
  }
  if ($("#adminCheck").is(":checked")) {
    adminCheck = "Yes";
  } else {
    adminCheck = "No";
  }
  if ($("#removedCheck").is(":checked")) {
    removedCheck = "Yes";
  } else {
    removedCheck = "No";
  }

  $.ajax({
    type: "post",
    url: phpUrl,
    data: {
      assignAssetToDesign: assignDesignNumber,
      assetTypeAssignToDesign: assetAssign,
      hadwareModelNameAssign: modelNameAssign,
      serialNumberAssign: serialNumberAssign,
      assetConditionAssign: assetCondition,
      antivirusAssign: antivirus,
      zip: zip,
      sap: sap,
      vpn: vpn,
      opsystem: opsystem,
      firewall: firewall,
      adobe: adobe,
      encryption: encryption,
      printers: printers,
      assetTag: assetTag,
      domainCheck: domainCheck,
      adminCheck: adminCheck,
      removedCheck: removedCheck,
    },
    success: function (response) {
      Add_Event(
        "Assign An Asset To Design",
        `Asset ID :${serialNumberAssign}, Type : Hardware ==> Design ID : ${assignDesignNumber}`
      );
      setTimeout(() => {
        window.location.href = "Design?assignSuccess";
      }, 200);
    },
  });
        }
        else{
              $(".alertDesignAdd").html("<span class='alert alert-warning'>Fill all Fields !</span>");
        }
  } else {

    var modelNameAssign = $("#SoftwareModelNameAssign").val();
    var serialNumberAssign = $("#SoftwareSerialAssign").val();
    var installedBy = $("#installedByAssign").val();
    if(modelNameAssign!=null || serialNumberAssign!=null || installedBy!="")
     {
      $.ajax({
        type: "post",
        url: phpUrl,
        data: {
          assignAssetToDesignSoftware: assignDesignNumber,
          assetTypeAssignToDesign: "5",
          softwareModelNameAssign: modelNameAssign,
          serialNumberAssign: serialNumberAssign,
          installedByAssign: installedBy,
        },
        success: function (response) {
          Add_Event(
            "Assign An Asset To Design",
            `Asset ID:${serialNumberAssign}, Type : Software, Design ID :${assignDesignNumber}`
          );
          setTimeout(() => {
            window.location.href = "Design?assignSuccess";
          }, 200);
        },
      });
     }
     else{
      $(".alertDesignAdd").html("<span class='alert alert-warning'>Fill all Fields !</span>");
     }

  }
}

//modal success assign if url containes assigned successfully
$("document").ready(function () {
  if (window.location.href.indexOf("assignSuccess") > -1) {
    $("#SuccesAssign").trigger("click");
  }
});


<?php
include "../../crud/dbConnexion.php";
//onload
if(isset($_POST["load"]))
{
  $req1=$mysqli->query("select distinct * from  employee_info e join location l on e.location=l.location_id join country c on e.country
  =c.country_code join departement d on d.departement_id=e.department left join authentification a on a.UserId=e.line_manager    where e.Archived='0'  group by e.employee_id");
  $employee=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $employee[]=$ligne;
  }
  echo json_encode($employee);
}
//get departments *
if(isset($_POST["department"]))
{
  $req1=$mysqli->query("select * from departement");
  $department=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $department[]=$ligne;
  }
  echo json_encode($department);
}

//get location
if(isset($_POST["locationChange"]))
{
  $country=$_POST["countryChange"];
  $req1=$mysqli->query("select * from location where Country ='$country' and Archived='0'");
  
  $location=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $location[]=$ligne;
  }
  echo json_encode($location);
}

//get country
if(isset($_POST["country"]))
{
  $req1=$mysqli->query("select * from country where Archived='0'");
  $country=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $country[]=$ligne;
  }
  echo json_encode($country);
}

//get line
if(isset($_POST["line"]))
{
  $req=$mysqli->query("select count(e.employee_id) as nbr from employee_info e right join authentification a on e.line_manager=a.UserId where e.Archived='0' or e.Archived is null order by e.first_name");
  $ligne=mysqli_fetch_assoc($req);
  if($ligne["nbr"]==0)
  {
    $req1=$mysqli->query("select * from  authentification ");
  }
  else{
    $req1=$mysqli->query("select * from employee_info e left join authentification a on e.line_manager=a.UserId where e.Archived='0'  order by e.first_name");

  }
  $line=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $line[]=$ligne;
  }
  echo json_encode($line);
}

//get position *
if(isset($_POST["position"]))
{
  $req1=$mysqli->query("select * from postion");
  $position=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $position[]=$ligne;
  }
  echo json_encode($position);
}

//AddEmployee
if(isset($_POST["AddEmployee"]))
{
  $employeeId=mysqli_real_escape_string($mysqli ,$_POST["EmployeeId"]);
  $FirstName=mysqli_real_escape_string($mysqli ,$_POST["FirstName"]);
  $LastName=mysqli_real_escape_string($mysqli ,$_POST["LastName"]);
  $Email=mysqli_real_escape_string($mysqli ,$_POST["Email"]);
  $Country=mysqli_real_escape_string($mysqli ,$_POST["Country"]);
  $Location=mysqli_real_escape_string($mysqli ,$_POST["Location"]);
  $Departement=mysqli_real_escape_string($mysqli ,$_POST["Departement"]);
  $MobileNumber=mysqli_real_escape_string($mysqli ,$_POST["MobileNumber"]);
  $ShortNumber=mysqli_real_escape_string($mysqli ,$_POST["ShortNumber"]);
  $JobPosition=mysqli_real_escape_string($mysqli ,$_POST["JobPosition"]);
  $Nationality=mysqli_real_escape_string($mysqli ,$_POST["Nationality"]);
  $JoinDate=mysqli_real_escape_string($mysqli ,$_POST["JoinDate"]);
  $Address=mysqli_real_escape_string($mysqli ,$_POST["Address"]);
  $Line_Manager=mysqli_real_escape_string($mysqli ,$_POST["Line"]);
  $req1=$mysqli->query("INSERT INTO `employee_info`(
    `employee_id`,
    `first_name`,
    `last_name`,
    `email_adress`,
    `line_manager`,
    `department`,
    `location`,
    `country`,
    `mobile_number`,
    `short_number`, 
    `job_position`, 
    `nationality`,
    `date`,
    `adress`) 
  VALUES ('$employeeId','$FirstName','$LastName','$Email','$Line_Manager',
  '$Departement','$Location','$Country','$MobileNumber',
  '$ShortNumber',
  '$JobPosition',
  '$Nationality',
  '$JoinDate',
  '$Address')") or die(mysqli_error());

}

//modal detail of employee
if(isset($_POST["idModalEmployee"]))
{
  $id=$_POST["idModalEmployee"];
  $req1=$mysqli->query("select * from  employee_info e join location l on e.location=l.location_id join country c on e.country
  =c.country_code join departement d on d.departement_id=e.department left join authentification a on a.UserId=e.line_manager where e.employee_id='$id'")
   or die(mysqli_error());
  $employee=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $employee[]=$ligne;
  }
  echo json_encode($employee);
}

  // Archive Employee
  if(isset($_POST["ArchiveSelectedEmployee"])) {
    echo("Success");
    $employeeId=mysqli_real_escape_string($mysqli ,$_POST["EmployeeId"]);

    $req=mysqli_query($mysqli,"UPDATE employee_info SET 
    Archived = '1'
    where employee_id='$employeeId'") or die(mysqli_error($req));
  }


  // Edit Selected Employee  *
  if(isset($_POST["EditSelectedEmployee"]))
{

  $employeeId=mysqli_real_escape_string($mysqli ,$_POST["EmployeeId"]);
  $FirstName=mysqli_real_escape_string($mysqli ,$_POST["FirstName"]);
  $LastName=mysqli_real_escape_string($mysqli ,$_POST["LastName"]);
  $Email=mysqli_real_escape_string($mysqli ,$_POST["Email"]);
  $Country=mysqli_real_escape_string($mysqli ,$_POST["Country"]);
  $Location=mysqli_real_escape_string($mysqli ,$_POST["Location"]);
  $Departement=mysqli_real_escape_string($mysqli ,$_POST["Departement"]);
  $MobileNumber=mysqli_real_escape_string($mysqli ,$_POST["MobileNumber"]);
  $ShortNumber=mysqli_real_escape_string($mysqli ,$_POST["ShortNumber"]);
  $JobPosition=mysqli_real_escape_string($mysqli ,$_POST["JobPosition"]);
  $Nationality=mysqli_real_escape_string($mysqli ,$_POST["Nationality"]);
  $JoinDate=mysqli_real_escape_string($mysqli ,$_POST["JoinDate"]);
  $Address=mysqli_real_escape_string($mysqli ,$_POST["Address"]);
  $Line_Manager=mysqli_real_escape_string($mysqli ,$_POST["Line"]);

  
        $req=mysqli_query($mysqli,"UPDATE employee_info SET 
        first_name='$FirstName',
        last_name='$LastName',
        email_adress='$Email',
        country='$Country',
        location='$Location',
         department='$Departement',
         mobile_number='$MobileNumber',
         job_position='$JobPosition',
           nationality='$Nationality',
           date='$JoinDate',
           adress='$Address',
           line_manager='$Line_Manager',
           short_number='$ShortNumber' where employee_id='$employeeId'") or die(mysqli_error($req));
echo("success");
}

  //export employee excel *
  //telecharger -------------------------------------------------------------------------
if(isset($_POST["EmployeeExport"]))
{
  $dateS=$_POST["dateS"];
  $dateE=$_POST["dateE"];
  $country=$_POST["countryFilter"];
  $location=$_POST["locationFilter"];
  $jobPositionFilter=$_POST["jobPositionFilter"];
   if($dateS==null && $dateE==null)
   {
    $dateS='1900-12-12';
    $dateE=date('Y-m-d');
   }
   else if($dateS==null)
   {
    $dateS='1900-12-12';
   }
   else if($dateE==null){
    $dateE=date('Y-m-d');
   }

    $output='';
   $result=$mysqli->query("select * from employee_info e join country c on e.country= c.country_code join location l on e.location = l.location_id join postion p on e.job_position=p.position_id  join departement d on e.department=d.departement_id where e.date between '$dateS' and '$dateE' and e.country like '%$country%' and e.location like '%$location%' and e.job_position like '%$jobPositionFilter%' and e.Archived='0' ");
 if($result!=null)
 {
  $output .='
  <table class="table" >
  <tr></tr>
  <tr>
 <th colspan="5"></th><th colspan="2" ><h1>Nomac Employee List</h1></th><th colspan="6"></th>
  </tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  </table>
  ';
    $output .='
    <table class="table" border="1">
    <tr>
    <th>Employee Id</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email Adress </th>
    <th>Line Manager</th>
    <th>Department</th>
    <th>Location</th>
    <th>Country</th>
    <th>Mobile Number</th>
    <th>Short Number</th>
    <th>Job Position</th>
    <th>Nationality</th>
    <th>Adress</th>
    <th>Joining Date </th>

    </tr>

    ';
    while($row = $result->fetch_array())
    {
        $output .='
    <tr>
        <td>'.$row["employee_id"].'</td>
        <td>'.$row["first_name"].'</td>
        <td>'.$row["last_name"].'</td>
        <td>'.$row["email_adress"].'</td>
        <td>'.$row["line_manager"].'</td>
        <td>'.$row["departement_name"].'</td>
        <td>'.$row["location_name"].'</td>
        <td>'.$row["country_name"].'</td>
        <td>'.$row["mobile_number"].'</td>
        <td>'.$row["short_number"].'</td>
        <td>'.$row["designation"].'</td>
        <td>'.$row["nationality"].'</td>
        <td>'.$row["adress"].'</td>
        <td>'.$row["date"].'</td>

        </tr>
        ';
    }

    $output .='</table>';
    $output .='<table class="table"><tr></tr><tr></tr><tr><td colspan="5"></td><td>Export Date : '.date("Y-m-d").'</td><td colspan="6"></td></tr></table>';

    header("Content-Type: application/xls");
    header("Content-Disposition:attachment; filename=EmployeeList(".date('Y-m-d').").xls" );
 echo $output;
 }

}


//select asset type to assign *
if(isset($_POST["AssetTypeFillByCategoryChange"]))
{
  $category=$_POST["AssetTypeFillByCategoryChange"];
  if($category=="Hardware")
  {
    $req1=$mysqli->query("select distinct a.* from material m join assettype a on a.asset_code= m.asset_type where m.category='$category' and m.Archived='0' ") or die(mysqli_error());
  }
  else{
    $req1=$mysqli->query("select distinct m.* from material m where  m.category='$category' and m.Archived='0' ") or die(mysqli_error());
  }

  $assetType=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $assetType[]=$ligne;
  }
  echo json_encode($assetType);
}

 //select model name from Asset type *
 if(isset($_POST["HardwareAssetTypeAssign"]))
 {
  $id=$_POST["HardwareAssetTypeAssign"];
  $req1=$mysqli->query("select distinct m.* from  material m where m.serial_number  not in (select am.serial_number from assign_material am where am.returned='0' )  and m.asset_type='$id' and m.Archived='0'")
   or die(mysqli_error());
  $employee=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $employee[]=$ligne;
  }
  echo json_encode($employee);
 }


  //select serialNumber name from ModelName *
  if(isset($_POST["fillSerialNumberByModelNameChange"]))
  {
   $model_name=$_POST["fillSerialNumberByModelNameChange"];
   $req1=$mysqli->query("select serial_number from  material where model_name='$model_name'")
    or die(mysqli_error());
   $serial=[];
   while($ligne=mysqli_fetch_assoc($req1))
   {
     $serial[]=$ligne;
   }
   echo json_encode($serial);
  }

  //assign Hadware *
  if(isset($_POST["assignAssetToEmployee"]))
  {
    $date=date("y-m-d");
    $employee_id=$_POST["assignAssetToEmployee"];
    $assetType=$_POST["assetTypeAssignToEmployee"];
    $model_name=$_POST["hadwareModelNameAssign"];
    $serialNumber=$_POST["serialNumberAssign"];
    $assetCondition=$_POST["assetConditionAssign"];
    $antivirus=$_POST["antivirusAssign"];
    $zip=$_POST["zip"];
    $sap=$_POST["sap"];
    $vpn=$_POST["vpn"];
    $opsystem=$_POST["opsystem"];
    $firewall=$_POST["firewall"];
    $adobe=$_POST["adobe"];
    $encryption=$_POST["encryption"];
    $printers=$_POST["printers"];
    $assetTag=$_POST["assetTag"];
    $domainCheck=$_POST["domainCheck"];
    $adminCheck=$_POST["adminCheck"];
    $removedCheck=$_POST["removedCheck"];
   $req1=$mysqli->query("insert into assign_material(employee_id,asset_type,serial_number,model_name,asset_condition,date_instal_hand
   ,antivirus,operatingSystem,adobe_reader,domainLocal,zip,firewall,sap,printers,encryption,
   vpn,adminRight,assetTag,unauthorizedSoft) 
   values ('$employee_id','$assetType','$serialNumber','$model_name','$assetCondition','$date','$antivirus',
   '$opsystem','$adobe','$domainCheck','$zip','$firewall','$sap','$printers','$encryption','$vpn',
   '$adminCheck','$assetTag','$removedCheck')")
    or die(mysqli_error());
  }

    //assign software *
    if(isset($_POST["assignAssetToEmployeeSoftware"]))
    {
      $date=date("y-m-d");
      $employee_id=$_POST["assignAssetToEmployeeSoftware"];
      $assetType=$_POST["assetTypeAssignToEmployee"];
      $model_name=$_POST["softwareModelNameAssign"];
      $serialNumber=$_POST["serialNumberAssign"];
      $installedBy=$_POST["installedByAssign"];
     $req1=$mysqli->query("insert into assign_material(employee_id,asset_type,serial_number,model_name,installed_by,date_instal_hand) 
     values ('$employee_id','$assetType','$serialNumber','$model_name','$installedBy','$date')")
      or die(mysqli_error());
      echo "succes Assign";
    }
 

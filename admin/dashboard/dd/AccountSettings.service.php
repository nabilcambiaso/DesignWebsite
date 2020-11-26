<?php
include "../../crud/dbConnexion.php";

//LoadAccount
if(isset($_POST["load1"]))
{
  $req1=$mysqli->query("select * from authentification a where a.Categorie=1 and a.Status=0");
  $compte=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $compte[]=$ligne;
  }
  echo json_encode($compte);
}

if(isset($_POST["loadSingle"]))
{
  $employeeId=mysqli_real_escape_string($mysqli ,$_POST["id"]);
  $req1=$mysqli->query("SELECT * FROM `employee_info` WHERE employee_id = '$employeeId'");
  while($ligne=mysqli_fetch_assoc($req1))
  {
    echo json_encode($ligne);
  }
}



//AddUser
if(isset($_POST["AddUser"]))
{
$UserId=mysqli_real_escape_string($mysqli ,$_POST["UserId"]);
$FirstName=mysqli_real_escape_string($mysqli ,$_POST["FirstName"]);
$LastName=mysqli_real_escape_string($mysqli ,$_POST["LastName"]);
$Email=mysqli_real_escape_string($mysqli ,$_POST["Email"]);
$Password=password_hash($_POST['Password'],PASSWORD_DEFAULT);
$Hint=mysqli_real_escape_string($mysqli ,$_POST["Hint"]);
$OldPass=mysqli_real_escape_string($mysqli ,$_POST["OldPass"]);
$req1=$mysqli->query("INSERT INTO `authentification`(`UserId`, `First_Name`, `Last_Name`, `Email`, `Password`, `hint`, `Categorie`, `Status`, `OldPass`)
VALUES ('$UserId','$FirstName','$LastName','$Email','$Password','$Hint','1','0','$OldPass')") 
or die(mysqli_error());
echo("its Works");
}


//modal detail of user
if(isset($_POST["idModalUser"]))
{
$id=$_POST["idModalUser"];
$req1=$mysqli->query("select * from  authentification a  where a.UserId='$id'")
 or die(mysqli_error());
$employee=[];
while($ligne=mysqli_fetch_assoc($req1))
{
  $employee[]=$ligne;
}
echo json_encode($employee);
}


// Delete User
if(isset($_POST["ArchiveSelectedUser"]))
{
    $id=mysqli_real_escape_string($mysqli ,$_POST["UserId"]);
    $req1=$mysqli->query("DELETE FROM `authentification` WHERE UserId='$id'") or die(mysqli_error());
}

//onload
if(isset($_POST["load"]))
{
  $req1=$mysqli->query("select * from employee_info where Archived=1");
  $employee=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $employee[]=$ligne;
  }
  echo json_encode($employee);
}

//load employees to fill select
if(isset($_POST["loademployees"]))
{
  $req=$mysqli->query("select count(e.employee_id) as nbr from employee_info e right join authentification a on e.line_manager=a.UserId where e.Archived='0' or e.Archived is null order by e.first_name")
   or die(mysqli_error());
  $ligne=mysqli_fetch_assoc($req);
  $tab=$ligne;
  if($ligne["nbr"]==0)
  {
    $req1=$mysqli->query("select * from authentification");
  }
  else {
  $req1=$mysqli->query("select * from employee_info e left join authentification a on e.line_manager=a.UserId  where e.Archived='0'  order by e.first_name");
  }


  $employee=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $employee[]=$ligne;
  }
  echo json_encode( array($tab,$employee));
}

 // Return Employee
 if(isset($_POST["ReturnSelectedEmployee"])) {
    echo("Success");
    $employeeId=mysqli_real_escape_string($mysqli ,$_POST["EmployeeId"]);

    $req=mysqli_query($mysqli,"UPDATE employee_info SET Archived = '0' where employee_id='$employeeId'") 
    or die(mysqli_error($req));
  }

  if(isset($_POST["EditSelectedUser"]))
{

  $FirstName=mysqli_real_escape_string($mysqli ,$_POST["FirstName"]);
  $LastName=mysqli_real_escape_string($mysqli ,$_POST["LastName"]);
  $Email=mysqli_real_escape_string($mysqli ,$_POST["Email"]);
  $Password=password_hash($_POST['Password'],PASSWORD_DEFAULT);
  $Hint=mysqli_real_escape_string($mysqli ,$_POST["Hint"]);
 $OldPassword=mysqli_real_escape_string($mysqli ,$_POST["OldPassword"]);
 
 
 $req1=$mysqli->query("select * from authentification a where a.Categorie=0");
  while($ligne=mysqli_fetch_assoc($req1))
  {
    if(!password_verify($OldPassword,$ligne["Password"])==1 ) {
      echo "You Need To Insert the Right Password !!";
    } else if(password_verify($OldPassword,$ligne["Password"])==1 ) {
      $req=mysqli_query($mysqli,"UPDATE authentification SET 
        First_Name='$FirstName',
        Last_Name='$LastName',
        Email='$Email',
        Password='$Password',
        Hint='$Hint'where Categorie=0") or die(mysqli_error($req));
      echo("success");
    }
  }

  
  


        
}


if(isset($_POST["ModifyAdmin"]))
{
  $req1=$mysqli->query("select * from authentification a where a.Categorie=0");
  $employee=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $employee[]=$ligne;
  }
  echo json_encode($employee);
}
?>
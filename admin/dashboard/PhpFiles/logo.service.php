<?php
include "../../crud/dbConnexion.php";
//----add Design
if(isset($_POST["updateLogo"]))
{
    $random=date("Y-m-d");
    $images=[];
    $imgcount=count($_FILES['image']['name']);
    for($i=0;$i<$imgcount;$i++)
    {
        $images[]=$_FILES['image']['name'][$i];
        $label=$random.$_FILES['image']['name'][$i];
        move_uploaded_file($_FILES['image']['tmp_name'][$i],"..\..\..\assets\img\logo\\".$label);
    }   
    $req = $mysqli->query("UPDATE  `logo` SET
        logoLabel = '$label'
        Where id = '1'
        ")
    or die(mysqli_error());
   
     header("location:../logo");
}

if(isset($_POST["loadLogo"]))
{
   
    $logoLabel=[];
    $req = $mysqli->query("select logoLabel from logo where id='1'")
    or die(mysqli_error());
    
    while($ligne=mysqli_fetch_assoc($req))
    {
      $logoLabel[]=$ligne;
    }
    echo json_encode($logoLabel);
}


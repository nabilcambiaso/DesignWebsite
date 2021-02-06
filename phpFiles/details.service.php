<?php
include "./db/config.php";

if(isset($_POST['loadDetails'])){
    $designs=[];
    $idDesign=mysqli_real_escape_string($mysqli ,$_POST["idDesign"]);
    $sql = "SELECT * FROM `design` where idDesign='$idDesign'";
    $req=$mysqli->query($sql) or die(mysqli_error());
    while($ligne=mysqli_fetch_assoc($req)) {
         $designs[]=$ligne;
    }    
    echo json_encode($designs);
}

?>
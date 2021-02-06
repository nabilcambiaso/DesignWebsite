<?php
include "./db/config.php";

if(isset($_POST['saved'])){
    $designs=[];
    $idDesign=$_POST["saved"];
    foreach ($idDesign as $value) {
        $sql = "SELECT * FROM `design` where idDesign='$value'";
        $req=$mysqli->query($sql) or die(mysqli_error());
        while($ligne=mysqli_fetch_assoc($req)) {
             $designs[]=$ligne;
        }   
   } 
      
    echo json_encode($designs);
}

?>
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
if(isset($_POST['loadProducts'])){
    $products=[];
    $idProduct=mysqli_real_escape_string($mysqli ,$_POST["idProduct"]);
    $sql = "SELECT * FROM `products` where idProducts='$idProduct'";
    $req=$mysqli->query($sql) or die(mysqli_error());
    while($ligne=mysqli_fetch_assoc($req)) {
         $products[]=$ligne;
    }    
    echo json_encode($products);
}
?>
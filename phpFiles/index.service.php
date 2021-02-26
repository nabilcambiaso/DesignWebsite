<?php
include "./db/config.php";

if(isset($_POST['load'])){
      $designs=[];
      $sql = "SELECT * FROM `design` ORDER by date desc limit 3 ";
      $req=$mysqli->query($sql) or die(mysqli_error());
      
      while($ligne=mysqli_fetch_assoc($req)) {
           $designs[]=$ligne;
      }    
      echo json_encode($designs);
  }


  if(isset($_POST['loadProducts'])){
     $prodcuts=[];
     $sql1 = "SELECT * FROM `products` ORDER by date desc limit 3 ";
     $req1=$mysqli->query($sql1) or die(mysqli_error());

     while($ligne=mysqli_fetch_assoc($req1)) {
         $prodcuts[]=$ligne;
    }    
     echo json_encode($prodcuts);
 }



?>
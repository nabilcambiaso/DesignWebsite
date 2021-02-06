<?php

include "./db/config.php";
//all designs
if(isset($_POST['load'])){
  $id=mysqli_real_escape_string($mysqli ,$_POST["designId"]);
  $search=mysqli_real_escape_string($mysqli ,$_POST["search"]);
  $designs=[];
  if($id=="")
  {
    $sql = "select * from design where label like '%$search%'";
  }
  else{
    $sql = "select * from design where category_id ='$id' and label like '%$search%' ";
  }
    $req=$mysqli->query($sql) or die(mysqli_error());
    while($ligne=mysqli_fetch_assoc($req)) {
         $designs[]=$ligne;
    }    
    echo json_encode($designs);
}
//all categories
if(isset($_POST['loadCategories'])){
  $category=[];
    $sql = "select * from category ";
    $req=$mysqli->query($sql) or die(mysqli_error());
    while($ligne=mysqli_fetch_assoc($req)) {
         $category[]=$ligne;
    }    
    echo json_encode($category);
}
if(isset($_POST['like'])){
    $idDesign=mysqli_real_escape_string($mysqli ,$_POST["likeId"]);
    $sql = "update design set likes=likes+1 where idDesign='$idDesign' ";
    $req=$mysqli->query($sql) or die(mysqli_error());

    echo ("success");
}
?>
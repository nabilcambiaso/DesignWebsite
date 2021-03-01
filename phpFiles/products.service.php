<?php

include "./db/config.php";




//all products and searched products
if(isset($_POST['load'])){
  $id=mysqli_real_escape_string($mysqli ,$_POST["productsId"]);
  $search=mysqli_real_escape_string($mysqli ,$_POST["search"]);
  $products=[];
  if($id=="")
  {
    $sql = "select * from products where label like '%$search%'";
  }
  else{
    $sql = "select * from products where category_id ='$id' and label like '%$search%' ";
  }
    $req=$mysqli->query($sql) or die(mysqli_error());
    while($ligne=mysqli_fetch_assoc($req)) {
         $products[]=$ligne;
    }    
    echo json_encode($products);
}


//all categories
if(isset($_POST['loadCategories'])){
  $category=[];
    $sql = "select * from category_products ";
    $req=$mysqli->query($sql) or die(mysqli_error());
    while($ligne=mysqli_fetch_assoc($req)) {
         $category[]=$ligne;
    }    
    echo json_encode($category);
}


//likes
if(isset($_POST['like'])){
    $idProducts=mysqli_real_escape_string($mysqli ,$_POST["likeId"]);
    $sql = "update products set likes=likes+1 where idProducts='$idProducts'";
    $req=$mysqli->query($sql) or die(mysqli_error());

    echo ("success");
}
?>

<?php
include "../../crud/dbConnexion.php";
//onload
if(isset($_POST["load"]))
{
  $req1=$mysqli->query("select * from products d join category_products c on c.id=d.category_id");
  $products=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $products[]=$ligne;
  }
  echo json_encode($products);
}


//onload categories
if(isset($_POST["loadCategories"]))
{
  $req1=$mysqli->query("select * from category_products");
  $category=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $category[]=$ligne;
  }
  echo json_encode($category);
}

//----add product
if(isset($_POST["productFNameSubscribe"]))
{
    
    $Productlabel=mysqli_real_escape_string($mysqli ,$_POST["productFNameSubscribe"]);
    $ProductDescription=mysqli_real_escape_string($mysqli ,$_POST["productDescriptionAdd"]);
    $ProductCategory=mysqli_real_escape_string($mysqli ,$_POST["productCategoryAdd"]);
   
    $images=[];
    $imgcount=count($_FILES['image']['name']);
    for($i=0;$i<$imgcount;$i++)
    {
        $images[]=$Productlabel.$_FILES['image']['name'][$i];
        $label=$Productlabel.$_FILES['image']['name'][$i];
        move_uploaded_file($_FILES['image']['tmp_name'][$i],"..\..\..\assets\img\products\\".$label);
    }      
    $req=mysqli_query($mysqli,"insert into products(label,image1,image2,image3,description,category_id)
     values('$Productlabel','$images[0]','$images[1]','$images[2]','$ProductDescription','$ProductCategory')") or die(mysqli_error());
     header("location:../products");
}


// delete product
if(isset($_POST["deleteproduct"])) {
 
  $ProductId=mysqli_real_escape_string($mysqli ,$_POST["productId"]);
  $req=$mysqli->query("delete from products
  where idProducts='$ProductId'") or die(mysqli_error($req));
}


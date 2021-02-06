<?php
include "../../../crud/dbConnexion.php";
//onload *
if (isset($_POST["loadCategorys"])) {
    $req1 = $mysqli->query("select * from category_products") or die(mysqli_error());
    $category = [];
    while ($ligne = mysqli_fetch_assoc($req1)) {
        $category[] = $ligne;
    }
    echo json_encode($category);
}


//Add New Category To Countrys List in db *
if (isset($_POST["AddNewCategory"])) {
    
    $Category_Name = mysqli_real_escape_string($mysqli, $_POST["Category_Name"]);
     
    if($Category_Name=="")
    {
      echo("2");
    }
    else{
        $req1 = $mysqli->query("INSERT INTO `category_products`
        (catLabel) values ('$Category_Name')")
      or die(mysqli_error());
      echo ("success");
    }

}

//Remove a location from location List in db *
if (isset($_POST["Delete_Category"])) {
    $category_id = mysqli_real_escape_string($mysqli, $_POST["Category_Id"]);
    $req1 = $mysqli->query("delete from category_products where id='$category_id'")
    or die(mysqli_error());
    echo ("success");
}

// Edit Location Data *
if (isset($_POST["edit_Category"])) {
    $Category_Name=mysqli_real_escape_string($mysqli, $_POST["Category_Name"]);
    $category_id = mysqli_real_escape_string($mysqli, $_POST["Category_Id"]);
    $req1 = $mysqli->query("UPDATE  `category_products` SET
        catLabel = '$Category_Name'
        Where id = '$category_id'
        ")
    or die(mysqli_error());
    echo ("success");

}

<?php
include "../../../crud/dbConnexion.php";
//onload *
if (isset($_POST["loadCategorys"])) {
    $req1 = $mysqli->query("select * from category") or die(mysqli_error());
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
        $req1 = $mysqli->query("INSERT INTO `category`
        (catLabel) values ('$Category_Name')")
      or die(mysqli_error());
      echo ("success");
    }

}

//Remove a location from location List in db *
if (isset($_POST["Delete_Category"])) {
    $category_id = mysqli_real_escape_string($mysqli, $_POST["Category_Id"]);
    $req1 = $mysqli->query("delete from category where id='$category_id'")
    or die(mysqli_error());
    echo ("success");
}

// Edit Location Data *
if (isset($_POST["edit_Category"])) {
    $Category_Name=mysqli_real_escape_string($mysqli, $_POST["Category_Name"]);
    $category_id = mysqli_real_escape_string($mysqli, $_POST["Category_Id"]);
    $req1 = $mysqli->query("UPDATE  `category` SET
        catLabel = '$Category_Name'
        Where id = '$category_id'
        ")
    or die(mysqli_error());
    echo ("success");

}

/*
// Load Location Data to Edit *
if (isset($_POST["loadLocation"])) {
    $Location_ID = mysqli_real_escape_string($mysqli, $_POST["Location_ID"]);

    $req1 = $mysqli->query("select * from `location` l join country c on c.country_code = l.country  WHERE location_id = '$Location_ID'");
    $locations = [];

    while ($ligne = mysqli_fetch_assoc($req1)) {
        $locations[] = $ligne;
    }
    echo json_encode($locations[0]);
}




*/
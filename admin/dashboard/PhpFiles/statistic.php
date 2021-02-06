<?php
include "../../crud/dbConnexion.php";
//all designs
if(isset($_POST['totalDesigns'])){
  $num=[];
    $sql = "select count(*) as nbr from design ";
    $req=$mysqli->query($sql) or die(mysqli_error());
    while($ligne=mysqli_fetch_assoc($req)) {
         $num[]=$ligne;
    }    
    echo json_encode($num);
}

//TOTAL EMPLOYEES/Location
if(isset($_POST['Location'])){
    
    $req1 =$mysqli->query("select count(*) as nbr,l.location_name, l.location_id from employee_info e join location l on e.location=l.location_id where e.Archived='0' and l.Archived='0' group by l.location_id");
    $location=[];
    while($ligne=mysqli_fetch_assoc($req1))
    {
      $location[]=$ligne;
    }
    echo json_encode($location);
    
}

/*
  if(isset($_POST["btnModify"]))
{

    $img=$_FILES['image']['name'];
    $new=$reference.$img;
    $path="images/";
    
 
        move_uploaded_file($_FILES['image']['tmp_name'],$path.$new);
        $req=mysqli_query($mysqli,"UPDATE article SET designation='$designation' ,descriptions='$description' ,idcategorie='$categorie' , prix1='$price1' , prix2='$price2' , prix3='$price3',  imageArt='$new' , seul='$quantite' , datePublication='$date' where reference like '$reference'") or die(mysqli_error($req));
         header("location:../admin.php");
    

}
*/

?>
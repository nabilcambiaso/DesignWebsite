<?php

include "./db/config.php";

if(isset($_POST["loadLogo"]))
{
   
    $logoLabel=[];
    $req = $mysqli->query("select logoLabel from logo where id='1'")
    or die(mysqli_error());
    
    while($ligne=mysqli_fetch_assoc($req))
    {
      $logoLabel[]=$ligne;
    }
    echo json_encode($logoLabel);
}
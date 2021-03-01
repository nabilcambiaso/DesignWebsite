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

//all designs
if(isset($_POST['totalProducts'])){
  $num=[];
    $sql = "select count(*) as nbr from products ";
    $req=$mysqli->query($sql) or die(mysqli_error());
    while($ligne=mysqli_fetch_assoc($req)) {
         $num[]=$ligne;
    }    
    echo json_encode($num);
}

//all messages
if(isset($_POST['totalMessages'])){
  $num=[];
  $num2=[];
    $sql = "select count(*) as nbr from messages";
    $sql2 = "select count(*) as nbr from messages where seen=0  ";
    $req=$mysqli->query($sql) or die(mysqli_error());
    while($ligne=mysqli_fetch_assoc($req)) {
         $num[]=$ligne;
    }  
    $req2=$mysqli->query($sql2) or die(mysqli_error());
    while($ligne=mysqli_fetch_assoc($req2)) {
         $num2[]=$ligne;
    } 
    echo json_encode( [(object)$num, (object)$num2]);
}

//onload messages buttons
if(isset($_POST["loadMessages"]))
{
  $req1=$mysqli->query("select * from messages order by date desc");
  $messages=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $messages[]=$ligne;
  }
  echo json_encode($messages);
}

//select the message of the user
if(isset($_POST["idMessage"]))
{
$idMessage=$_POST["idMessage"];
  $req1=$mysqli->query("select * from messages where idMessages='$idMessage'");
  $messages=[];
  while($ligne=mysqli_fetch_assoc($req1))
  {
    $messages[]=$ligne;
  }

  $req1=$mysqli->query("update  messages set seen=1 where idMessages='$idMessage'");

  echo json_encode($messages);
}




?>
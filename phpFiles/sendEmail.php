<?php 
if(isset($_POST["sentMessage"]))
{
$from=$_POST["from"];

$to="nabilcambiaso@gmail.com";
$subject=$_POST["subject"];
$message="<div><h1>Majda Design</h1><br><h3>Message from :".$_POST["fullName"]."</h3><br>
          <h4>".$_POST["telephone"]."</h4>
          <h5>".$_POST["message"]."</h5><br>
          </div>";
$headers="From:".$from."\r\n";
$headers .="MIME-Version: 1.0"."\r\n"; 
$headers .="Content-type:text/html;charset=UTF-8"."\r\n"; 
 
mail($to,$subject,$message,$headers);
echo 'it worked';
}

?>
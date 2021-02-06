<?php 
include "./db/config.php";

if(isset($_POST["sentMessage"]))
{
$from=$_POST["from"];
$to="nabilcambiaso@gmail.com";
$subject=$_POST["subject"];
$fullName=$_POST["fullName"];
$telephone=$_POST["telephone"];
$themessage=$_POST["message"];
$url=$_POST["url"];
if($url=="")
{
    $message="<div><h1>Majda Design</h1><br><h3>Message from :".$fullName."</h3><br>
    <h4>".$telephone."</h4>
    <h5>".$themessage."</h5><br>
    </div>";
}
else{
    $message="<div><h1>Majda Design</h1><br><h3>Message from :".$fullName."</h3><br>
    <h4>".$telephone."</h4>
    <h5>".$themessage."</h5><br>
    <h5> Link :<a href='$url'>Design<a/></h5>
    </div>";
}
$headers="From:".$from."\r\n";
$headers .="MIME-Version: 1.0"."\r\n"; 
$headers .="Content-type:text/html;charset=UTF-8"."\r\n"; 
 
mail($to,$subject,$message,$headers);

//$req1 = $mysqli->query("INSERT INTO `category`(catLabel) values ('$Category_Name')")or die(mysqli_error());

echo 'it worked';
}

?>
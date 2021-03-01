<?php 
include "./db/config.php";

if(isset($_POST["sentMessage"]))
{
$from=mysqli_real_escape_string($mysqli ,$_POST["from"]);
$to="nabilcambiaso@gmail.com";
$subject=mysqli_real_escape_string($mysqli ,$_POST["subject"]);
$fullName=mysqli_real_escape_string($mysqli ,$_POST["fullName"]);
$telephone=mysqli_real_escape_string($mysqli ,$_POST["telephone"]);
$themessage=mysqli_real_escape_string($mysqli ,$_POST["message"]);
$url=mysqli_real_escape_string($mysqli ,$_POST["url"]);
$date=date("Y-m-d h:i:sa");
if($from!="" && $subject!="" && $fullName!="" && $telephone!="" && $themessage!="")
{
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
    <h5> Link :<a href='$url'>Link <a/></h5>
    </div>";
}
$headers="From:".$from."\r\n";
$headers .="MIME-Version: 1.0"."\r\n"; 
$headers .="Content-type:text/html;charset=UTF-8"."\r\n"; 
 
mail($to,$subject,$message,$headers);

$req1 = $mysqli->query("INSERT INTO `messages`(email,name,phone_number,subject,url,message,date) values 
('$from','$fullName','$telephone','$subject','$url','$themessage','$date')")or die(mysqli_error());
}
}

?>
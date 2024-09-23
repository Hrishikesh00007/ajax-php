<?php 

$con=mysqli_connect("localhost","root","","forthtest") or die("connection Failed");

$sql="INSERT INTO `customers` (`name`,`email`,`mobile`,`city`) VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['mobile']."','".$_POST['city']."')";

if(mysqli_query($con,$sql)){
    echo 1;
}else{
    echo 0;
}

?>
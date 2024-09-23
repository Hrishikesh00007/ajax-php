<?php 

$con=mysqli_connect("localhost","root","","forthtest") or die("connection Failed");

$sql="UPDATE `customers` SET `name`='".$_POST['name']."',`email`='".$_POST['email']."',`mobile`='".$_POST['mobile']."',`city`='".$_POST['city']."'   WHERE `id`='".$_POST['id']."' ";

if(mysqli_query($con,$sql)){
    echo 1;
}else{
    echo 0;
}

?>
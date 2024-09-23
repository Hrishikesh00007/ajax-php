<?php 

$con=mysqli_connect("localhost","root","","forthtest") or die("connection Failed");

$sql="DELETE FROM `customers` WHERE `id`='".$_POST['id']."' ";

if(mysqli_query($con,$sql)){
    echo 1;
}else{
    echo 0;
}

?>
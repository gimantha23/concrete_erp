<?php
include("db_connect.php");
session_start();
$user_id = $_POST["user_id"];
$pwd = $_POST["txtConPwd"];

$update_pwd = mysqli_query($con, "UPDATE users SET password='$pwd' WHERE user_id='$user_id'");

if($update_pwd){
    echo "success";
    header('location:../Pages/manage_user.php');
}else{
    echo(mysqli_error($con));
}

mysqli_close($con);
?>
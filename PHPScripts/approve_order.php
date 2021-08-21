<?php
session_start();
include ("db_connect.php");

date_default_timezone_set("Asia/Colombo");
$approved_datetime = date("Y-m-d H:i");
$logged_user_id = $_SESSION["user_id"];
$jobno = $_POST['jobno'];

$approve_order_status = mysqli_query($con, "UPDATE concrete_order SET approved='yes', approved_by='$logged_user_id', approved_datetime='$approved_datetime' WHERE job_no='$jobno'");

if(!$approve_order_status){
    echo(mysqli_error($con));
}else{
    echo "success";
}
?>
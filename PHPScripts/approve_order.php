<?php
session_start();
include ("db_connect.php");

date_default_timezone_set("Asia/Colombo");
$approved_datetime = date("Y-m-d H:i");
$logged_user_id = $_SESSION["user_id"];
$jobno = $_POST['jobno'];
$pay_id = $_POST['pay_id'];
$receiptno = $_POST['receiptno'];
$paymode = $_POST['paymode'];
$paydate = $_POST['paydate'];

if($pay_id==""){
    $insert_pay_details = mysqli_query($con, "INSERT INTO `payments`(`job_no`, `pay_receipt_no`, `pay_mode`, `payment_date`) VALUES ('$jobno','$receiptno','$paymode','$paydate')");
    $inserted_payment_id = mysqli_insert_id($con);

    mysqli_query($con, "UPDATE concrete_order SET payment_id='$inserted_payment_id' WHERE job_no='$jobno'");
}

$approve_order_status = mysqli_query($con, "UPDATE concrete_order SET approved='yes', approved_by='$logged_user_id', approved_datetime='$approved_datetime' WHERE job_no='$jobno'");


if(!$approve_order_status){
    echo(mysqli_error($con));
}else{
    echo "success";
}
?>
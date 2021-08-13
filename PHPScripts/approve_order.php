<?php
include ("db_connect.php");

$jobno = $_POST['jobno'];

$approve_order_status = mysqli_query($con, "UPDATE concrete_order SET approved='yes' WHERE job_no='$jobno'");


if(!$approve_order_status){
    echo(mysqli_error($con));
}else{
    echo "success";
}
?>
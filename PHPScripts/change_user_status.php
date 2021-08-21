<?php
include ("db_connect.php");

$uid = $_POST['uid'];
$action = $_POST['action'];

if($action=="Activate"){
    $new_status='yes';
}else if($action=="Deactivate"){
    $new_status='no';
}

$update_user_status = mysqli_query($con, "UPDATE users SET active='$new_status' WHERE user_id='$uid'");

if(!$update_user_status){
    echo(mysqli_error($con));
}else{
    echo "success";
}
?>
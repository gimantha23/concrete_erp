<?php
session_start();
$username = $_POST['username'];
require("db_connect.php");

$sel_username = mysqli_query($con, "SELECT * from users WHERE username='$username'");
if(mysqli_num_rows($sel_username)>0){
    echo "duplicate";
}else{
    echo "ok";
}
?>
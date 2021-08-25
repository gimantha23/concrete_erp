<?php
session_start();
if(isset($_POST['btnSubmit'])){
    require("db_connect.php");

    $uid = $_POST['user_id'];
    $username = $_POST['txtUsername'];
    $fname = $_POST['txtFirstName'];
    $lname = $_POST['txtLastName'];
    $email = $_POST['txtEmail'];

    $update_user = mysqli_query($con, "UPDATE users SET username='$username', first_name='$fname', last_name='$lname', email='$email' WHERE user_id='$uid'");

    if($update_user){
        header('location:../Pages/manageUser.php');
    }

    mysqli_close($con);

}
?>
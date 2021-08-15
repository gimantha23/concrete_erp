<?php
session_start();
if(isset($_POST['btnSubmit'])){
    require("db_connect.php");

    $logged_user_id = $_SESSION["user_id"];
    $today_date = date("Y-m-d");
    $username = $_POST['txtUsername'];
    $fname = $_POST['txtFirstName'];
    $lname = $_POST['txtLastName'];
    $usertype = $_POST['selUserType'];
    $email = $_POST['txtEmail'];
    $pw = $_POST['txtConPwd'];

    $add_user = mysqli_query($con, "INSERT INTO `users`(`username`, `first_name`, `last_name`, `user_type`, `password`, `email`, `active`, `added_date`, `added_by`) 
                                                VALUES ('$username','$fname','$lname','$usertype','$pw','$email','yes','$today_date','$logged_user_id')");

    if($add_user){
        header('location:../Pages/dashboard.php');
    }

    mysqli_close($con);


}
?>
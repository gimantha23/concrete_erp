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
    $sales_code = $_POST['txtSalesCode'];

    $add_user = mysqli_query($con, "INSERT INTO `users`(`username`, `first_name`, `last_name`, `user_type`, `password`, `email`, `active`, `added_date`, `added_by`) 
                                                VALUES ('$username','$fname','$lname','$usertype','$pw','$email','yes','$today_date','$logged_user_id')");
    $inserted_user_id = mysqli_insert_id($con);

    $add_sales_code = mysqli_query($con, "INSERT INTO `sales_code`(`user_id`, `sales_code_prefix`) VALUES ('$inserted_user_id','$sales_code')");

    if($add_user && $add_sales_code){
        header('location:../Pages/manageUser.php');
    }

    mysqli_close($con);


}
?>
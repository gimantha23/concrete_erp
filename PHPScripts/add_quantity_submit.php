<?php
session_start();
if(isset($_POST['btnSubmit'])){
    require("db_connect.php");

    $logged_user_id = $_SESSION["user_id"];
    $today_date = date("Y-m-d");
    $job_no = $_POST['job_no'];
    $added_qty = $_POST['txtQty'];
    $comments = $_POST['txtComments'];

    $insert_data = mysqli_query($con, "INSERT INTO `additional_qty`(`job_no`, `added_qty`, `comments`, `logged_user`, `added_date`) 
                                        VALUES ('$job_no','$added_qty','$comments','$logged_user_id','$today_date')");

    $get_current_qty = mysqli_query($con, "SELECT requested_quantity FROM concrete_order WHERE job_no='$job_no'");
    $res_current_qty = mysqli_fetch_array($get_current_qty);

    $new_quantity = (float)$res_current_qty[0] + (float)$added_qty; 

    $update_quantity_in_order = mysqli_query($con, "UPDATE concrete_order SET requested_quantity='$new_quantity' WHERE job_no='$job_no'");

    if($insert_data && $update_quantity_in_order){
        header('location:../Pages/addQuantityList.php');
    }

    mysqli_close($con);

}
?>
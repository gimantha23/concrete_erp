<?php
    session_start();
    if(!isset($_SESSION["user_id"])){
        header('location:./index.php');
    }
    $user_id = $_SESSION["user_id"];
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/c829a83b30.js"></script>
    <link rel="stylesheet" href="../assets/css/mainStyles.css">
    <link rel="stylesheet" href="../assets/css/userProfileStyles.css">

    <title>User Profile</title>
    <script type="text/javascript">
    function goBack() {
        window.history.back();
    }
    </script>
</head>

<body>
    <?php
require('../Components/header.php');
include("../PHPScripts/db_connect.php");
$sel_user_details = mysqli_query($con, "SELECT * FROM users WHERE user_id='$user_id'");
$res_user_details = mysqli_fetch_array($sel_user_details);

if($res_user_details['active']=="yes"){
    $status = "<span class='active'>Active</span>";
}else{
    $status = "<span class='inactive'>Inactive</span>";
}
?>
    <div class="container page-spacing center-card">
        <div class="card" style="width: 18rem;">
            <i class="fa fa-user-circle-o user-icon" aria-hidden="true"></i>
            <div class="card-body">
                <h5 class="card-title underline">
                    <u><?php echo $res_user_details['first_name']." ".$res_user_details['last_name']; ?></u>
                </h5>
                <br/>
                <table border=0 align=center width=100%>
                    <tr>
                        <td class="title">Username</td>
                        <td><?php echo $res_user_details['username'] ?></td>
                    </tr>
                    <tr>
                        <td class="title">Department</td>
                        <td><?php echo $res_user_details['user_type'] ?></td>
                    </tr>
                    <tr>
                        <td class="title">Added date</td>
                        <td><?php echo $res_user_details['added_date'] ?></td>
                    </tr>
                    <tr>
                        <td class="title">Status</td>
                        <td><?php echo $status; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
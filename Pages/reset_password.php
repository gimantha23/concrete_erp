<?php
    session_start();
    if(!isset($_SESSION["user_id"])){
        header('location:./index.php');
    }
    $user_type = $_SESSION["user_type"];
    if($user_type=="sales" || $user_type=="account" || $user_type=="production"){
        echo "Sorry! You are not authorized to view this page";
        return;
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Jquery, autocomplete -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js"
        integrity="sha512-TToQDr91fBeG4RE5RjMl/tqNAo35hSRR4cbIFasiV2AAMQ6yKXXYhdSdEpUcRE6bqsTiB+FPLPls4ZAFMoK5WA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/c829a83b30.js"></script>
    <link rel="stylesheet" href="../assets/css/mainStyles.css">
    
    <title>Reset Password</title>

    <script type="text/javascript">
    function getXmlHttpRequestObject() {
        if (window.XMLHttpRequest) {
            return new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            return new ActiveXObject("Microsoft.XMLHTTP");
        } else {}
    }
    function goBack() {
        window.history.back();
    }
    function check_passwords(){
        const pwd = document.getElementById("txtPwd").value;
        const con_pwd = document.getElementById("txtConPwd").value;
        if(pwd!==con_pwd){
            document.getElementById("txtConPwd").value="";
            document.getElementById("txtConPwd").classList.add("is-invalid");
            document.getElementById("pwd_mismatch_error").innerHTML="Passwords do not match";
            document.getElementById("submitButton").disabled=true;
        }else{
            document.getElementById("pwd_mismatch_error").innerHTML="";
            document.getElementById("txtConPwd").classList.remove("is-invalid");
            document.getElementById("submitButton").disabled=false;
        }
    }
    </script>
</head>

<body>
<?php
    require('../Components/header.php');
    
    $uid = $_GET["uid"];
    date_default_timezone_set("Asia/Colombo");
    $today_date = date("Y.m.d H:i");
    include('../PHPScripts/db_connect.php');

    $sel_data = mysqli_query($con, "SELECT * FROM users WHERE user_id='$uid'");
    $res_data = mysqli_fetch_array($sel_data);
    ?>
    <div class="container page-spacing">
        <form action="../PHPScripts/reset_password_submit.php" method="post">
            <div class="row mb-3 mt-3">
                <div class="col-md-3">
                    <label for="txtPwd">New Password</label>
                    <input type="password" class="form-control" id="txtPwd" name="txtPwd" required>
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $uid; ?>">
                </div>
                <div class="col-md-3">
                    <label for="txtConPwd">Confirm New Password</label>
                    <input type="password" class="form-control" id="txtConPwd" name="txtConPwd" onchange="check_passwords();" required>
                    <div id="pwd_mismatch_error" class="invalid-feedback"></div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-2 offset-5">
                    <button type="submit" class="btn btn-primary" name="btnSubmit" id="submitButton">Submit</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>
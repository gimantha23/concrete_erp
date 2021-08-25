<?php
    session_start();
    if(!isset($_SESSION["user_id"])){
        header('location:./index.php');
    }
    $user_type = $_SESSION["user_type"];
    if($user_type=="sales" || $user_type=="account" || $user_type=="production"){
        header('location:../ErrorBoundary/403.php');
        return;
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/c829a83b30.js"></script>
    <link rel="stylesheet" href="../assets/css/mainStyles.css">
    
    <title>Update User</title>

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
    function check_username() {
        const uname = document.getElementById("txtUsername").value;
        if(uname){
            var req = getXmlHttpRequestObject();
            if (req) {
                req.onreadystatechange = function() {
                    if (req.readyState == 4) {
                        if (req.status == 200) {
                            if (req.responseText == "ok") {
                                document.getElementById("txtUsername").classList.remove("is-invalid");
                                document.getElementById("txtUsername").classList.add("is-valid");
                                document.getElementById("username_success").innerHTML="Username is available";
                                document.getElementById("submitButton").disabled=false;
                            } else if (req.responseText == "duplicate") {
                                document.getElementById("txtUsername").classList.remove("is-valid");
                                document.getElementById("txtUsername").classList.add("is-invalid");
                                document.getElementById("duplicate_username_error").innerHTML="Username is taken.";
                                document.getElementById("submitButton").disabled=true;
                            }
                        }
                    }
                }
                req.open("POST", "../PHPScripts/check_username.php", true);
                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                req.send("username=" + uname);
            }
        }else{
            document.getElementById("txtUsername").classList.remove("is-invalid");
            document.getElementById("txtUsername").classList.remove("is-valid");
            document.getElementById("duplicate_username_error").innerHTML="";
            document.getElementById("username_success").innerHTML="";
            document.getElementById("submitButton").disabled=true;
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
        <form action="../PHPScripts/update_user_submit.php" method="post">
            <div class="row mb-3 mt-3">
                <div class="col-md-3">
                    <label for="txtUsername">Username</label>
                    <input type="text" class="form-control" id="txtUsername" name="txtUsername" onchange="check_username();" value="<?php echo $res_data['username']; ?>" required>
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $uid; ?>">
                    <div id="username_success" class="valid-feedback"></div>
                    <div id="duplicate_username_error" class="invalid-feedback"></div>
                </div>
                <div class="col-md-3">
                    <label for="txtFirstName">First Name</label>
                    <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" value="<?php echo $res_data['first_name']; ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="txtLastName">Last Name</label>
                    <input type="text" class="form-control" id="txtLastName" name="txtLastName" value="<?php echo $res_data['last_name']; ?>" required>
                </div>
            </div>

            <div class="row mb-3 mt-3">
                <div class="col-md-3">
                    <label for="selUserType">Department</label>
                    <select class="form-control" id="selUserType" name="selUserType" readonly>
                        <option value='<?php echo $res_data['user_type']; ?>'><?php echo $res_data['user_type']; ?></option>
                        <option value='manager'>Manager</option>
                        <option value='sales'>Sales</option>
                        <option value='account'>Accounts</option>
                        <option value='production'>Production</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="txtEmail">Email</label>
                    <input type="email" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo $res_data['email']; ?>">
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary" name="btnSubmit" id="submitButton">Submit</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>
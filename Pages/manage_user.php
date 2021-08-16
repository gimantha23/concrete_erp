<?php
    session_start();
    if(!isset($_SESSION["user_id"])){
        header('location:./index.php');
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Jquery, datatable -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
    </script>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/c829a83b30.js"></script>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <title>Manage Users</title>

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
    $(document).ready(function() {
        $('#users_table').DataTable();
    });
    function change_user_status(selectedAction, uname, uid){
        let action = confirm("Do you wish to "+selectedAction+" "+uname+"'s Account?");
        if (action) {
            var req = getXmlHttpRequestObject();
            if (req) {
                req.onreadystatechange = function() {
                    if (req.readyState == 4) {
                        if (req.status == 200) {
                            if (req.responseText == "success") {
                                alert(selectedAction+"d "+uname+"'s account");
                            } else {
                                alert("An error occured");
                            }
                            location.reload();
                        }
                    }
                }
                req.open("POST", "../PHPScripts/change_user_status.php", true);
                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                req.send("uid=" + uid + "&action="+selectedAction);
            }
        }
    }
    function update_user_page(uid){
        window.location.href = "update_user.php?uid="+uid;
    }
    function reset_password_page(uid){
        window.location.href = "reset_password.php?uid="+uid;
    }
    </script>
</head>

<body>
<?php
require('../Components/header.php');
?>
    <div class="container" style="height:50vh;margin-top:80px; margin-bottom:80px;">
        <table id="users_table" class="display table table-bordered">
            <thead>
                <tr style="text-align:center;">
                    <th>Username</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
<?php
    include('../PHPScripts/db_connect.php');
    $get_users = mysqli_query($con, "SELECT * FROM users");
    while($res_users = mysqli_fetch_array($get_users)){

        $status='';
        if($res_users['active']=="yes"){
            $status="Active";
        }else if ($res_users['active']=="no"){
            $status="Inactive";
        }
?>
                <tr>
                    <td><?php echo $res_users['username']; ?></td>
                    <td><?php echo $res_users['first_name']." ".$res_users['last_name'] ?></td>
                    <td style="text-transform:capitalize;"><?php echo $res_users['user_type']; ?></td>
                    <td style="text-align:right;"><?php echo $res_users['email']; ?></td>
                    <td style="text-align:right;"><?php echo $status; ?></td>
                    <td style="text-align:center;">
                        <button class="btn-sm btn-primary" onclick="update_user_page('<?php echo $res_users['user_id']; ?>');">Update</button>
                        <button type="button" class="btn-sm btn-warning" name="btnResetPw" id="btnResetPw" onclick="reset_password_page('<?php echo $res_users['user_id']; ?>')">Reset Password</button>
                        <?php
                         if($res_users['active']=="yes"){
                        ?>
                             <button class="btn-sm btn-danger" onclick="change_user_status('Deactivate','<?php echo $res_users['username'] ?>', '<?php echo $res_users['user_id'] ?>');">Deactivate</button>
                        <?php
                         }else if($res_users['active']=="no") {
                        ?>
                            <button class="btn-sm btn-success" onclick="change_user_status('Activate','<?php echo $res_users['username']; ?>','<?php echo $res_users['user_id'];?>');">Activate</button>
                        <?php
                         }
                        ?>
                    </td>
                </tr>
<?php
    }
?>

            </tbody>
        </table>
    </div>
    <?php
require('../Components/footer.php');
?>
</body>

</html>
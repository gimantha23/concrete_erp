<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header('location:./index.php');
}
$user_type = $_SESSION["user_type"];
    if($user_type=="sales" || $user_type=="production"){
        header('location:../ErrorBoundary/403.php');
        return;
    }
$job_no = ($_GET['jobid']);
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
    
    <title>Add Quantity</title>

    <script type="text/javascript">
    function goBack() {
        window.history.back();
    }
    </script>
</head>

<body>
<?php
    require('../Components/header.php');

    include('../PHPScripts/db_connect.php');
    $sel_order_details = mysqli_query($con, "SELECT * FROM concrete_order WHERE job_no = '$job_no'");    
    $res_order_details = mysqli_fetch_array($sel_order_details);

    $get_customer_details = mysqli_query($con, "SELECT * FROM customers WHERE id='".$res_order_details['customer_id']."'");
    $res_customer_details = mysqli_fetch_array($get_customer_details);
    ?>

    <div class="container page-spacing">
        <form action="../PHPScripts/add_quantity_submit.php" method="post">
            <div>
                <div class="row mb-3 mt-3">
                    <div class="col-md-3">
                        <label for="txtDate">Quantity (m<sup>3</sup>)</label>
                        <input type="number" step="0.1" min="0.1" class="form-control" id="txtQty" name="txtQty" required>               
                        <input type="hidden" name="job_no" value="<?php echo $job_no ?>">               
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-md-6">
                        <label for="txtDate">Comments</label>
                        <textarea class="form-control" id="txtComments" name="txtComments" required></textarea>                 
                    </div>
                </div>
                <div class="row mb-5 mt-5">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
</body>

</html>
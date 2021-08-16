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
    <title>View Past Sales Orders</title>

    <script type="text/javascript">
    function goBack() {
        window.history.back();
    }
    $(document).ready(function() {
        $('#view_sales_orders').DataTable();
    });
    </script>
</head>

<body>
<?php
require('../Components/header.php');
?>
    <div class="container" style="height:50vh;margin-top:80px; margin-bottom:80px;">
        <table id="view_sales_orders" class="display table table-bordered">
            <thead>
                <tr style="text-align:center;">
                    <th>Job No.</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Quantity</th>
                    <th>Approval</th>
                </tr>
            </thead>
            <tbody>
<?php
    $logged_user = $_SESSION["user_id"];
    include('../PHPScripts/db_connect.php');
    $get_order_records = mysqli_query($con, "SELECT * FROM concrete_order WHERE prepared_by='$logged_user'");
    while($result_order_records = mysqli_fetch_array($get_order_records)){

        $get_customer_name = mysqli_query($con, "SELECT customer_name FROM customers WHERE id='".$result_order_records['customer_id']."'");
        $res_customer_name = mysqli_fetch_array($get_customer_name);

        if($result_order_records['approved']=="yes"){
            $row_color_style = "style='background-color:#dfd !important'";
        }else{
            $row_color_style = "style='background-color:#fdd !important'";
        }
?>
                <tr <?php echo $row_color_style; ?>>
                    <td><?php echo $result_order_records['job_no']; ?></td>
                    <td><?php echo $result_order_records['date']; ?></td>
                    <td><?php echo $res_customer_name['customer_name']; ?></td>
                    <td style="text-align:right;"><?php echo $result_order_records['requested_quantity']; ?></td>
                    <td style="text-align:right;"><?php echo $result_order_records['approved']; ?></td>
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
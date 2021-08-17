<?php
    session_start();
    if(!isset($_SESSION["user_id"])){
        header('location:./index.php');
    }
    $user_type = $_SESSION["user_type"];
    if($user_type=="account" || $user_type=="sales"){
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
    <title>Production</title>

    <script type="text/javascript">
    function goBack() {
        window.history.back();
    }
    $(document).ready(function() {
        $('#production_datatable').DataTable();
    });

    function add_delivery_page(jobno){
        window.location.href = "add_delivery.php?jobno="+jobno;
    }
    function view_delivery_page(jobno){
        window.location.href = "view_delivery.php?jobno="+jobno;
    }
    </script>
</head>

<body>
<?php
require('../Components/header.php');
?>
    <div class="container" style="height:50vh;margin-top:80px; margin-bottom:80px;">
        <table id="production_datatable" class="display table table-bordered">
            <thead>
                <tr style="text-align:center;">
                    <th>Job No.</th>
                    <th>Customer</th>
                    <th>Delivery Date</th>
                    <th>Req Quantity (m<sup>3</sup>)</th>
                    <th>Sent Quantity (m<sup>3</sup>)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
<?php
    include('../PHPScripts/db_connect.php');
    $get_order_records = mysqli_query($con, "SELECT * FROM concrete_order WHERE approved='yes'");
    while($result_order_records = mysqli_fetch_array($get_order_records)){

        $get_customer_name = mysqli_query($con, "SELECT customer_name FROM customers WHERE id='".$result_order_records['customer_id']."'");
        $res_customer_name = mysqli_fetch_array($get_customer_name);

        $disabled="";
        if($result_order_records['order_complete']=="yes"){
            $disabled="disabled";
        }
?>
                <tr>
                    <td><?php echo $result_order_records['job_no']; ?></td>
                    <td><?php echo $res_customer_name['customer_name']; ?></td>
                    <td><?php echo $result_order_records['required_date']; ?></td>
                    <td style="text-align:right;"><?php echo $result_order_records['requested_quantity']; ?></td>
                    <td style="text-align:right;"><?php echo $result_order_records['total_delivered_qty']; ?></td>
                    <td style="text-align:center;">
                        <button type="button" class="btn btn-sm btn-primary" onclick="add_delivery_page('<?php echo $result_order_records['job_no']; ?>')" <?php echo $disabled; ?>>
                            Add delivery
                        </button>
                        <button type="button" class="btn btn-sm btn-primary" onclick="view_delivery_page('<?php echo $result_order_records['job_no']; ?>')">
                            View deliveries
                        </button>
                    </td>
                </tr>
<?php
    }
?>

            </tbody>
        </table>
    </div>
    
</body>

</html>
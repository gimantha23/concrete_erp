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
    <title>Accounts</title>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#table_id').DataTable();
    });

    function view_order_page(jobid){
        window.location.href = "view_order_details.php?jobid="+jobid;
    }
    </script>
</head>

<body>
    <header>
        <div class="container">
            <div class="row text-center page-heading">
                <h1>ERP Management System</h1>
                <h3>ABC Lanka PLC</h3>
            </div>
        </div>
        <nav class="navbar navbar-light navbar-expand bg-faded justify-content-center"
            style="background-color:#f3f3f3;font-size:24px;padding:0px;">
            <div class="container">
                <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
                    <ul class="navbar-nav w-100 justify-content-start">
                        <li class="nav-item active">
                            <a class="nav-link" href="./dashboard.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <table id="table_id" class="display table table-bordered">
            <thead>
                <tr style="text-align:center;">
                    <th>Job No.</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Quantity</th>
                    <th>Approval</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
<?php
    include('../PHPScripts/db_connect.php');
    $get_order_records = mysqli_query($con, "SELECT * FROM concrete_order");
    while($result_order_records = mysqli_fetch_array($get_order_records)){

        $get_customer_name = mysqli_query($con, "SELECT customer_name FROM customers WHERE id='".$result_order_records['customer_id']."'");
        $res_customer_name = mysqli_fetch_array($get_customer_name);
?>
                <tr>
                    <td><?php echo $result_order_records['job_no']; ?></td>
                    <td><?php echo $result_order_records['date']; ?></td>
                    <td><?php echo $res_customer_name['customer_name']; ?></td>
                    <td style="text-align:right;"><?php echo $result_order_records['quantity']; ?></td>
                    <td style="text-align:right;"><?php echo $result_order_records['approved']; ?></td>
                    <td style="text-align:center;"><button class="btn-sm btn-primary" onclick="view_order_page('<?php echo $result_order_records['job_no']; ?>')">view</button></td>
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
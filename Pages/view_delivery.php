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
    
    <title>Production</title>

    <script type="text/javascript">
    function goBack() {
        window.history.back();
    }
    $(document).ready(function() {
        $('#view_delivery_table').DataTable();
    });
    function print_delivery_note(job_no, delivery_no){
        window.open("delivery_note_print.php?jobno="+job_no+"&delivery_no="+delivery_no);
    }
    </script>
</head>

<body>
<?php
require('../Components/header.php');
?>
    <div class="container">
        <table id="view_delivery_table" class="display table table-bordered">
            <thead>
                <tr style="text-align:center;">
                    <th>Delivery Ticket No.</th>
                    <th>Date/Time</th>
                    <th>Trip</th>
                    <th>Delivered Quantity (m<sup>3</sup>)</th>
                    <th>Vehicle No.</th>
                    <th>Print</th>
                </tr>
            </thead>
            <tbody>
<?php
    include('../PHPScripts/db_connect.php');
    $job_no = $_GET['jobno'];
    $get_delivery_records = mysqli_query($con, "SELECT * FROM delivery WHERE job_no='$job_no'");
    while($result_delivery_records = mysqli_fetch_array($get_delivery_records)){
?>
                <tr>
                    <td><?php echo $result_delivery_records['delivery_no']; ?></td>
                    <td><?php echo $result_delivery_records['delivery_date']." ".$result_delivery_records['delivery_time'] ?></td>
                    <td><?php echo $result_delivery_records['trip_no']; ?></td>
                    <td style="text-align:right;"><?php echo $result_delivery_records['quantity']; ?></td>
                    <td style="text-align:right;"><?php echo $result_delivery_records['vehicle_no']; ?></td>
                    <td style="text-align:center;">
                        <button class="btn-sm btn-warning" onclick="print_delivery_note('<?php echo $job_no; ?>', '<?php echo $result_delivery_records['delivery_no']; ?>');">
                            <i class="fa fa-print" aria-hidden="true"></i>
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
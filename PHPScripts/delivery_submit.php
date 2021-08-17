<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header('location:../Pages/index.php');
}
if(isset($_POST['btnSubmit'])){

	include('db_connect.php');
        
    $job_no = $_POST["txtJobNo"];
    $logged_user_id = $_SESSION["user_id"];
    date_default_timezone_set("Asia/Colombo");
    $today_date = date("Y.m.d");
    $time_now = date("H:i");
    $prepared_datetime = date("Y-m-d H:i");

    $select_max_delivery_no = mysqli_query($con, "SELECT MAX(delivery_no) FROM delivery");
	$result_max_delivery_no = mysqli_fetch_array($select_max_delivery_no);
	if ($result_max_delivery_no[0] == '') {
		$delivery_no = '100';
	} else {
		$delivery_no = $result_max_delivery_no[0]+1;
    }

    $select_max_trip_no = mysqli_query($con, "SELECT MAX(trip_no) FROM delivery WHERE job_no='$job_no'");
	$result_max_trip_no = mysqli_fetch_array($select_max_trip_no);
	if ($result_max_trip_no[0] == '') {
		$trip_no = '1';
	} else {
		$trip_no = $result_max_trip_no[0]+1;
    }

    //requested qty
    $sel_requested_qty = mysqli_query($con, "SELECT requested_quantity FROM concrete_order WHERE job_no='$job_no'");
    $res_requested_qty = mysqli_fetch_array($sel_requested_qty); 
    $req_qty = $res_requested_qty['requested_quantity'];

    //current qty
    $sel_tot_qty = mysqli_query($con, "SELECT total_delivered_qty FROM concrete_order WHERE job_no='$job_no'");
    $res_tot_qty = mysqli_fetch_array($sel_tot_qty); 
    $current_qty = $res_tot_qty['total_delivered_qty'];

    //this delivery qty
    $delivered_qty = $_POST['txtDeliverQuantity'];

    $cumulative_delivered_qty = (float)$current_qty + (float)$delivered_qty;

    if($cumulative_delivered_qty >= $req_qty){
        $order_status="yes";
    }else{
        $order_status="no";
    }

    //update qty, status
    $update_qty = mysqli_query($con, "UPDATE concrete_order SET total_delivered_qty='$cumulative_delivered_qty', order_complete='$order_status' WHERE job_no='$job_no'");

    //insert delivery details
    $vehicle_no = $_POST['txtVehicleNo'];
    $driver = $_POST['txtDriver'];
    $contact_person = $_POST['txtContactPerson'];
    $contact_no = $_POST['txtContactNo'];
    $cement_type = $_POST['txtCementType'];
    $aggregate_size = $_POST['txtAggregateSize'];
    $mix_type = $_POST['txtMixType'];
    $admixture_1 = $_POST['txtAdmixture1'];
    $admixture_2 = $_POST['txtAdmixture2'];
    $design_slump = $_POST['txtDesignSlump'];
    $slump = $_POST['txtSlump'];
    $noofcubes = $_POST['txtNoOfCubes'];
    $temperature = $_POST['txtTemperature'];
    $dispatched_by = $_POST['txtDispatchedBy'];
    $dispatched_time = $_POST['txtDispatchedTime'];

    $insert_delivery = mysqli_query($con, "INSERT INTO `delivery`(`delivery_no`, `job_no`, `delivery_date`, `delivery_time`, `trip_no`, `quantity`, `vehicle_no`, `driver`, `contact_person`, `contact_no`, `cement_type`, `aggregate_size`, `mix_type`, `admixture_1`, `admixture_2`, `design_slump`, `slump`, `noofcubes`, `temperature`, `dispatched_by`, `dispatch_time`, `prepared_by`) 
                                                            VALUES ('$delivery_no','$job_no','$today_date','$time_now','$trip_no','$delivered_qty','$vehicle_no','$driver','$contact_person','$contact_no','$cement_type','$aggregate_size','$mix_type','$admixture_1','$admixture_2','$design_slump','$slump','$noofcubes','$temperature','$dispatched_by','$dispatched_time','$logged_user_id')");

    mysqli_close($con);
    
    if($update_qty && $insert_delivery){
        ?>
        <script type="text/javascript">
            window.open("../Pages/delivery_note_print.php?jobno=<?php echo $job_no ?>&delivery_no=<?php echo $delivery_no ?>");
            window.location.replace("../Pages/production.php");
        </script>
        <?php
    }
}
?>
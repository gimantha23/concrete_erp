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
    
    <title>Delivery Note</title>

    <script type="text/javascript">
    function goBack() {
        window.history.back();
    }
    function check_quantity(){
        const req_qty = parseFloat(document.getElementById("txtReqQty").value);
        const cumulative_qty = parseFloat(document.getElementById("txtCumulativeQuantity").value);
        const entered_qty = parseFloat(document.getElementById("txtDeliverQuantity").value);
        const tot_qty = entered_qty+cumulative_qty;
        const deliverable_qty = req_qty - cumulative_qty;
        if(tot_qty > req_qty){
            document.getElementById("txtDeliverQuantity").value="";
            document.getElementById("txtDeliverQuantity").classList.add("is-invalid");
            document.getElementById("quantity_exceed_error").innerHTML="Maximum quantity is <b>"+deliverable_qty.toFixed(2)+"</b> m<sup>3</sup>";
        }else{
            document.getElementById("txtDeliverQuantity").classList.remove("is-invalid");
            document.getElementById("quantity_exceed_error").innerHTML="";
        }
    }
    </script>
</head>

<body>
<?php
    require('../Components/header.php');

    $job_no = $_GET['jobno'];

    date_default_timezone_set("Asia/Colombo");
    $today_date = date("Y.m.d");
    $con = mysqli_connect("localhost","root","","erp_dev_database");

    $select_max_delivery_no = mysqli_query($con, "SELECT MAX(delivery_no) FROM delivery WHERE job_no='$job_no'");
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

    $sel_order_details = mysqli_query($con, "SELECT * FROM concrete_order WHERE job_no='$job_no'");
    $res_order_details = mysqli_fetch_array($sel_order_details);

    $sel_cus_details = mysqli_query($con, "SELECT * FROM customers WHERE id='".$res_order_details['customer_id']."'");
    $res_cus_details = mysqli_fetch_array($sel_cus_details);
    ?>
    <div class="container">
        <form action="../PHPScripts/delivery_submit.php" method="post">
            <div class="row mb-3 mt-3">
                <div class="col-md-3">
                    <label for="txtDate">Date</label>
                    <input type="text" class="form-control" id="txtDate" value="<?php echo $today_date; ?>" readonly>
                    <input type="hidden" id="txtReqQty" name="txtReqQty" value="<?php echo $res_order_details['requested_quantity']; ?>" readonly>
                </div>
                <div class="col-md-3">
                    <label for="txtPoNo">PO No</label>
                    <input type="text" class="form-control" id="txtPoNo" name="txtPoNo" value="<?php echo $res_order_details['po_no']; ?>" readonly>
                </div>
                <div class="col-md-3">
                    <label for="txtDeliveryNo">Delivery Note No.</label>
                    <input type="text" class="form-control" id="txtDeliveryNo" value="<?php echo $delivery_no; ?>" readonly>
                    <input type="hidden" id="txtJobNo" name="txtJobNo" value="<?php echo $job_no; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="txtCustomerName">Customer Name</label>
                    <input type="text" class="form-control" id="txtCustomerName" name="txtCustomerName" value="<?php echo $res_cus_details['customer_name']; ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="txtSiteAddress">Site Address</label>
                    <textarea class="form-control" id="txtSiteAddress" name="txtSiteAddress" readonly><?php echo $res_cus_details['site_address']; ?></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="txtContactPerson">Contact Person at Site</label>
                    <input type="text" class="form-control" id="txtContactPerson" name="txtContactPerson">
                </div>
                <div class="col-md-3">
                    <label for="txtContactNo">Contact No</label>
                    <input type="text" class="form-control" id="txtContactNo" name="txtContactNo">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="txtVehicleNo">Vehicle No</label>
                    <input type="text" class="form-control" id="txtVehicleNo" name="txtVehicleNo">
                </div>
                <div class="col-md-3">
                    <label for="txtTripNo">Trip No</label>
                    <input type="text" class="form-control" id="txtTripNo" name="txtTripNo" value="<?php echo $trip_no; ?>" readonly>
                </div>
                <div class="col-md-3">
                    <label for="txtDriver">Driver</label>
                    <input type="text" class="form-control" id="txtDriver" name="txtDriver" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="txtGrade">Grade (N)</label>
                    <input type="number" step="0.1" min="0.1" class="form-control" id="txtGrade" name="txtGrade" value="<?php echo $res_order_details['grade']; ?>" readonly>
                </div>
                <div class="col-md-2">
                    <label for="txtCementType">Cement Type</label>
                    <input type="text" class="form-control" id="txtCementType" name="txtCementType">
                </div>
                <div class="col-md-2">
                    <label for="txtAggregateSize">Aggregate Size (Max)</label>
                    <input type="text" class="form-control" id="txtAggregateSize" name="txtAggregateSize">
                </div>
                <div class="col-md-2">
                    <label for="txtMixType">Type of Mix</label>
                    <input type="text" class="form-control" id="txtMixType" name="txtMixType">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="txtAdmixture1">Admixture Type I</label>
                    <input type="text" class="form-control" id="txtAdmixture1" name="txtAdmixture1">
                </div>
                <div class="col-md-2">
                    <label for="txtAdmixture2">Admixture Type II</label>
                    <input type="text" class="form-control" id="txtAdmixture2" name="txtAdmixture2">
                </div>
                <div class="col-md-2">
                    <label for="txtDeliverQuantity">Delivered Volume m<sup>3</sup></label>
                    <input type="number" min="0.01" step="0.01" class="form-control " id="txtDeliverQuantity" name="txtDeliverQuantity" onkeyup="check_quantity();" required>
                    <div id="quantity_exceed_error" class="invalid-feedback"></div>
                </div>
                <div class="col-md-2">
                    <label for="txtCumulativeQuantity">Cumulative Volume m<sup>3</sup></label>
                    <input type="text" class="form-control" id="txtCumulativeQuantity" name="txtCumulativeQuantity" value="<?php echo $res_order_details['total_delivered_qty']; ?>" readonly>
                </div>
            </div>

            <label for="txtAdmixture1"><u>At Plant</u></label>
            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="txtDesignSlump">Design Slump (mm)</label>
                    <input type="text" class="form-control" id="txtDesignSlump" name="txtDesignSlump">
                </div>
                <div class="col-md-2">
                    <label for="txtSlump">Slump (mm)</label>
                    <input type="text" class="form-control" id="txtSlump" name="txtSlump">
                </div>
                <div class="col-md-2">
                    <label for="txtNoOfCubes">No.of Cubes</label>
                    <input type="text" class="form-control" id="txtNoOfCubes" name="txtNoOfCubes">
                </div>
                <div class="col-md-2">
                    <label for="txtTemperature">Temperature</label>
                    <input type="text" class="form-control" id="txtTemperature" name="txtTemperature">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="txtDispatchedBy">Dispatched by (Name)</label>
                    <input type="text" class="form-control" id="txtDispatchedBy" name="txtDispatchedBy">
                </div>
                <div class="col-md-2">
                    <label for="txtDispatchedTime">Time</label>
                    <input type="time" class="form-control" id="txtDispatchedTime" name="txtDispatchedTime">
                </div>
            </div>

            <div class="row mb-5 offset-md-7">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary" name="btnSubmit">Save & Print</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>
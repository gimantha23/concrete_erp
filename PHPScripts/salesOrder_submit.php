<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header('location:../Pages/index.php');
}
if(isset($_POST['btnSubmit'])){

	include('db_connect.php');
        
    $logged_user_id = $_SESSION["user_id"];
    date_default_timezone_set("Asia/Colombo");
    $today_date = date("Y.m.d");
    $prepared_datetime = date("Y-m-d h:ia");

    $select_max_job_no = mysqli_query($con, "SELECT MAX(job_no) FROM concrete_order");
	$result_max_job_no = mysqli_fetch_array($select_max_job_no);
	if ($result_max_job_no[0] == '') {
		$job_no = '1001';
	} else {
		$job_no = $result_max_job_no[0]+1;
    }
    
    $customer_id = $_POST["customer_id"];
    if($customer_id==''){
        $customer_name = $_POST["txtCustomerName"];
        $customer_tele = $_POST["txtCustomerTele"];
        $site_address = $_POST["txtSiteAddress"];

        $insert_customer = mysqli_query($con, "INSERT INTO `customers`(`customer_name`, `company_name`, `telephone`, `site_address`, `email`, `added_date`) 
                            VALUES ('$customer_name','','$customer_tele','$site_address','','$today_date')");
        $customer_id = mysqli_insert_id($con);
    }

    $pay_receipt_no = $_POST["txtPayReceiptNo"];
    $payment_mode = $_POST["txtPayMode"];
    $payment_date = $_POST["txtPaymentDate"];

    $insert_payment = mysqli_query($con, "INSERT INTO `payments`(`job_no`, `pay_receipt_no`, `pay_mode`, `payment_date`) 
                    VALUES ('$job_no','$pay_receipt_no','$payment_mode','$payment_date')");
    $payment_id = mysqli_insert_id($con);

	$sales_code = $_POST["txtSalesCode"];
    $req_date = $_POST["txtReqDate"];
    $req_time = $_POST["txtReqTime"];
    $grade = $_POST["txtGrade"];
    $qty = $_POST["txtQty"];
    $pump_car = $_POST["txtPumpCar"];
    $trucks = $_POST["txtTrucks"];
    $slump = $_POST["txtSlump"];
    $slump_test = $_POST["txtSlumpTest"];
    $molds = $_POST["txtMolds"];
    $laying = $_POST["txtLaying"];
    $polythene = $_POST["txtPolythene"];
    $job_type = $_POST["txtJobType"];
    $concrete_rate = $_POST["txtRateConcrete"];
    $pumpcar_rate = $_POST["txtRatePumpCar"];
    $laying_rate = $_POST["txtRateLaying"];
    $po_no = $_POST["txtPO"];
    $receipt_no = $_POST["txtPayReceiptNo"];
    $pay_date = $_POST["txtPaymentDate"];

    $insert_data = mysqli_query($con, "INSERT INTO `concrete_order`(`job_no`, `date`, `sales_code`, `customer_id`, `required_date`, `required_time`, `grade`, `quantity`, `pump_car`, `trucks`, `slump`, `slump_test`, `c_molds`, `laying`, `polythene`, `job_type`, `concrete_rate`, `pumpcar_rate`, `laying_rate`, `po_no`, `payment_id`, `prepared_by`, `prepared_datetime`) 
                                        VALUES ('$job_no','$today_date','$sales_code','$customer_id','$req_date','$req_time','$grade','$qty','$pump_car','$trucks','$slump','$slump_test','$molds','$laying','$polythene','$job_type','$concrete_rate','$pumpcar_rate','$laying_rate','$po_no','$payment_id','$logged_user_id', '$prepared_datetime')");


	mysqli_close($con);
}
?>
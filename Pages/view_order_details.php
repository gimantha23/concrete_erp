<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header('location:./index.php');
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
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <title>View Order Details</title>

    <script type="text/javascript">
    function goBack() {
        window.history.back();
    }
    function getXmlHttpRequestObject() {
        if (window.XMLHttpRequest) {
            return new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            return new ActiveXObject("Microsoft.XMLHTTP");
        } else {}
    }
    function approve_order(jobno) {
        let action = confirm("Do you wish to approve Job No. " + jobno);
        if (action) {
            var req = getXmlHttpRequestObject();
            if (req) {
                req.onreadystatechange = function() {
                    if (req.readyState == 4) {
                        if (req.status == 200) {
                            if (req.responseText == "success") {
                                alert("Approved Job No. " + jobno);
                            } else {
                                alert("An error occured");
                            }
                            location.reload();
                        }
                    }
                }
                req.open("POST", "../PHPScripts/approve_order.php", true);
                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                req.send("jobno=" + jobno);
            }
        }
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

    $get_payment_details = mysqli_query($con, "SELECT * FROM payments WHERE id='".$res_order_details['payment_id']."'");
    $res_payment_details = mysqli_fetch_array($get_payment_details);

    $status="pending";
    $disabled="";
    if($res_order_details['approved']=="yes"){
        $status="approved";
        $disabled="disabled";
    }
    ?>
    <div class="container">
        <div>
            <div class="row mb-3 mt-3">
                <div class="col-md-3">
                    <label for="txtDate">Date</label>
                    <input type="text" class="form-control" id="txtDate"
                        value="<?php echo $res_order_details['date']; ?>" readonly>
                </div>
                <div class="col-md-3">
                    <label for="txtSalesCode">Sales Code</label>
                    <input type="text" class="form-control" id="txtSalesCode" name="txtSalesCode"
                        value="<?php echo $res_order_details['sales_code']; ?>" readonly>
                </div>
                <div class="col-md-3">
                    <label for="txtJobNo">Job No.</label>
                    <input type="text" class="form-control" id="txtJobNo" value="<?php echo $job_no; ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="txtCustomerName">Customer Name</label>
                    <input type="text" class="form-control" id="txtCustomerName" name="txtCustomerName"
                        value="<?php echo $res_customer_details['customer_name']; ?>" readonly>
                </div>
                <div class="col-md-3">
                    <label for="txtCustomerTele">Tele.</label>
                    <input type="text" class="form-control" id="txtCustomerTele" name="txtCustomerTele"
                        value="<?php echo $res_customer_details['telephone']; ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="txtSiteAddress">Site Address</label>
                    <textarea class="form-control" id="txtSiteAddress" name="txtSiteAddress"
                        readonly><?php echo $res_customer_details['site_address'] ?></textarea>
                </div>
            </div>
            <label><u>Concrete Requirement</u></label>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="txtReqDate">Date</label>
                    <input type="date" class="form-control" id="txtReqDate" name="txtReqDate"
                        value="<?php echo $res_order_details['required_date']; ?>" readonly>
                </div>
                <div class="col-md-3">
                    <label for="txtReqTime">Time</label>
                    <input type="time" class="form-control" id="txtReqTime" name="txtReqTime"
                        value="<?php echo $res_order_details['required_time']; ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="txtGrade">Grade (N)</label>
                    <input type="number" step="0.1" min="0.1" class="form-control" id="txtGrade" name="txtGrade"
                        value="<?php echo $res_order_details['grade']; ?>" readonly>
                </div>
                <div class="col-md-2">
                    <label for="txtQty">Quantity (m<sup>3</sup>)</label>
                    <input type="number" step="0.1" min="0.1" class="form-control" id="txtQty" name="txtQty"
                        value="<?php echo $res_order_details['requested_quantity']; ?>" readonly>
                </div>
                <div class="col-md-2">
                    <label for="txtPumpCar">Pump Car</label>
                    <input type="text" class="form-control" id="txtPumpCar" name="txtPumpCar"
                        value="<?php echo $res_order_details['pump_car']; ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="txtTrucks">Trucks</label>
                    <input type="text" class="form-control" id="txtTrucks" name="txtTrucks"
                        value="<?php echo $res_order_details['trucks']; ?>" readonly>
                </div>
                <div class="col-md-2">
                    <label for="txtSlump">Slump</label>
                    <input type="text" class="form-control" id="txtSlump" name="txtSlump"
                        value="<?php echo $res_order_details['slump']; ?>" readonly>
                </div>
                <div class="col-md-2">
                    <label for="txtSlumpTest">Slump Test</label>
                    <input type="text" class="form-control" id="txtSlumpTest" name="txtSlumpTest"
                        value="<?php echo $res_order_details['slump_test']; ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="txtMolds">C. Molds</label>
                    <input type="text" class="form-control" id="txtMolds" name="txtMolds"
                        value="<?php echo $res_order_details['c_molds']; ?>" readonly>
                </div>
                <div class="col-md-2">
                    <label for="txtLaying">Laying*</label>
                    <input type="text" class="form-control" id="txtLaying" name="txtLaying"
                        value="<?php echo $res_order_details['laying']; ?>" readonly>
                </div>
                <div class="col-md-2">
                    <label for="txtPolythene">Polythene*</label>
                    <input type="text" class="form-control" id="txtPolythene" name="txtPolythene"
                        value="<?php echo $res_order_details['polythene']; ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="txtJobType">Type of Job</label>
                    <input type="text" class="form-control" id="txtJobType" name="txtJobType"
                        value="<?php echo $res_order_details['job_type']; ?>" readonly>
                </div>
            </div>

            <label><u>Rates</u></label>
            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="txtRateConcrete">Concrete</label>
                    <input type="text" class="form-control" id="txtRateConcrete" name="txtRateConcrete"
                        value="<?php echo $res_order_details['concrete_rate']; ?>" readonly>
                </div>
                <div class="col-md-2">
                    <label for="txtRatePumpCar">Pump Car</label>
                    <input type="text" class="form-control" id="txtRatePumpCar" name="txtRatePumpCar"
                        value="<?php echo $res_order_details['pumpcar_rate']; ?>" readonly>
                </div>
                <div class="col-md-2">
                    <label for="txtRateLaying">Laying*</label>
                    <input type="text" class="form-control" id="txtRateLaying" name="txtRateLaying"
                        value="<?php echo $res_order_details['laying_rate']; ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="txtCustRegNo">Customer Registration No.</label>
                    <input type="text" class="form-control" id="txtCustRegNo"
                        value="<?php echo $res_customer_details['id']; ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="txtPO">PO/Request Letter.</label>
                    <input type="text" class="form-control" id="txtPO" name="txtPO"
                        value="<?php echo $res_order_details['po_no']; ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="txtPayReceiptNo">Payment Receipt No.</label>
                    <input type="text" class="form-control" id="txtPayReceiptNo" name="txtPayReceiptNo"
                        value="<?php echo $res_payment_details['pay_receipt_no']; ?>" readonly>
                </div>
                <div class="col-md-2">
                    <label for="txtPayMode">Pay Mode</label>
                    <input type="text" class="form-control" id="txtPayMode" name="txtPayMode"
                        value="<?php echo $res_payment_details['pay_mode']; ?>" readonly>
                </div>
                <div class="col-md-2">
                    <label for="txtPaymentDate">Date</label>
                    <input type="date" class="form-control" id="txtPaymentDate" name="txtPaymentDate"
                        value="<?php echo $res_payment_details['payment_date']; ?>" readonly>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-2 offset-md-4">
                    <button type="submit" class="btn btn-outline-danger" name="btnSubmit" <?php echo $disabled; ?>>Reject</button>
                    <button type="button" class="btn btn-success" name="btnSubmit"
                        onclick="approve_order('<?php echo $job_no; ?>');" <?php echo $disabled; ?>>
                        <?php if($status=="pending"){echo "Approve";}else{echo"Approved";} ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php
require('../Components/footer.php');
?>
</body>

</html>
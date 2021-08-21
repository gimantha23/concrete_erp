<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header('location:./index.php');
}
$user_type = $_SESSION["user_type"];
if($user_type=="account" || $user_type=="sales"){
    header('location:../ErrorBoundary/403.php');
    return;
}
include("../PHPScripts/db_connect.php");
$jobno = $_GET['jobno'];
$delivery_no = $_GET['delivery_no'];

$sel_order_info = mysqli_query($con, "SELECT * FROM concrete_order WHERE job_no='$jobno'");
$res_order_info = mysqli_fetch_array($sel_order_info);

$sel_delivery_info = mysqli_query($con, "SELECT * FROM delivery WHERE delivery_no='$delivery_no'");
$res_delivery_info = mysqli_fetch_array($sel_delivery_info);

$sel_customer_details = mysqli_query($con, "SELECT * FROM customers WHERE id='".$res_order_info['customer_id']."'");
$res_customer_details = mysqli_fetch_array($sel_customer_details);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Note</title>
    <style>
    .left-spacing{
        padding-left:8px;
    }
    .heading-styles{
        padding:0;
        margin: 3px 0px 5px 0px;
    }
    </style>
</head>
<body onload="window.print();">
    <table border=1 cellpadding=0 cellspacing=0 width=100% align=center>
        <tr height=140px>
            <td width=20%>PREMA LOGO</td>
            <td width=60% style="text-align:center;">
                <h2 class="heading-styles">PREMA READY MIX (PVT) LTD.</h2>
                <h4 class="heading-styles">765/32A, Habanhenawatte, Walgama, Athurugiriya.</h4>
                <h5 class="heading-styles">Tel: 011-2156211, Fax: 011-2054041, <br/>Email: premareadymix@gmail.com</h5><hr/>
                <h3>CONCRETE DELIVERY NOTE</h3>
            </td>
            <td width=20%>OTHER LOGOS</td>
        </tr>
    </table>

    <table border=1 cellpadding=0 cellspacing=0 width=100% align=center>
        <tr height=30px>
            <td width=20% class="left-spacing" style="border-right:0px;">Date: <?php echo $res_delivery_info['delivery_date']; ?></td>
            <td width=40% style="border-left:0px;text-align:center;">PO No: <?php echo $res_order_info['po_no']; ?></td>
            <td width=40% class="left-spacing">Delivery Note No: <?php echo $res_delivery_info['delivery_no']; ?></td>
        </tr>

        <tr height=30px>
            <td class="left-spacing">Customer</td>
            <td class="left-spacing"><?php echo $res_customer_details['customer_name']; ?></td>
            <td></td>
        </tr>

        <tr height=30px>
            <td class="left-spacing">Site/Location</td>
            <td class="left-spacing"><?php echo $res_customer_details['site_address']; ?></td>
            <td></td>
        </tr>

        <tr height=30px>
            <td class="left-spacing">Contact Person at Site</td>
            <td class="left-spacing"><?php echo $res_delivery_info['contact_person']; ?></td>
            <td class="left-spacing">Contact No: <?php echo $res_delivery_info['contact_no']; ?></td>
        </tr>

        <tr height=30px>
            <td class="left-spacing">Vehicle No:</td>
            <td class="left-spacing" style="text-align:left;padding-right:15px;"><?php echo $res_delivery_info['vehicle_no']; ?><span style="float:right;">Trip No: <?php echo $res_delivery_info['trip_no']; ?></span></td>
            <td class="left-spacing">Driver/Helper: <?php echo $res_delivery_info['driver']; ?></td>
        </tr>
    </table>

    <table border=1 cellpadding=0 cellspacing=0 width=100% align=center>
        <tr height=30px style="text-align:center">
            <td width=12.5%>Grade</td>
            <td width=12.5%>Cement Type</td>
            <td width=12.5%>Aggregate size (Max)</td>
            <td width=12.5%>Type of Mix</td>
            <td width=12.5%>Admixture Type I</td>
            <!-- <td width=12.5%>Admixture Type II</td> -->
            <td width=12.5%>Delivered Volume m<sup>3</sup></td>
            <td width=12.5%>Cumulative Volume m<sup>3</sup></td>
            <td width=12.5%>Requested Volume m<sup>3</sup></td>
        </tr>

        <tr height=30px style="text-align:center">
            <td width=12.5%><?php echo $res_order_info['grade']; ?></td>
            <td width=12.5%><?php echo $res_delivery_info['cement_type']; ?></td>
            <td width=12.5%><?php echo $res_delivery_info['aggregate_size']; ?></td>
            <td width=12.5%><?php echo $res_delivery_info['mix_type']; ?></td>
            <td width=12.5%><?php echo $res_delivery_info['admixture_1']; ?></td>
            <!-- <td width=12.5%><?php echo $res_delivery_info['admixture_2']; ?></td> -->
            <td width=12.5%><?php echo $res_delivery_info['quantity']; ?></td>
            <td width=12.5%><?php echo $res_order_info['total_delivered_qty']; ?></td>
            <td width=12.5%><?php echo $res_order_info['requested_quantity']; ?></td>
        </tr>

        <tr height=30px style="text-align:center">
            <td colspan=4 width=50%>At Plant</td>
            <td colspan=4 width=50%>At Site</td>
        </tr>

        <tr height=30px style="text-align:center">
            <td colspan=2>Design Slump (mm)</td>
            <td colspan=2>Slump (mm)</td>
            <td colspan=2>Slump (mm)</td>
            <td colspan=1>No of Cubes</td>
            <td colspan=1>Temperature</td>
        </tr>

        <tr height=30px style="text-align:center">
            <td colspan=2><?php echo $res_delivery_info['design_slump']; ?></td>
            <td colspan=2><?php echo $res_delivery_info['slump']; ?></td>
            <td colspan=2></td>
            <td colspan=1></td>
            <td colspan=1></td>
        </tr>

        <tr height=30px style="text-align:center">
            <td colspan=2>No of Cubes</td>
            <td colspan=2>Temperature</td>
            <td colspan=3>Truck Arrival Time</td>
            <td colspan=1>Received By (Name)</td>
        </tr>
        <tr height=30px style="text-align:center">
            <td colspan=2><?php echo $res_delivery_info['noofcubes']; ?></td>
            <td colspan=2><?php echo $res_delivery_info['temperature']; ?></td>
            <td colspan=3></td>
            <td colspan=1></td>
        </tr>

        <tr height=30px style="text-align:center">
            <td colspan=2>Dispatched By (Name)</td>
            <td colspan=2>Time</td>
            <td colspan=3>Concrete Pouring</td>
            <td colspan=1>Signature</td>
        </tr>

        <tr height=30px style="text-align:center">
            <td colspan=2></td>
            <td colspan=2></td>
            <td colspan=3>Start Time &emsp; | &emsp; Finish Time</td>
            <td colspan=1 style="border-bottom:0px;"></td>
        </tr>

        <tr height=30px style="text-align:left">
            <td colspan=2 class="left-spacing">Signature</td>
            <td colspan=2></td>
            <td colspan=3></td>
            <td colspan=1 style="border-top:0px;"></td>
        </tr>

        <tr height=90px style="text-align:left">
            <td colspan=4 class="left-spacing">Security Point</td>
            <td colspan=4 class="left-spacing">Remarks</td>
        </tr>
    </table>
</body>
</html>


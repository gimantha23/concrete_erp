<?php
    session_start();
    if(!isset($_SESSION["user_id"])){
        header('location:./index.php');
    }
    $user_type = $_SESSION["user_type"];
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/c829a83b30.js"></script>
    <link rel="stylesheet" href="../assets/css/dashboard.css">

    <title>Dashboard</title>
    <script type="text/javascript">
    function goBack() {
        window.history.back();
    }
    </script>
</head>

<body>
<?php
require('../Components/header.php');
?>
    <div class="container" style="height:65vh;">
        <div class="row mt-4">
        <?php 
        if($user_type=="sales" || $user_type=="manager" || $user_type=="admin"){
        ?>
            <div class="col-lg-3">
                <a class="card-link" href="./salesOrder.php">
                    <div class="card card-item">
                        <div class="card-body text-center">
                            <h5 class="card-icon"><i class="fa fa-file-text-o"
                                    aria-hidden="true"></i>
                            </h5>
                            <h5 class="card-title">Concrete Order</h5>
                        </div>
                    </div>
                </a>
            </div>
        <?php
        }
        ?>

        <?php 
        if($user_type=="sales" || $user_type=="admin"){
        ?>
            <div class="col-lg-3">
                <a class="card-link" href="./viewPastSalesOrders.php">
                    <div class="card card-item">
                        <div class="card-body text-center">
                            <h5 class="card-icon"><i class="fa fa-list" aria-hidden="true"></i>
                            </h5>
                            <h5 class="card-title">View Past Orders</h5>
                        </div>
                    </div>
                </a>
            </div>
        <?php
        }
        ?>

        <?php 
        if($user_type=="account" || $user_type=="manager" || $user_type=="admin"){
        ?>
            <div class="col-lg-3">
                <a class="card-link" href="./accountsDashboard.php">
                    <div class="card card-item">
                        <div class="card-body text-center">
                            <h5 class="card-icon"><i class="fa fa-book" aria-hidden="true"></i>
                            </h5>
                            <h5 class="card-title">Accounts</h5>
                        </div>
                    </div>
                </a>
            </div>
        <?php
        }
        ?>

        <?php 
        if($user_type=="production" || $user_type=="manager" || $user_type=="admin"){
        ?>
            <div class="col-lg-3">
                <a class="card-link" href="./production.php">
                    <div class="card card-item">
                        <div class="card-body text-center">
                            <h5 class="card-icon"><i class="fa fa-cogs" aria-hidden="true"></i>
                            </h5>
                            <h5 class="card-title">Production</h5>
                        </div>
                    </div>
                </a>
            </div>
        <?php
        }
        ?>

        <?php 
        if($user_type=="manager" || $user_type=="admin"){
        ?>
            <div class="col-lg-3">
                <a class="card-link" href="./manageUserDashboard.php">
                    <div class="card card-item">
                        <div class="card-body text-center">
                            <h5 class="card-icon"><i class="fa fa-user" aria-hidden="true"></i>
                            </h5>
                            <h5 class="card-title">User Management</h5>
                        </div>
                    </div>
                </a>
            </div>
        <?php
        }
        ?>
        </div>
    </div>

<?php
require('../Components/footer.php');
?>
</body>

</html>
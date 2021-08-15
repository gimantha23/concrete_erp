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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/c829a83b30.js"></script>
    <link rel="stylesheet" href="../assets/css/dashboard.css">

    <title>Dashboard</title>
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
                        <li class="nav-item active" title="Home">
                            <a class="nav-link" href="./dashboard.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item" title="Back">
                            <a class="nav-link" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
                        <li class="nav-item" title="User Profile">
                            <a class="nav-link" href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                        </li>
                        <li class="nav-item" title="Log out">
                            <a class="nav-link" href="../PHPScripts/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-3">
                <a class="card-link" href="./salesOrder.php">
                    <div class="card card-item">
                        <div class="card-body text-center">
                            <h5 class="card-icon"><i class="fa fa-file-text-o"
                                    aria-hidden="true"></i>
                            </h5>
                            <h5 class="card-title">Sales Order</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a class="card-link" href="./accounts.php">
                    <div class="card card-item">
                        <div class="card-body text-center">
                            <h5 class="card-icon"><i class="fa fa-book" aria-hidden="true"></i>
                            </h5>
                            <h5 class="card-title">Accounts</h5>
                        </div>
                    </div>
                </a>
            </div>
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
            <div class="col-lg-3">
                <a class="card-link" href="">
                    <div class="card card-item">
                        <div class="card-body text-center">
                            <h5 class="card-icon"><i class="fa fa-user" aria-hidden="true"></i>
                            </h5>
                            <h5 class="card-title">User Management</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

<?php
require('../Components/footer.php');
?>
</body>

</html>
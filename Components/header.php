<?php
$username = $_SESSION["user_name"];
?>

<style>
    .page-heading {
    margin: 30px 0px;
    }
</style>
<header>
    <div class="container">
        <div class="row text-center page-heading">
            <h1>Prema Ready Mix (Pvt) Ltd.</h1>
            <h3>Order Management System</h3>
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
                        <a class="nav-link" href="#" onclick="goBack();"><i class="fa fa-chevron-left"
                                aria-hidden="true"></i></a>
                    </li>
                </ul>
                <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
                    <li class="nav-item" title="Hi <?php echo $username; ?>">
                        <a class="nav-link" href="./userProfile.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                    </li>
                    <li class="nav-item" title="Log out">
                        <a class="nav-link" href="../PHPScripts/logout.php"><i class="fa fa-sign-out"
                                aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
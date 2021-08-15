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

    <title>User Management Dashboard</title>
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
            <div class="col-lg-3">
                <a class="card-link" href="./add_user.php">
                    <div class="card card-item">
                        <div class="card-body text-center">
                            <h5 class="card-icon"><i class="fa fa-user-plus" aria-hidden="true"></i>
                            </h5>
                            <h5 class="card-title">Add Users</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a class="card-link" href="./manage_user.php">
                    <div class="card card-item">
                        <div class="card-body text-center">
                            <h5 class="card-icon"><i class="fa fa-users" aria-hidden="true"></i>
                            </h5>
                            <h5 class="card-title">Manage Users</h5>
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
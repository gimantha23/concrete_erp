<?php
    session_start();
    if(isset($_SESSION["user_id"])){
        header('location:../Pages/dashboard.php');
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>Login</title>
</head>

<body class="text-center">
    <div class="container">
        <main class="form-signin">
            <form method="post" action="../PHPScripts/check_login.php">
                <h1 class="h3 mb-3 fw-normal">Sign in</h1>
                <div class="form-floating">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                        required>
                    <label for="username">Username</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required>
                    <label for="password">Password</label>
                </div>
                <?php
                    if(isset($_SESSION["error"])){
                        $error = $_SESSION["error"];
                        echo "<span class='login-error-text'>$error</span>";
                    }
                ?>
                <button class="w-100 btn btn-lg btn-primary" type="submit" name="btnSubmit">Sign in</button>
                <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
            </form>
        </main>
    </div>
</body>

</html>
<?php
if(isset($_POST['uname']) && isset($_POST['pass'])){
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $unamer = "sazimeh";
    $passr = "abir123";

    // Check if the username or password is incorrect
    if ($pass != $passr || $uname != $unamer) {
        $em = "Wrong Password Or Username";
    }

    // Check if the username and password fields are empty
    if (empty($uname) && empty($pass)) {
        $em = "Login First";
    }

    if($pass == $passr || $uname == $unamer){
        session_start();
        $_SESSION['uname'] = $unamer;
        $_SESSION['pass'] = $passr;
        header('Location: admin/admin.php');
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'constituents/favicon.php' ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/resstyle.css">
    <title>Admin Login</title>
</head>

<body>
    <div class="container">

        <!-- navbar starts  -->
        <?php include 'constituents/navbar.php' ?>
        <!-- navbar ends -->

        <!-- login section starts  -->
        <div class="login-container">
            <div class="login">
                <div class="login-title">
                    <h2>Admin Login</h2>
                </div>
                <div class="showAlert" style="padding: 10px; 0px">
                    <b style="color:red;"><?php
                        if(!empty($em)){echo $em;}
                     ?></b>
                </div>
                <div class="login-form">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <input name="uname" type="text" placeholder="Enter username" required>
                        <br>
                        <input name="pass" type="password" placeholder="Enter password" required>
                        <br>
                        <button type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- login section ends  -->

        <!-- copyright starts -->
        <?php include 'constituents/copyright.php'; ?>
        <!-- copyright ends  -->
    </div>
</body>

</html>
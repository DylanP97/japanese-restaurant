<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br>

            <!-- Login Form Starts Here -->
            <form action="" method="POST" class="text-center">
            Username:
            <br>
            <input type="text" name="username" placeholder="Enter Username">
            <br>
            <br>
            Password:
            <br>
            <input type="password" name="password" placeholder="Enter password">
            <br>
            <br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>
            <!-- Login Form Ends Here -->


            <p class="text-center">Created by - <a href="www.dylanp97.com">Dylanp97.com</a></p>
        </div>

    </body>
</html>


<?php

    // check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // process for login 
        // 1. get the data from login form
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn, $raw_password);

        // 2. SQL to check whetehr the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3. Execute the query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User available and login success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; // to check whether the user is logged in or not and logout will unset it

            //Redirect to home page dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //User not available and login failed
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //Redirect to home page dashboard
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>
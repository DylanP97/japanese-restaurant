
<?php include('config/constants.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Japanese Restaurant - DylanP97 - PHP & MySQL</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="../images/favicon.png">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <nav>
        <a href="<?php echo SITEURL; ?>" class="logo">
            <img src="images/logo-japanese.png" alt="Restaurant Logo" class="img-responsive">
        </a>

        <div class="menu">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>foods.php">Full Menu</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>admin/login.php">Admin</a>
                </li>
            </ul>
        </div>

    </nav>
    <!-- Navbar Section Ends Here -->
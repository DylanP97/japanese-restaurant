<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add']))  // checking if session is set
            {
                echo $_SESSION['add']; // displaying session message
                unset($_SESSION['add']); // removing session message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                    </td>
                    <!-- <td>Full Name</td> -->
                </tr>
                
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your username">
                    </td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php 
    if(isset($_POST['submit']))
    {
        // 1. get the date
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // password encrypted with md5

        // 2. SQL Query to save the date into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        // 3. Execute Query and Save Data in Database        
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check whether the Query is executed data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //data inserted
            // echo "data inserted";
            // create a session variable to display message 
            $_SESSION['add'] = "Admin Added Successfully";
            // Redirect Page to Manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //data inserted
            // echo "failed to insert data";
            // create a session variable to display message 
            $_SESSION['add'] = "Failed to Add Admin";
            // Redirect Page to Add admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>

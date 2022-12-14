<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
            //1. Get the ID of selected admin
            $id=$_GET['id'];

            //2. Create SQL Query to get the details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            // execute the query
            $res=mysqli_query($conn, $sql);

            // check whether the query is executed or not
            if($res==true)
            {
                // check whether the data is available or not
                $count = mysqli_num_rows($res);
                // check whether we have admin data or not
                if($count==1)
                {
                    // get the details
                    // echo "Admin available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    // redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }

        ?>

        <form action="" method="POST">
            <table class='update-table'>
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>" placeholder="Enter your name">
                    </td>
                    <!-- <td>Full Name</td> -->
                </tr>
                
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Your username">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
        </form>
    </div>
</div>

<?php

    // Check whether the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            echo "Button Clicked";
            //get all the values from form to update 
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];

            // create a sql query to update admin
            $sql = "UPDATE tbl_admin SET
            full_name = '$full_name',
            username = '$username'
            WHERE id='$id'
            ";

            // execute the query
            $res = mysqli_query($conn, $sql); 

            // check whether the query is executed successfully or not
            if($res==true)
            {
                // query executed and admin updated
                $_SESSION['update'] = "<div class='success'>Admin Updated Succesfully.</div>";
                // redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else
            {
                // failed to update admin
                $_SESSION['update'] = "<div class='error'>Failed to delete admin.</div>";
                // redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }


?>


<?php include('partials/footer.php'); ?>
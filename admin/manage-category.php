<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br/>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['unauthorized']))
            {
                echo $_SESSION['unauthorized'];
                unset($_SESSION['unauthorized']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }

        ?>

        <br><br>

        <!-- Button to Add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add category</a>

        <br/><br/><br/>

        <table class="tbl-full">
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>

            <?php
            
                // query to get all categories from database
                $sql = "SELECT * FROM tbl_category ORDER BY title ASC";
            
                // execute query
                $res = mysqli_query($conn, $sql);

                // count rows
                $count = mysqli_num_rows($res);

                // create serial number variable
                $sn=1;

                // check whether we have data in database or not 
                if($count>0)
                {
                    // we have data in database 
                    // get the data and display 
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        ?>

                            <tr>
                                <td><?php echo $title; ?></td>
                                <td>
                                    <?php
                                        // check whether image name is available or not
                                        if($image_name!="")
                                        {
                                            // display the image 
                                            ?>
                                            <img class="img-resize" src="<?php echo SITEURL; ?>images/category/<?php echo $image_name ?>" >
                                            <?php
                                        }
                                        else
                                        {
                                            // display the message
                                            echo "<div class='error'>Image not added.</div>";
                                        }
                                    ?>

                                </td>

                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                </td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Delete</a>
                                </td>
                            </tr>

                        <?php
                    }
                }
                else 
                {
                    // we do not have data
                    // we'll display the message inside table
                    ?>

                    <tr>
                        <td colspan="6"><div class="error">No Category Added.</div></td>
                    </tr>
                    
                    <?php
                }
            ?>

        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>
        <br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }        
        ?>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Food's title">
                    </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="50" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" step=".01" name="price" placeholder="Add a Price">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php
                                // Create PHP code to display categories from database
                                // 1. Create SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                // Execute query
                                $res = mysqli_query($conn, $sql);

                                // Count Rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                // if count is greater than zero, we have categories else we do not have categories
                                if($count>0)
                                {
                                    // we have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        // get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>
                                        <option value="<?php echo $id; ?>" ><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else 
                                {
                                    // we do not have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }

                                // 2. Display on dropdown
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
                <input type="hidden" name="qty_orders" value=0>
            </table>

        </form>

        <?php

            // check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                // 1. Get the data from form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $qty_orders = $_POST['qty_orders'];

                // Check whether radio button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else 
                {
                    $active = "No";
                }

                // 2. Upload the image if selected
                // check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    // get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    // check whether the image is selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        // image is selected
                        // a. rename the image
                        // get the extension of selected image (jpg, png, gif, etc.)
                        $ext = end(explode('.', $image_name));

                        // create new name for image
                        $image_name = "Food_Name_".rand(000, 999).".".$ext;
                        
                        $source_path = $_FILES['image']['tmp_name'];
                        
                        $destination_path = "../images/food/".$image_name;

                        // Finally upload the food image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // check whether image uploaded or not
                        if($upload==false)
                        {
                            // failed to ipload the image
                            // redirect to add food page with error message
                            $_SESSION['upload'] = "<div class='error>Failed to upload image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            // stop the process
                            die();
                        }
                    }
                    else
                    {
                        echo "Here 2";
                    }
                }
                else 
                {
                    $image_name = ""; // setting default value as blank
                }

                // 3. Insert into database

                // Create a SQL Query to save or add food
                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active',
                    qty_orders = '$qty_orders'
                ";

                // execute the query
                $res2 = mysqli_query($conn, $sql2);

                // check whether data inserted or not
                // 4. Redirect with message to manage food page
                if($res2 == true)
                {
                    // data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    // failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
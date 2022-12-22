
<?php include('partials-front/menu.php'); ?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="What are you looking for?" required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>

            <div class="center-content">

            <?php
                // Create SQL Query to Display Categories from Database
                $sql ="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 4";
                // Execute the Query
                $res = mysqli_query($conn, $sql);
                // Count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    // categories available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // get the values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                // Check whetehr image is available or not
                                    if($image_name=="")
                                    {
                                        // display message
                                        echo "<div class='error'>Image not available</div>";
                                    }
                                    else
                                    {
                                        // image available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="" class="img-curve img-responsive"/>
                                        <?php 
                                    }
                                
                                ?>

                                <h3 class="float-text text-white"><?php echo $title ?></h3>
                            </div>
                        </a>   

                        <?php
                    }
                }
                else
                {
                    // categories not available
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>

            </div>

        </div>
    </section>


    <section class="food-menu">
        <div class='container'>
            <h2 class="text-center">Our Best-Sellers</h2>

            <div class='center-food'>

            <?php
            
            // getting foods from database that are active and featured 
            // SQL query
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' ORDER BY qty_orders DESC LIMIT 6";

            // execute the query 
            $res2 = mysqli_query($conn, $sql2);

            // count rows
            $count2 = mysqli_num_rows($res2);

            // check whether food available or not
            if($count2>0)
            {
                // food available
                while($row=mysqli_fetch_assoc($res2))
                {
                    // get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>


                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                // check whether image available or not 
                                if($image_name=="")
                                {
                                    // image not available
                                    echo "<div class='error'>Image not available.</div>";
                                }
                                else
                                {
                                    // image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                            <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else 
            {
                // food not available
                echo "<div class='error'>Food not available.</div>";
            }

            ?>

            <a href="<?php echo SITEURL; ?>foods.php">Discover all our products</a>


            </div>

            

        </div>
    </section>

<?php include('partials-front/footer.php'); ?>

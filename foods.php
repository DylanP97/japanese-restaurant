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
    <!-- Food Search Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Full Menu</h2>

            <div class='center-food'>


            <?php
                // display foods that are active 
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // count rows 
                $count = mysqli_num_rows($res);

                // check whether the foods are available or not 
                if($count>0)
                {
                    // foods available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    // check whether image available or not
                                    if($image_name=="")
                                    {
                                        // image not available
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        // image available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name ;?>" alt="" class="img-responsive img-curve">
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

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id ?>" class="btn btn-primary" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>


                        <?php
                    }
                }
                else 
                {
                    // food not available
                    echo "<div class='error'>Food not found.</div>";
                }
            ?>

            </div>

        </div>

    </section>
    <!-- Food Menu Section Ends Here -->


    
    <?php include('partials-front/footer.php'); ?>
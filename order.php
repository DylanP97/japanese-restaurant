<?php include('partials-front/menu.php'); ?>

    <?php
        // check whether food id is set or not
        if(isset($_GET['food_id']))
        {
            // get the food id and details of the selected food
            $food_id = $_GET['food_id'];

            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                $qty_orders = $row['qty_orders'];
            }
            else
            {
                header('location:'.SITEURL);
            }
        }
        else
        {
            header('location:'.SITEURL);
        }
    ?>

    <section class="food-order">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="form-order">
                <div class="form-upper-part">
                    <div class="food-menu-img">
                        <?php
                        
                            // check whether the image is available or not 
                            if($image_name=="")
                            {
                                // image not available
                                echo "<div class='error'>Image not available.</div>";
                            }
                            else 
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name ; ?>" alt="" class="img-responsive img-curve">
                                <?php
                            }                        
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                        <input type="hidden" name="qty_orders" value=<?php echo $qty_orders; ?>>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>

                </div>
                
                <div class="form-lower-part">
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </div>

            </form>

            <?php
            
                if(isset($_POST['submit']))
                {
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $order_date = date("Y-m-d");
                    $status = "Ordered";
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];
                    $qty_orders = $_POST['qty_orders'];
                    $food_id = $_POST['food_id'];

                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    $sql6 = "UPDATE tbl_food SET
                        qty_orders = $qty_orders + 1
                    WHERE id=$food_id";

                    $res6 = mysqli_query($conn, $sql6);

                    if($res2==true)
                    {
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else 
                    {
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order.</div>";
                        header('location:'.SITEURL);
                    }
                }

            ?>

        </div>
    </section>

    <?php include('partials-front/footer.php'); ?>
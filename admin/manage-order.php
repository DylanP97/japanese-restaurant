<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br/><br/><br/>

        <?php        
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            
            if(isset($_SESSION['no-order-found']))
            {
                echo $_SESSION['no-order-found'];
                unset($_SESSION['no-order-found']);
            }
        ?>
        <br>

        <table class="tbl-full">
            <tr>
                <th>Order ID</th>
                <th>Food</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php 
                // get all the orders from database
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // display the latest ordered
                // execute
                $res = mysqli_query($conn, $sql);
                // count rows
                $count = mysqli_num_rows($res);

                $sn = 1;

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $food = $row['food'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_address = $row['customer_address'];

                        ?>

                        <tr>
                            <td>#JA10<?php echo $id; ?></td>
                            <td><?php echo $food; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td>$<?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>

                            <td>
                                <?php
                                    if($status=="Ordered")
                                    {
                                        echo "<label>$status</label>";
                                    }
                                    elseif($status=="On Delivery")
                                    {
                                        echo "<label style='color: orange;'>$status</label>";
                                    }
                                    elseif($status=="Delivered")
                                    {
                                        echo "<label style='color: green;'>$status</label>";
                                    }
                                    elseif($status=="Cancelled")
                                    {
                                        echo "<label style='color: red;'>$status</label>";
                                    }
                                ?>
                            </td>

                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_address; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    echo "<tr><td colspan='12' class='error'>Orders not available</td></tr>";
                }
            ?>

        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
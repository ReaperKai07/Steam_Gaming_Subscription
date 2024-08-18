<?php
require_once "controllers/PrintOrdersController.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Your existing styles here */
    </style>
    <title>A4 Paper</title>
</head>
<body>
    <div class="a4-paper" style="font-size:">
        <h1 style="padding-left: 30%; font-size: 50px;">
            <u>Invoice</u>
        </h1>
        <br>
        <div style="padding-left: 30%; font-size: 30px;">
            <?php
            // Check if order ID is set in $_POST
            if (isset($_POST['order_id'])) {
                $order_id = $_POST['order_id'];

                $PrintOrdersController = new PrintOrdersController();
                $order = $PrintOrdersController->getOrderById($order_id);

                if ($order != null) {
            ?>
            <h1 style="font-size: 30px;">
                <u>Order Details</u>
            </h1>
            <div class="detail">
                <span class="label">Order ID</span>:
                <?php echo $order['order_id']; ?>
            </div>
            <div class="detail">
                <span class="label">Product ID</span>:
                <?php echo $order['product_id']; ?>
            </div>
            <div class="detail">
                <span class="label">Total Price</span>:
                RM <?php echo $order['total_price']; ?>
            </div>
            <div class="detail">
                <span class="label">Date</span>:
                <?php echo $order['date']; ?>
            </div>
            <div class="detail">
                <span class="label">Email</span>:
                <?php echo $order['email']; ?>
            </div>

            <?php
                } else {
                    echo "<p>Order not found.</p>";
                }
            } else {
                echo "<p>Order ID not set.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>

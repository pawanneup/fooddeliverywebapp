<?php
session_start();
include('db.php');  

$order_confirmation_message = '';  

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    try {
        $pdo->beginTransaction();


        if (!isset($_SESSION['user_id'])) {
        
            throw new Exception("User not logged in.");
        }

        $customer_id = $_SESSION['user_id']; 
        $order_date = date('Y-m-d H:i:s');
                $stmt = $pdo->prepare("INSERT INTO orders (user_id, order_date, status) VALUES (?, ?, ?)");
        $stmt->execute([$customer_id, $order_date, 'pending']);


        $order_id = $pdo->lastInsertId();


        $order_items_details = "Items ordered:\n";

    
        foreach ($_SESSION['cart'] as $item) {

            if (isset($item['menu_item_id']) && isset($item['food_price'])) {

                $stmt = $pdo->prepare("INSERT INTO order_items (order_id, menu_item_id, quantity, price) VALUES (?, ?, ?, ?)");
                $stmt->execute([$order_id, $item['menu_item_id'], $item['quantity'], $item['food_price']]);


                $order_items_details .= "{$item['food_name']} x {$item['quantity']} - {$item['food_price']} each\n";
            } else {

                error_log("Error: Missing 'menu_item_id' or 'food_price' in cart item: " . json_encode($item));


                throw new Exception("Missing menu_item_id or food_price for some cart items.");
            }
        }


        $pdo->commit();


        unset($_SESSION['cart']);


        $order_confirmation_message = "Your order has been placed successfully! Order ID: $order_id. We will notify you once your order is processed.";


        // $restaurant_email = "restaurant@example.com";
        // $subject = "New Order Received - Order ID: $order_id";
        // $message = "New order placed!\nOrder ID: $order_id\nCustomer ID: $customer_id\nOrder Date: $order_date\n\n" . $order_items_details;
        // mail($restaurant_email, $subject, $message);


    } catch (Exception $e) {

        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>


<?php if (!empty($order_confirmation_message)) : ?>
    <div class="order-confirmation">
        <p><?php echo $order_confirmation_message; ?></p>
    </div>
   
<?php endif;
 header('Location: userorders.php');
 exit;
?>

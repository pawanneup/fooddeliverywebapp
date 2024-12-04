<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: homepage.php");
    exit();
}



?>
<?php
include('db.php');

// Query to join orders, order_items, and users tables
$sql = "
SELECT o.order_id, o.order_date, o.status, 
       oi.order_item_id, oi.menu_item_id, oi.quantity, oi.price, 
       u.username, u.phone, m.food_name
FROM orders o
JOIN order_items oi ON o.order_id = oi.order_id
JOIN `user` u ON o.user_id = u.id
JOIN menu m ON oi.menu_item_id = m.menu_item_id
WHERE o.status = 'pending'
ORDER BY o.order_date DESC
";

try {
    // Prepare and execute the query
    $stmt = $pdo->query($sql);
    
    // Fetch all results
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle query error
    echo "Error: " . $e->getMessage();
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>check_orders</title>
</head>
<style>
        table { width: 80%; margin: 20px auto; border-collapse: collapse; }
        table, th, td { border: 1px solid #ddd; padding: 15px; text-align: left; }
        th { background-color: #3f51b5; color: white; }
        .button { padding: 5px 10px; cursor: pointer; }
    </style>
<body >
   <nav class="bg-gray-700">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="shrink-0 mr-5"> 
             <a href="restaurant_dashboard.php" class="text-white font-bold text-3xl ml-3">KHAJA DEALS</a>
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <a href="restaurant_dashboard.php" class="rounded-md  px-3 py-2 text-sm font-medium text-white hover:bg-black hover:text-white" aria-current="page">Home</a>
              <a href="add_cuisine.php" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-black hover:text-white">Add Cuisine</a>
              <a href="check_orders.php" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-black hover:text-white">Orders</a>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">         
            <div class="m-2 ">
          <a href="logout.php" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-black hover:text-white">LOGOUT</a>
        </div>  
            </div>
          </div>
        </div>  
  </nav>
  <h2 class="text-5xl font-bold mt-3 mb-4" style="text-align:center;">Customer Orders</h2>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Status</th>

                <th>Quantity</th>
                <th>Price</th>
                <th>Customer Name</th>
                <th>Phone</th>
                <th>Food Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($orders) > 0): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['order_date']; ?></td>
                        <td><?php echo $order['status']; ?></td>
       
                        <td><?php echo $order['quantity']; ?></td>
                        <td><?php echo $order['price']; ?></td>
                        <td><?php echo $order['username']; ?></td>
                        <td><?php echo $order['phone']; ?></td>
                        <td><?php echo $order['food_name']; ?></td>
      
                        <td>
                            <!-- Example buttons for edit, copy, or delete -->
                            <a href="edit_order.php?id=<?php echo $order['order_id']; ?>">Edit</a> |
                            <a href="copy_order.php?id=<?php echo $order['order_id']; ?>">Copy</a> |
                            <a href="delete_order.php?id=<?php echo $order['order_id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10" style="text-align:center;">No pending orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
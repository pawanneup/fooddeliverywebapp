<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: homepage.php");
    exit();
}
if (!isset($_SESSION['show_slide_over'])) {
    $_SESSION['show_slide_over'] = false;
}
if (isset($_POST['toggle'])) {
    $_SESSION['show_slide_over'] = !$_SESSION['show_slide_over'];
}
if(isset($_POST['action']) && $_POST['action'] == 'remove'){
    $item_id = $_POST['item_id'];
    

    foreach ($_SESSION['cart'] as $key => $cart_item) {
        if ($cart_item['id'] == $item_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

}

$showSlideOver = $_SESSION['show_slide_over'];
?>
<?php
include('db.php'); 


$query = "SELECT * FROM menu WHERE food_availability = 'available'"; 
$stmt = $pdo->prepare($query);
$stmt->execute();
$subtotal = 0;

$foodItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    <script>
        function toggleSlideOver() {
            const slideOver = document.getElementById('slide-over');
            slideOver.classList.toggle('hidden');
        }
    </script>
    <title>Menu</title>
</head>
<body >
<nav class="bg-gray-700">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="shrink-0 mr-5">

             <a href="customer_dashboard.php" class="text-white font-bold text-3xl ml-3">KHAJA DEALS</a>
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
        
              <a href="customer_dashboard.php" class="rounded-md hover:bg-black hover:text-white px-3 py-2 text-sm font-medium text-white" aria-current="page">Home</a>
              <a href="menu.php" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-black hover:text-white">Menu</a>
              <a href="userorders.php" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-black hover:text-white">Orders</a>
       
            </div>
          </div>
        </div>
        <div class="hidden md:block">
        </div><button onclick="toggleSlideOver()" class="text-white hover:bg-black hover:text-white px-4 py-2 rounded">Check Cart</button>
          <div class="ml-4 flex items-center md:ml-6">
            
            <div class="m-2 ">
          <a href="logout.php" class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-black hover:text-white">LOGOUT</a>
        </div>

           
             
           
            </div>
          </div>
        </div>
       
          
</nav>
<body>
    
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-center mb-6">Restaurant Menu</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php foreach ($foodItems as $item): ?>
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="<?= htmlspecialchars($item['food_image']); ?>" alt="<?= htmlspecialchars($item['food_name']); ?>" class="w-full h-48 object-cover">
                 

                    <div class="p-4">
                        <h3 class="text-lg font-semibold"><?= htmlspecialchars($item['food_name']); ?></h3>
                        <p class="text-sm text-gray-500"><?= htmlspecialchars($item['food_description']); ?></p>
                        <p class="text-xl font-bold text-gray-900">RS:<?= number_format($item['food_price'], 2); ?></p>
                        <div class="mt-2">
                            <p class="text-sm text-gray-600">Size: <?= htmlspecialchars($item['food_size']); ?></p>
                            <p class="text-sm text-gray-600">Category: <?= htmlspecialchars($item['food_category']); ?></p>
                        </div>
                        <div class="mt-4 flex justify-between">
                           
                    <form method="POST" action="add_to_cart.php">
                        
                        <input type="hidden" name="food_name" value="<?= htmlspecialchars($item['food_name']); ?>">
                        <input type="hidden" name="food_price" value="<?= $item['food_price']; ?>">
                        <input type="hidden" name="food_image" value="<?= htmlspecialchars($item['food_image']); ?>">
                        <input type="hidden" name="menu_item_id" value="<?= $item['menu_item_id'] ?>">
                        <button  type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md" >Add to Cart</button>
                    </form>
                            <span class="text-gray-500"><?= htmlspecialchars($item['food_availability']); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</html>

    
<div id="slide-over" class="relative z-10 hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div class="pointer-events-auto w-screen max-w-md">
                    <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                        <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                            <div class="flex items-start justify-between">
                                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Shopping Cart</h2>
                                
                                <div class="ml-3 flex h-7 items-center">
                                    
                                    <button type="button" onclick="toggleSlideOver()" class="relative -m-2 p-2 text-gray-400 hover:text-gray-500">
                                        <span class="absolute -inset-0.5"></span>
                                        <span class="sr-only">Close panel</span>
                                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
          
                            <div class="mt-8">
                                <div class="flow-root">
                                    <ul role="list" class="-my-6 divide-y divide-gray-200">
                                        <?php
              
                                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
                                            $subtotal = 0; 
                                            foreach ($_SESSION['cart'] as $cart_item):
                                                $item_total = $cart_item['food_price'] * $cart_item['quantity'];
                                                $subtotal += $item_total;
                                        ?>
                                            <li class="flex py-6">
                                                <div class="size-24 shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                    <img src="<?= htmlspecialchars($cart_item['food_image']); ?>" alt="<?= htmlspecialchars($cart_item['food_name']); ?>" class="size-full object-cover">
                                                </div>
                                                <div class="ml-4 flex flex-1 flex-col">
                                                    <div>
                                                        <div class="flex justify-between text-base font-medium text-gray-900">
                                                            <h3><a href="#"><?= htmlspecialchars($cart_item['food_name']); ?></a></h3>
                                                            <p class="ml-4">RS: <?= number_format($cart_item['food_price'], 2); ?></p>
                                                        </div>
                                                        
                                                       
                                                    </div>
                                                    <div class="flex flex-1 items-end justify-between text-sm">
                                                        <p class="text-gray-500">Qty <?= $cart_item['quantity']; ?></p>
                                                        <div class="flex">
                                                            <!-- <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button> -->
                                                            <form method="POST" action="remove_from_cart.php">
                                                                <input type="hidden" name="food_name" value="<?= $cart_item['food_name']; ?>">
                                                                <input type="hidden" name="action" value="remove">
                                                                <button type="submit" class="font-medium text-red-600 hover:text-red-500">Remove</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                            <li class="flex py-6 text-gray-500">
                                                <p>Your cart is empty.</p>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <h3 class="p-5">Note: Logging out will delete all the cart items</h3>

                        <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <p>Subtotal</p>
                                <p>RS: <?= number_format($subtotal, 2); ?></p>
                            </div>
                            <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                            <!-- <div class="mt-6">
                                <a href="checkout.php" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</a>
                            </div> -->
                            <form action="checkout.php" method="POST">
                            <button  class="bg-blue-500 hover:bg-blue-700 m-2 text-white font-bold py-2 px-4 rounded" type="submit">Checkout</button>
                                        </form>
                                          <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                <p>or <button onclick="toggleSlideOver()" class="bg-blue-500 p-2 hover:bg-blue-700 m-2 text-white font-bold py-2 px-4 rounded text-indigo-600 hover:text-indigo-500">Continue Shopping</button></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  <script src="https://cdn.tailwindcss.com"></script> 
</body>
</html>
<?php


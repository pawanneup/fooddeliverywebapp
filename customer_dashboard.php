<?php
session_start(); 
require_once 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: homepage.php");
    exit();
}
?>
<?php

if (!isset($_SESSION['show_slide_over'])) {
    $_SESSION['show_slide_over'] = false;
}
if (isset($_POST['toggle'])) {
    $_SESSION['show_slide_over'] = !$_SESSION['show_slide_over'];
}
$showSlideOver = $_SESSION['show_slide_over'];
$subtotal = 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function toggleSlideOver() {
            const slideOver = document.getElementById('slide-over');
            slideOver.classList.toggle('hidden');
        }
    </script>
    <title>customer_dashboard</title>
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

<div id="carouselExampleCaptions" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://fun-18592.kxcdn.com/media/images/header-banner-ethical-food-choices.webp" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Order Your Favourite Food Here</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://dennisfoodservice.com/wp-content/uploads/2020/03/labor-savers-fire-braised-header-1280.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Food on your Door</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://fun-18592.kxcdn.com/media/images/header-banner-ethical-food-choices.webp" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Delivery within 30 Minutes</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    <div class="container">


<div>

</div>
<div>
    <h2 class="font-bold text-3xl mt-4 mb-2">Explore our customers favourite cuisines!</h2>
    <p>Whether you’re in the mood for pizza, burgers, sushi, or a healthy salad, we have it all! With a wide variety of restaurants and cuisines, you’ll never run out of options.Enjoy exclusive discounts, promotions, and deals from your favorite restaurants. Save while you indulge!</p>

</div>
<div class="bg-white">
  <div>


    <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
      <a href="menu.php" class="group">
        <img src="https://img.freepik.com/premium-photo/hamburger-white-background-with-8k-4k-photo-quality_641503-83330.jpg" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-[7/8]">
        <h3 class="mt-4 text-sm text-gray-700">BURGER</h3>
 
      </a>
      <a href="menu.php" class="group">
        <img src="https://masterpiecer-images.s3.yandex.net/8c519e62749811ee90ebaaafe6635749:upscaled" alt="Olive drab green insulated bottle with flared screw lid and flat top." class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-[7/8]">
        <h3 class="mt-4 text-sm text-gray-700">SAMOSA</h3> 

      </a>
      <a href="menu.php" class="group">
        <img src="https://img.freepik.com/premium-photo/food-isolated-white-background-stock-images-4k-8k-food-photography-background-hdr_569725-40069.jpg" alt="Person using a pen to cross a task off a productivity paper card." class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-[7/8]">
        <h3 class="mt-4 text-sm text-gray-700">COMBO</h3>
 
      </a>
      <a href="menu.php" class="group">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRRh_H4_OHnpJ6d5ia1v9mqBhKqXxjAgougtA&s" alt="Hand holding black machined steel mechanical pencil with brass tip and top." class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-[7/8]">
        <h3 class="mt-4 text-sm text-gray-700">Crunchy CHICKEN</h3>
     
      </a>
      <a href="menu.php" class="group">
        <img src="https://png.pngtree.com/thumb_back/fw800/background/20240929/pngtree-cannelloni-on-a-plate-with-meat-and-tomato-saucetandoori-chicken-hd-image_16281032.jpg" alt="Tall slender porcelain bottle with natural clay textured body and cork stopper." class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-[7/8]">
        <h3 class="mt-4 text-sm text-gray-700">INDIAN</h3>

      </a>
      <a href="menu.php" class="group">
        <img src="https://media.istockphoto.com/id/1036967058/photo/thanksgiving-table-with-turkey-and-sides.jpg?s=612x612&w=0&k=20&c=X0BuHbuAItMmORLjEeMuK_xprD8dnIM3KpENIMKG1fk=" alt="Olive drab green insulated bottle with flared screw lid and flat top." class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-[7/8]">
        <h3 class="mt-4 text-sm text-gray-700">CHOWMIN</h3>
     
      </a>
      <a href="menu.php" class="group">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdKC8aNEMMpftkLirixE64FmBCeV5u2rJH-w&s" alt="Person using a pen to cross a task off a productivity paper card." class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-[7/8]">
        <h3 class="mt-4 text-sm text-gray-700">Focus Paper Refill</h3>
  
      </a>
      <a href="menu.php" class="group">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsckI7n9B4QUHwtGJlKzEzNKkwmYyaQEIDpA&s" alt="Hand holding black machined steel mechanical pencil with brass tip and top." class="aspect-square w-full rounded-lg bg-gray-200 object-cover group-hover:opacity-75 xl:aspect-[7/8]">
        <h3 class="mt-4 text-sm text-gray-700">PASTA</h3>

      </a>

      More products...
    </div>
  </div>
</div>
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
                                      <button class="bg-blue-500 hover:bg-blue-700 m-2 text-white font-bold py-2 px-4 rounded" type="submit">Checkout</button>
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
<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: homepage.php");
    exit();
}

?>
<?php




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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Restaurant_Dashboard</title>
</head>
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
                           
                    <form method="POST" action="">
                        
                        <input type="hidden" name="food_name" value="<?= htmlspecialchars($item['food_name']); ?>">
                        <input type="hidden" name="food_price" value="<?= $item['food_price']; ?>">
                        <input type="hidden" name="food_image" value="<?= htmlspecialchars($item['food_image']); ?>">
                        <button  type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md" >Edit</button>
                    </form>
                            <span class="text-gray-500"><?= htmlspecialchars($item['food_availability']); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once('db.php');
    if (!isset($_SESSION['user_id'])) {
    header("Location: homepage.php");
    exit();
}

    $food_name = $_POST['food_name'];
    $food_description = $_POST['food_description'];
    $food_category = $_POST['food_category'];
    $food_price = $_POST['food_price'];
    $food_ingredients = $_POST['food_ingredients'];
    $food_availability = $_POST['food_availability'];
    $food_size = $_POST['food_size'];
    $food_tags = $_POST['food_tags'];


    $food_image = $_FILES['food_image']['name'];
    $food_image_tmp = $_FILES['food_image']['tmp_name'];
    $image_directory = 'uploads/' . $food_image;
    move_uploaded_file($food_image_tmp, $image_directory);

    $query = "INSERT INTO menu (food_name, food_description, food_category, food_price, food_ingredients, food_image, food_availability, food_size, food_tags) 
              VALUES (:food_name, :food_description, :food_category, :food_price, :food_ingredients, :food_image, :food_availability, :food_size, :food_tags)";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':food_name', $food_name);
    $stmt->bindParam(':food_description', $food_description);
    $stmt->bindParam(':food_category', $food_category);
    $stmt->bindParam(':food_price', $food_price);
    $stmt->bindParam(':food_ingredients', $food_ingredients);
    $stmt->bindParam(':food_image', $image_directory);
    $stmt->bindParam(':food_availability', $food_availability);
    $stmt->bindParam(':food_size', $food_size);
    $stmt->bindParam(':food_tags', $food_tags);
    
    if ($stmt->execute()) {
        echo "Food item added successfully!";
    } else {
        echo "Error adding food item.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    
    <title>Add Food Item</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .container {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], input[type="file"], select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: gray ;
        }
    </style>
</head>
<body>
<nav class="bg-gray-700">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="shrink-0 mr-5"> 
             <a href="restaurant_dashboard.php" class="text-white font-bold text-3xl ml-3">KHAJA DEALS</a>
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <a href="restaurant_dashboard.php" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-black hover:text-white" aria-current="page">Home</a>
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
<div class="container">
    <h2>Add New Food Item</h2>

    <form action="add_cuisine.php" method="POST" enctype="multipart/form-data">
        

        <div class="form-group">
            <label for="food_name">Food Name</label>
            <input type="text" id="food_name" name="food_name" required>
        </div>


        <div class="form-group">
            <label for="food_description">Food Description</label>
            <textarea id="food_description" name="food_description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="food_category">Category</label>
            <select id="food_category" name="food_category" required>
                <option value="appetizer">Appetizer</option>
                <option value="main_course">Main Course</option>
                <option value="dessert">Dessert</option>
                <option value="beverages">Beverages</option>
            </select>
        </div>


        <div class="form-group">
            <label for="food_price">Price</label>
            <input type="number" id="food_price" name="food_price" min="0" step="0.01" required>
        </div>


        <div class="form-group">
            <label for="food_ingredients">Ingredients</label>
            <textarea id="food_ingredients" name="food_ingredients" rows="4" placeholder="List of ingredients (Optional)"></textarea>
        </div>

        <div class="form-group">
            <label for="food_image">Upload Food Image</label>
            <input type="file" id="food_image" name="food_image" accept="image/*" >
        </div>


        <div class="form-group">
            <label for="food_availability">Food Availability</label>
            <select id="food_availability" name="food_availability" required>
                <option value="available">Available</option>
                <option value="unavailable">Unavailable</option>
            </select>
        </div>

      
        <div class="form-group">
            <label for="food_size">Size</label>
            <select id="food_size" name="food_size">
                <option value="small">Small</option>
                <option value="medium">Medium</option>
                <option value="large">Large</option>
            </select>
        </div>


        <div class="form-group">
            <label for="food_tags">Tags (optional, comma-separated)</label>
            <input type="text" id="food_tags" name="food_tags" placeholder="e.g., vegan, spicy">
        </div>

        <div class="form-group">
            <input type="submit" value="Add Food Item">
        </div>

    </form>
</div>
<script src="https://cdn.tailwindcss.com"></script>
</body>
</html>

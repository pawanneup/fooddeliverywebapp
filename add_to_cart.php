<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: homepage.php");
    exit();
}


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $food_name = isset($_POST['food_name']) ? $_POST['food_name'] : null;
    $food_price = isset($_POST['food_price']) ? $_POST['food_price'] : null;
    $food_image = isset($_POST['food_image']) ? $_POST['food_image'] : null;
    $menu_item_id = isset($_POST['menu_item_id']) ? $_POST['menu_item_id'] : null;


    if ($food_name && is_numeric($food_price) && $food_image) {

        $cart_id = uniqid('', true);


        $new_item = [
            'cart_id' => $cart_id,
            'food_name' => $food_name,
            'food_price' => $food_price,
            'food_image' => $food_image,
            'menu_item_id' => $menu_item_id,
            'quantity' => 1, 
        ];


        $item_found = false;
        foreach ($_SESSION['cart'] as &$cart_item) {
            if ($cart_item['food_name'] === $food_name) {

                $cart_item['quantity'] += 1;
                // $cart_item['cart_id'] = $cart_id;

                $item_found = true;
                break;
            }
        }


        if (!$item_found) {
            $_SESSION['cart'][] = $new_item;
        }
    } else {

        echo "Error: Invalid food details.";
        exit;
    }
}

header('Location: menu.php');
exit();
?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: homepage.php");
    exit();
}


if (isset($_POST['action']) && $_POST['action'] == 'remove') {

    $food_name = $_POST['food_name'];


    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

        foreach ($_SESSION['cart'] as $key => $cart_item) {
  
            if ($cart_item['food_name'] == $food_name) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }


        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }


    header('Location: menu.php');
    exit();
} else {

    header('Location: menu.php');
    exit();
}
?>

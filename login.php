<?php 
session_start();
require_once 'db.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pdo = new PDO("mysql:host=localhost;dbname=food_delivery_web", 'root', '');
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        if ($user['role'] == 'restaurant') {
            header('Location: restaurant_dashboard.php');
        } else {
            header('Location: customer_dashboard.php');
        }
        exit;
    } else {
        $_SESSION['error_message'] = "Invalid credentials.";
        header("Location: login.php"); 
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<form action="login.php" method="POST" class="container mt-5">
  <h1 class="fw-bolder text-center">Login Here</h1>
  <div class="mb-3 mt-5">
    <label for="email" class="form-label fs-5 fw-bold">Email address</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label fs-5 fw-bold">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
  </div>
  <?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger mt-3">
        <?php echo $_SESSION['error_message']; ?>
        <?php unset($_SESSION['error_message']); ?>
    </div>
  <?php endif; ?>
  <p class="text-center m-2">
    Not a member? <a href="registration.php">Register here</a>
  </p>
</form>
</body>
</html>

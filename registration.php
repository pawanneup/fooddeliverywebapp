<?php
session_start();
require_once 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];  
    $role = $_POST['role'];
    $phone = $_POST['phone']; 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       
        $_SESSION['error_message'] = "Invalid email format.";
        header("location: registration.php");
        exit;
    }
    if ($password !== $confirmPassword) {
     
        $_SESSION['error_message'] = "Passwords do not match.";
        header("location: registration.php");
        exit;
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($existingUser) {
      $_SESSION['error_message'] = "Email already in use.";
      header("location: registration.php");
        exit;
    }
    $stmt = $pdo->prepare("INSERT INTO user (username, email, password, role, phone) VALUES (:username, :email, :password, :role, :phone)");
    $stmt->execute([
        'username' => $username,
        'email' => $email,
        'password' => $hashedPassword,
        'role' => $role,
        'phone' => $phone  
  ]);
    $_SESSION['success_message'] = "Registration successful!";
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="fw-bolder text-center">User Registration</h1>
        <form action="registration.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label fs-5 fw-bold">Full Name</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label fs-5 fw-bold">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fs-5 fw-bold">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fs-5 fw-bold">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label fs-5 fw-bold">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label fs-5 fw-bold">Select Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="customer">Customer</option>
                    <option value="restaurant">Restaurant</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger mt-3">
                    <?php echo $_SESSION['error_message']; ?>
                    <?php unset($_SESSION['error_message']); ?>
                </div>
            <?php endif; ?>
          
            <p class="text-center m-2">
                Already have an account? 
                <a href="login.php" class="">Login here</a>
            </p>
        </form>
    </div>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

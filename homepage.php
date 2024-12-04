<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      
        body, html {
            height: 100%;
            margin: 0;
        }

        .bg-image {
            background-image: url('https://www.shutterstock.com/image-vector/online-food-delivery-service-vector-260nw-1645755775.jpg'); /* Replace with your desired image URL */
            background-size: cover;
            background-position: center;
            position: absolute;
            width: 100%;
            height: 100%;
            filter: blur(1px);
            opacity: 0.8;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color:black;
            font-weight: bolder;
            font-family: Arial, sans-serif;
            font-size: large;
        }

        .container h1{
            margin-left: 100px;
            color: black;
            font-size: 45px;
            font-weight: bolder;
        }
        .btn-custom {
            padding: 10px 40px;
            font-size: 18px;
            margin: 15px;
        }

        .btn-signin {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: bold;
        }

        .btn-signup {
            background-color: #28a745;
            border-color: #28a745;
            font-weight: bold;
        }
    </style>
</head>
<body>


    <div class="bg-image"></div>


    <div class="container">
        <h1>Welcome to Our Website</h1>
        <p>Sign in or sign up to get started.</p>
        <a href="login.php" class="btn btn-signin btn-custom">Sign In</a>
        <a href="registration.php" class="btn btn-signup btn-custom">Sign Up</a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

</body>
</html>
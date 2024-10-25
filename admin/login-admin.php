<?php
session_start();

// Database connection and credentials (replace with your actual database details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wanderlust";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $username = $_POST['username'];
   $password = $_POST['password'];

   // SQL query to check if the username and password match
   $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
   $result = $conn->query($sql);

   if ($result->num_rows == 1) {
      // Successful login
      $_SESSION['username'] = $username; // Store username in session
      header("Location: index-admin.php"); // Redirect to dashboard or any other page
   } else {
      // Invalid login
      $_SESSION['login_error'] = "Invalid username or password";
      header("Location: login-user.php"); // Redirect back to login page
   }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <title>Login Form Responsive</title>
    
    <style>
        /*===== GOOGLE FONTS =====*/
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap");

        /*===== VARIABLES CSS =====*/
        :root {
            --first-color: #ffd633;
            --text-color: #8590AD;
            --body-font: 'Roboto', sans-serif;
            --big-font-size: 2rem;
            --normal-font-size: 0.938rem;
            --smaller-font-size: 0.875rem;
        }

        @media screen and (min-width: 768px) {
            :root {
                --big-font-size: 2.5rem;
                --normal-font-size: 1rem;
            }  
        }

        /*===== BASE =====*/
        *, ::before, ::after {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: var(--body-font);
            color: var(--first-color);
        }
        h1 {
            margin: 0;
        }
        a {
            text-decoration: none;
        }
        img {
            max-width: 100%;
            height: auto;
        }

        /*===== FORM =====*/
        .l-form {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }

        /*=== Shapes ===*/
        .shape1,
        .shape2 {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }
        .shape1 {
            top: -7rem;
            left: -3.5rem;
            background: linear-gradient(180deg, var(--first-color) 0%, rgba(196, 196, 196, 0) 100%);
        }
        .shape2 {
            bottom: -6rem;
            right: -5.5rem;
            background: linear-gradient(180deg, var(--first-color) 0%, rgba(196, 196, 196, 0) 100%);
            transform: rotate(180deg);
        }

        /*=== Form ===*/
        .form {
            height: 100vh;
            display: grid;
            justify-content: center;
            align-items: center;
            padding: 0 1rem;
        }
        .form__content {
            width: 290px;
        }
        .form__img {
            display: none;
        }
        .form__title {
            font-size: var(--big-font-size);
            font-weight: 500;
            margin-bottom: 2rem;
            color: black;
        }
        .form__div {
            position: relative;
            display: grid;
            grid-template-columns: 7% 93%;
            margin-bottom: 1rem;
            padding: .25rem 0;
            border-bottom: 1px solid var(--text-color);
        }

        /*=== Div focus ===*/
        .form__div.focus {
            border-bottom: 1px solid var(--first-color);
        }

        .form__div-one {
            margin-bottom: 3rem;
        }

        .form__icon {
            font-size: 1.5rem;
            color: var(--text-color);
            transition: .3s;
        }

        /*=== Icon focus ===*/
        .form__div.focus .form__icon {
            color: var(--first-color);
        }

        .form__label {
            display: block;
            position: absolute;
            left: .75rem;
            top: .25rem;
            font-size: var(--normal-font-size);
            color: var(--text-color);
            transition: .3s;
        }

        /*=== Label focus ===*/
        .form__div.focus .form__label {
            top: -1.5rem;
            font-size: .875rem;
            color: var(--first-color);
        }

        .form__div-input {
            position: relative;
        }
        .form__input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            outline: none;
            background: none;
            padding: .5rem .75rem;
            font-size: 1.2rem;
            color: var(--first-color);
            transition: .3s;
        }
        .form__button {
            width: 100%;
            padding: 1rem;
            font-size: var(--normal-font-size);
            outline: none;
            border: none;
            margin-bottom: 3rem;
            background-color: var(--first-color);
            color: #fff;
            border-radius: .5rem;
            cursor: pointer;
            transition: .3s;
        }
        .form__button:hover {
            box-shadow: 0px 15px 36px rgba(0, 0, 0, .15);
        }

        /*===== MEDIA QUERIES =====*/
        @media screen and (min-width: 968px) {
            .shape1 {
                width: 400px;
                height: 400px;
                top: -11rem;
                left: -6.5rem;
            }
            .shape2 {
                width: 300px;
                height: 300px;
                right: -6.5rem;
            }

            .form {
                grid-template-columns: 1.5fr 1fr;
                padding: 0 2rem;
            }
            .form__content {
                width: 320px;
            }
            .form__img {
                display: block;
                width: 700px;
                justify-self: center;
            }
        }
    </style>
</head>
<body>
    <div class="l-form">
        <div class="shape1"></div>
        <div class="shape2"></div>

        <div class="form">
            <img src="img/WanderLust-Logo.png" alt="" class="form__img">

            <form action="login-admin.php" method="POST" class="form__content">
                <h1 class="form__title">Welcome</h1>

                <div class="form__div form__div-one">
                    <div class="form__icon">
                        <i class='bx bx-user-circle'></i>
                    </div>

                    <div class="form__div-input">
                        <label for="username" class="form__label"></label>
                        <input type="text" placeholder="Username" id="username" name="username" class="form__input">
                    </div>
                </div>

                <div class="form__div">
                    <div class="form__icon">
                        <i class='bx bx-lock'></i>
                    </div>

                    <div class="form__div-input">
                        <label for="password" class="form__label"></label>
                        <input type="password" placeholder="Password" id="password" name="password" class="form__input">
                    </div>
                </div>

                <input type="submit" class="form__button" value="Login">
            </form>
        </div>
    </div>
</body>
</html>

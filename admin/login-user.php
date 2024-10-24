<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login User</title>

   <!-- Include your CSS files -->
   <link rel="stylesheet" href="../admin/css/style.css">
   <!-- Include Remixicon for icons -->
   <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
   <!-- Additional styles specific to your login page -->
   <style>
      /* Add your additional styles here */
   </style>
</head>
<body>
   <div class="login">
      <img src="../images/pic1register.jpg" alt="login image" class="login__img">

      <form action="act_login.php" method="POST" class="login__form">
         <h1 class="login__title">Login</h1>

         <div class="login__content">
               <div class="login__box">
                  <i class="ri-user-3-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="username" required class="login__input" id="username" name="username" placeholder=" ">
                     <label style="color: var(--white-color)"for="login-username" class="login__label">Username</label>
                  </div>
               </div>

            <div class="login__box">
               <i class="ri-lock-2-line login__icon"></i>
               <div class="login__box-input">
                  <input type="password" required class="login__input" id="password" name="password" placeholder=" ">
                  <label style="color: var(--white-color)" for="password" class="login__label">Password</label>
                  <i class="ri-eye-off-line login__eye" id="login-eye"></i>
               </div>
            </div>
         </div>

         <div class="login__check">
            <p class="login__register">
               Don't have an account? <a href="register-user.php">Register</a>
            </p>
         </div>

         <button type="submit" class="login__button">Login</button>

         <?php
         session_start();
         if (isset($_SESSION['login_error'])) {
            echo '<p class="login__error">' . $_SESSION['login_error'] . '</p>';
            unset($_SESSION['login_error']); // Clear the error message after displaying
         }
         ?>

         <p class="login__register">
            Are you admin? <a href="../admin/login-admin.php">Login</a>
         </p>
      </form>
   </div>
</body>
</html>

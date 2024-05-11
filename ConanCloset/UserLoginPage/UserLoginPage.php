<?php
    
    include("..\Classes\Connect.php");
    include("..\Classes\LoginClass.php");

    $email = "";
    $password = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      
    $login = new Login();
    $result = $login->evaluateUser($_POST);

    if($result != "")
    {
      echo "</div></div>";
      echo "<div style='text-align:center;font-size:34px;color:red;background-color: rgba(5, 31, 79, 1);font-weight: bold;'>";
      echo $result;
     
    }
    else
    {
      header("Location: ..\UserProfile\UserProfile.php");
      die;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./vars.css">
  <link rel="stylesheet" href="./style.css">
  
  <style>
   a,
   button,
   input,
   select,
   textarea, 
   h1,
   h2,
   h3,
   h4,
   h5,
   * {
   box-sizing: border-box;
   margin: 0;
   padding: 0;
   border: none;
   text-decoration: none;
   appearance: none;
   background: none;
   -webkit-font-smoothing: antialiased;
   }

  </style>

<script>
    function validateForm() {
      var email = document.getElementById("email").value;
      var password = document.getElementById("password").value;

      // Email validation
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
      }

      return true; // Form is valid, submit
    }
  </script>

</head>
<body>
  <div class="login-page">
    <div class="login-frame">
      <div class="rectangle-1379"></div>
      <div class="login">User Login</div>
      <div class="email2">Email</div>
      <div class="password2">Password</div>
      

      <form method="post" onsubmit="return validateForm()">


        <div class="email">
          <input value="<?php echo $email ?>" type="email" name="email" placeholder="Email">
        </div>

        <div class="password">
          <input value="<?php echo $password ?>" type="password" name="password" placeholder="Password">
        </div>

        <a href="..\ForgetPassword\index.php" class="forgot-password">Forgot Password?</a>

        <button type="submit" class="sign-in-button">Login</button>
        <!-- register path -->
        <a href="..\SignUpPage\index.php" class="register-botton">Don’t have an account yet? Register</a>
        <a href="..\AdminLoginpage\AdminLoginpage.php" class="Admin-botton">Admin Login</a>
        
      
        
      </form>

    </div>
    <img class="image-1" src="image-10.png" />
   
    <?php include("..\DHeader.php")?>
  
</body>
</html>

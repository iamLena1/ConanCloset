<?php
    
    include("..\Classes\Connect.php");
    include("..\Classes\LoginClass.php");

    $email = "";
    $password = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      
    $login = new Login();
    $result = $login->evaluateAdmin($_POST);

    if($result != "")
    {
      echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
      echo "<br>The following errors occured:<br><br>";
      echo $result;
      echo "</div>";
    }
    else
    {
      header("Location: ..\AdminPanel\AdminPanel.php");
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

</head>
<body>
  <div class="login-page">
    <div class="login-frame">
      <div class="rectangle-1379"></div>
      <div class="login">Admin Login</div>
      <div class="email2">Email</div>
      <div class="password2">Password</div>
      

      <form method="post">


        <div class="email">
          <input value="<?php echo $email ?>" type="email" name="email" placeholder="Email">
        </div>

        <div class="password">
          <input value="<?php echo $password ?>" type="password" name="password" placeholder="Password">
        </div>



        <button type="submit" class="sign-in-button">Login</button>
        <a href="..\UserLoginpage\UserLoginpage.php" class="register-botton">Not an Admin? Back to user login</a>
      
        
      </form>

    </div>
    <img class="image-1" src="image-10.png" />
   
    <?php include("..\DHeader.php")?>

  </div>
  
</body>
</html>

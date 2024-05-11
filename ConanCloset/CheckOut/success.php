<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./vars.css">
  <link rel="stylesheet" href="./style.css">
  <title>Payment Successful</title>
  <style>
    .success-message {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      color: white;
      font-size: 2em; /* Adjust font size as needed */
    }
    .success-message a{
      color: red;
    }
  </style>
</head>

<?php include("..\DHeader.php")?>

<body>
  <div class="check-out-page">
    <div class="header">
      <div class="closet">closet</div>
      <div class="conan">Conan</div>
      <img class="cart-account" src="cart-account0.svg" />
    </div>
    <div class="check-out-page">
    <img class="image-3" src="image-30.png" />
    
    <div class="success-message">
      <h1>Payment Successful!</h1>
      <p>Thank you for your order. You will receive a confirmation email shortly.</p>
      <a href="../MainPage/MainPage.php">Return to Home Page</a>



    </div>
  </div>
</body>
</html>


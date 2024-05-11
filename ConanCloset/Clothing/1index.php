<?php
include("../Classes/Connect.php");
$database = new Database();
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
   select, h1,
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
  <title>Clothing&Cosplay</title>
</head>
<body>
  
  <?php

  $sql = "SELECT * FROM product WHERE Categry='clothing & cosplay'";
  $clothing_data = $database->read($sql);

  // Check if query failed
  if ($clothing_data === false) {
    echo "Error: Failed to retrieve clothing data.";
    exit;
  }

  ?>

  <div class="clotheing-andcosplay">
   <div class="clothing-products" 
     style="
       background: url(ClothingBG.jpg) center; 
       background-size: cover; 
       background-repeat: no-repeat;
       "
     >
      <div class="clotheing-cosplay">
        <h2>Clothing & Cosplay</h2>
        <div class="products-container">
          <?php
            $productCount = 0; // Counter for tracking product count
            foreach ($clothing_data as $product) {
              $product_number = $product["Number"];
              $product_image = $product["Image"]; // Assuming "Image" is the column name for image path
              $product_name = $product["Name"];
              $product_price = $product["price"];

              // Open a new product row if needed
              if ($productCount === 0 || $productCount %4 === 0) {
               echo '<div class="products-row">';
              }
              ?>

              <div class="product-template">
                <img class="product-pic" src="<?php echo $product_image; ?>" alt="Product Image" />
                <div class="product-name"><?php echo $product_name; ?></div>
                <div class="price"><?php echo $product_price; ?></div>
                <form action="cart.php" method="post">
                <button type="submit">Add to Cart</button>
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                </form>
              </div>

              <?php
              $productCount++; // Increment product counter
              //Close the current row if it's the last product or a multiple of 4
              if ($productCount === count($clothing_data) || $productCount %4 === 0) {
                echo '</div>';
              }
           }?>
      
        </div>
      </div>
   </div>
  </div>

    <div class="header">
      <div class="closet">closet</div>
      <div class="conan">Conan</div>
      <img class="cart-account" src="cart-account0.svg" />
    </div>
    <div
      class="footer"
      style="
        background: url(footer0.png) center;
        background-size: cover;
        background-repeat: no-repeat;
      "
    >
      <div class="identification">
        <div class="conancloset">
          <span>
            <span class="conancloset-span">Conan</span>
            <span class="conancloset-span2">closet</span>
            <span class="conancloset-span3"></span>
          </span>
        </div>
        <div class="there-is-only-one-truth">
          There is only
          <br />
          one truth !
        </div>
      </div>
      <div class="social-media">
        <div class="group-12">
          <div class="ellipse-3"></div>
          <img class="ri-instagram-fill" src="ri-instagram-fill0.svg" />
        </div>
        <img class="group-13" src="group-130.svg" />
      </div>
      <div class="information">
        <div class="information2">Information</div>
        <div class="about">About</div>
        <div class="product2">Product</div>
        <div class="blog">Blog</div>
      </div>
      <div class="company">
        <div class="company2">Company</div>
        <div class="community">Community</div>
        <div class="career">Career</div>
        <div class="our-story">Our story</div>
      </div>
      <div class="contact">
        <div class="contact2">Contact</div>
        <div class="getting-started">Getting Started</div>
        <div class="pricing">Pricing</div>
        <div class="resources">Resources</div>
      </div>
      <div class="_2024-all-right-reserved-term-of-use-conan-closet">
        2024 all Right Reserved Term of use CONAN CLOSET
      </div>
    </div>
  </div>
  
</body>
</html>
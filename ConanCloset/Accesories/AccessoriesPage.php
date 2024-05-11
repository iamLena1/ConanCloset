<?php
    require "..\db_conn.php";
    $accessories_data =getAllAccessories($connection);// to get all the product from the database

    include("..\Classes\Connect.php");
    include("..\Classes\LoginClass.php");
    include("..\Classes\ProfileClass.php");

    function getAllAccessories($connection)
    {
        $sql = "SELECT * FROM product WHERE Categry='Accessories'";
        $stm = $connection->prepare($sql);
        $stm->execute();
    
        if ($stm->rowCount() > 0) {
            $items= $stm ->fetchAll();
        } else {
            $items = 0;
        }
        return $items;
    }
   
// Add to cart functionality
if (isset($_POST['add_to_cart']) && isset($_POST['product_id'])) {
  $product_id = $_POST['product_id'];
  $user_id = (isset($_SESSION['ConanCloset_ID'])) ? $_SESSION['ConanCloset_ID'] : null; // Optional: Check for logged in user
  
  // Check if item already exists in cart
  $sql_check = "SELECT Quantity FROM cart WHERE Number = ?"; 
  $stmt_check = $connection->prepare($sql_check);
  
  $stmt_check->bindValue(1, $product_id, PDO::PARAM_INT);

  $stmt_check->execute();
  $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    // Item already exists, update quantity
    $current_quantity = $result['Quantity'];
    $new_quantity = $current_quantity + 1;

    $sql_update = "UPDATE cart SET Quantity = ? WHERE ID = ? AND Number = ?";
    $stmt_update = $connection->prepare($sql_update);
    $stmt_update->bindValue(1, $new_quantity, PDO::PARAM_INT);
    $stmt_update->bindValue(2, $user_id, PDO::PARAM_INT);
    $stmt_update->bindValue(3, $product_id, PDO::PARAM_INT);
    $stmt_update->execute();

    if ($stmt_update->rowCount() > 0) {
      $successMsg = "Item added agaian to cart successfully!"; 
 
      
    } else {
      $errorMsg = "Error updating item quantity in cart.";
 
    }
  }
 
  
  else {
    // Item doesn't exist, insert new entry
    $sql = "INSERT INTO cart (ID, Number, Quantity, cartID) VALUES (?, ?, 1,'')";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(1, $user_id);
    $stmt->bindValue(2, $product_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
      $successMsg = "Item added to cart successfully!";
    
  
    } else {
      $errorMsg = "Error adding item to cart: ";
   
    }
 
  }

  echo "<script>";
  if (isset($successMsg)) {
      echo "alert('$successMsg');";
  } elseif (isset($errorMsg)) {
      echo "alert('$errorMsg');";
  }
  echo "window.location.href = 'AccessoriesPage.php';";
  echo "</script>";
  exit(); // Stop further execution


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
  <title>Accessories</title>
</head>
<body>
  
 <div class="accessories">
  <div class="acceories-products" 
    style="
      background: url(AccessoriesBG.jpg) center; 
      background-size: cover; 
      background-repeat: no-repeat;
      "
    >
     <div class="accsessories">
       <h2>Accessories</h2>
       <div class="products-container">
         <?php
           $productCount = 0; // Counter for tracking product count
           foreach ($accessories_data as $product) {
             $product_number = $product["Number"];
             $product_image ='data:image/jpeg;base64,'. base64_encode($product['Image']).'"style: height="100px;"/>'; // Assuming "Image" is the column name for image path
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
               <?php

if (isset($_SESSION["ConanCloset_ID"])) {
  // User is logged in, display the form
?>

<form method="post">
<input type="hidden" name="product_id" value="<?php echo $product_number; ?>">
<button type="submit" name="add_to_cart">Add to Cart</button>
</form>

<?php
} else {
  // User is not logged in, display a message or redirect to login page
  echo "Please log in to add items to your cart.";
}
?>
             </div>

             <?php
             $productCount++; // Increment product counter
             //Close the current row if it's the last product or a multiple of 4
             if ($productCount %4 === 0) {
               echo '</div>';
             }
          }?>    
       </div>
     </div>
   </div>
  </div>

  <?php include("..\Header.php")?>
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

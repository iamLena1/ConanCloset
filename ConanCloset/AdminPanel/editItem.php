<?php
    if (!isset($_GET['id'])) {
        $errorMsg="Product ID not selected";
        header("Location: AdminPanel.php?error=$errorMsg");
        exit;
    } 

    // Include database connection
    include "db_conn.php"; 

    // Get product details from database
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE Number=?";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();
    $item = $stmt->fetch();

      // Generate CSRF token
  if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = base64_encode(random_bytes(32));
  }
  $csrf_token = $_SESSION['csrf_token'];
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./vars.css">
  <link rel="stylesheet" href="./style.css">
  <!-- bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- bootstrap JS bundle 5 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <title>Admin Panel</title>
  
  
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
</head>
<body>
    <div class="forgot-password">
        <div class="container">
                <form method="POST"
                    action="editItemFun.php"
                    class="shadow p-4 rounded mt-5 form-container"
                    enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
 
                    <h1 class="text-center pb-5 display-4 fs-3">Edit Product</h1>
                    <?php if(isset($_GET['error'])) {?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($_GET['error']); ?>
                    </div>
                    <?php } ?>
                        
                    <div class="mb-3">
                        <input value="<?= $item['Number'] ?>" name="ID" hidden>
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="ProductName" value="<?= $item['Character'] ?>">
                        <label class="form-label">Product Description</label>
                        <input type="text" class="form-control" name="ProductDesc" value="<?= $item['Name'] ?>">
                        <label class="form-label">Product Category</label>
                        <input type="text" class="form-control" name="ProductCategory" value="<?= $item['Categry'] ?>">
                        <label class="form-label">Product Quantity</label>
                        <input type="text" class="form-control" name="ProductQuantity" value="<?= $item['Quantity'] ?>">
                        <label class="form-label">Product Price</label>
                        <input type="text" class="form-control" name="ProductPrice" value="<?= $item['price'] ?>">
                        <label class="form-label">Upload Image</label>
                        <input type="file" class="form-control" name="productImage">
                        <br><br>
                        <button type="submit" class="update-button">Update Product</button>
                        <button class="Backkk-button">
                            <a href="AdminPanel.php" style="color: white;">Cancel</a>
                        </button>

                    </div>
                </form>
        </div>
    </div>

</body>
</html>


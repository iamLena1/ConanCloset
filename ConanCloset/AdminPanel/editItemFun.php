<?php
    require "db_conn.php";
          
    $image = $_FILES['productImage']['tmp_name'];
    $name = $_POST['ProductName']; // Character
    $desc = $_POST['ProductDesc']; // Name
    $category = $_POST['ProductCategory']; // Category
    $Qua = $_POST['ProductQuantity']; // Quantity
    $price = $_POST['ProductPrice'];    
    $id = $_POST['ID'];    


// Check if CSRF token is present and valid
if (!isset($_POST['csrf_token']) || !hash_equals($_POST['csrf_token'], $_SESSION['csrf_token'])) {
    die('Invalid CSRF token');
}

    // Check if all required fields are filled
    if (!empty($image) && !empty($name) && !empty($desc) && !empty($category) && !empty($Qua) && !empty($price)) {
        $image = file_get_contents($image);
        $fileName = basename($_FILES["productImage"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);                   

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif'); 
        if (in_array($fileType, $allowTypes)) { 
            $sql = "UPDATE product SET Image=?, `Character`=?, `Name`=?, `Categry`=?, Quantity=?, price=? WHERE Number=?"; 
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1, $image);
            $stmt->bindValue(2, $desc);
            $stmt->bindValue(3, $name);
            $stmt->bindValue(4, $category);
            $stmt->bindValue(5, $Qua, PDO::PARAM_INT);
            $stmt->bindValue(6, $price);
            $stmt->bindValue(7, $id, PDO::PARAM_INT);
            $stmt->execute(); 
            if ($stmt) { 
                $successMsg = "Product Updated successfully."; 
                echo "<script>alert('$successMsg');</script>";
                echo "<script>window.location.href = 'AdminPanel.php';</script>";
            } else {
                $fillMsg = "Product failed to Updated, please try again.";
                echo "<script>alert('$fillMsg');</script>";
                echo "<script>window.location.href = 'editItem.php';</script>";
            }                     
        } else {
            // If file type not allowed
            $fillMsg = 'Sorry, only JPG, JPEG, PNG, and GIF files are allowed to upload.'; 
            echo "<script>alert('$fillMsg');</script>";
            echo "<script>window.location.href = 'editItem.php';</script>";
        }                   
    } else {
        // If some fields not filled
        $fillMsg = "All fields are required, please try again.";
        echo "<script>alert('$fillMsg');</script>";
        echo "<script>window.location.href = 'editItem.php';</script>";
    }
?>


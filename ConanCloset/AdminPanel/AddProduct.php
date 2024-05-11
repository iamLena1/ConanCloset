<?php
    session_start();
    
    if (isset($_SESSION['ConanCloset_ID']) &&
        isset($_SESSION['ConanCloset_ID']) ) {
        
        require "db_conn.php";
          
        $image = $_FILES['productImage']['tmp_name'];
        $name = $_POST['ProductName']; // Character
        $desc = $_POST['ProductDesc']; // Name
        $category = $_POST['ProductCategory']; // Category
        $Qua = $_POST['ProductQuantity']; // Quantity
        $price = $_POST['ProductPrice'];    
     
       
        if (isset($image) &&
            isset($name) &&
            isset($desc) &&
            isset($category) &&
            isset($Qua) &&
            isset($price) 
             )  {
                
                if (empty($image) ||
                    empty($name)  ||
                    empty($desc)  ||
                    empty($category)  ||
                    empty($Qua)  ||
                    empty($price) ) {
                    $fillMsg = "All fields are required, please try again.";
                    echo "<script>alert('$fillMsg');</script>";
                    echo "<script>window.location.href = 'AddProductPage.php';</script>";
                } else { # if all fields filled
                            $image=file_get_contents($image);
                            $fileName = basename($_FILES["productImage"]["name"]); 
                            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);                   
                            
                                // Allow certain file formats 
                                $allowTypes = array('jpg','png','jpeg','bmp'); 
                                if(in_array($fileType, $allowTypes)){ 
                                 $sql = "INSERT INTO product (`Image`, `Character`, `Name`, `Categry`, `Quantity`, `price`, `Number`)
                                VALUES (?, ?, ?, ?, ?, ?, ?);";
                                    
                                $stmt = $connection->prepare($sql);
                                $stmt->bindValue(1, $image);
                                $stmt->bindValue(2, $desc);
                                $stmt->bindValue(3, $name);
                                $stmt->bindValue(4, $category);
                                $stmt->bindValue(5, $Qua, PDO::PARAM_INT);
                                $stmt->bindValue(6, $price);
                                $stmt->bindValue(7, $id, PDO::PARAM_INT);
                                $stmt->execute(); 
                                    if($stmt){ 

                                        $successMsg = "Product Added successfully."; 
                                        echo "<script>alert('$successMsg');</script>";
                                        echo "<script>window.location.href = 'AdminPanel.php';</script>";
                                    }else{ # if some error happens during adding the product 
                                        $fillMsg = "Product failed to be Added, please try again.";
                                        echo "<script>alert('$fillMsg');</script>";
                                        echo "<script>window.location.href = 'AddProductPage.php';</script>";
                                        }                     
                            }else{ // if file type not allowed
                                $fillMsg = 'Sorry, only JPG, JPEG, PNG, and GIF files are allowed to upload.'; 
                                echo "<script>alert('$fillMsg');</script>";
                                echo "<script>window.location.href = 'AddProductPage.php';</script>";ader("Location: AddProduct.php?error=$fillMsg");
                                    }                   
                       }
        }
         else { # if some fields not filled
            $fillMsg = "All fields are required, please try again.";
            echo "<script>alert('$fillMsg');</script>";
            echo "<script>window.location.href = 'AddProdutPage.php';</script>";
              }

    } else { # if the admin not login 
        $msg = "Please Login As An Admin";
        header("Location: LoginAdmin.php?error=$msg");
        exit; } 
?>
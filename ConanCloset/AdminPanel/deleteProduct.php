<?php
    session_start();
   
    if (isset($_SESSION['ConanCloset_ID']) &&
        isset($_SESSION['ConanCloset_ID']) ) {
        
        if (isset($_GET['id'])) { # if product selected 
            include "db_conn.php";
            $id = $_GET['id'];  
            $sql = "DELETE FROM product WHERE Number=?";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1,$id);
            $res  = $stmt->execute();
            
            if ($res) {
                # success message
                $fillMsg = "Product Deleted Successfully.";
                echo "<script>alert('$fillMsg');</script>";
                echo "<script>window.location.href = 'AdminPanel.php';</script>";
            }
            else {
                $fillMsg = "Error Occurred!";
                header("Location: AdminPanel.php?error=$fillMsg");
               exit;
            }    
            
            

        }
        else { # if product not selected 
            header("Location: AdminPanel.php?error=not selected product");
        }
             
     
    } else { # if the admin not login 
        $msg = "Please Login As An Admin To Delete Products";
        header("Location: LoginAdmin.php?error=$msg");
        exit; } 
?>
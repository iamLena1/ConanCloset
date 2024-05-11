<?php

function increaseOrderCount($connection)
{
    $user_id = $_SESSION['ConanCloset_ID']; // Assuming user is logged in
    $sql = "UPDATE user SET Number_Of_Orders = Number_Of_Orders	 + 1 WHERE ID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
    $stmt->execute();
}


?>


<?php
session_start();
if (isset($_SESSION['ConanCloset_ID']) && 
    isset($_SESSION['ConanCloset_ID']) )  {
        
        if(isset($_POST["order"]))
        {
            $total=0;
            require "../db_conn.php";
            //return all the items for the customer 
            $sql = "SELECT * FROM cart WHERE ID=?";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(1,$_SESSION['ConanCloset_ID']);
            $res = $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $items= $stmt ->fetchAll();
            } else {
                $items = 0;
                $fillMsg = "The cart Is Empty Please Add Some Products To Place An Order";
                header("Location: cart.php?error=$fillMsg");
                exit;
            }
            foreach ($items as $item) {
                // know each product id will call the product table to get the price
                $sql = "SELECT * FROM product WHERE Number=?";
                $stmt = $connection->prepare($sql);
                $stmt->bindValue(1,$item['Number']);
                $res = $stmt->execute();
            
                if ($stmt->rowCount() > 0) {
                    $products= $stmt ->fetchAll();
                } else {
                    $products = 0;
                }
                foreach ($products as $pro) {
                    //calculate the total
                    $x=$item['Quantity'] *  $pro['price'];
                    $total+=$x;


                       // Decrease the quantity of the product in the database
                    $newQuantity = $pro['Quantity'] - $item['Quantity'];
                    if ($newQuantity < 0) {
                        // Handle if the quantity goes negative (optional)
                        // Maybe throw an error or set quantity to 0
                        $newQuantity = 0;
                    }
                    
                    // Update the product table with the new quantity
                    $updateSql = "UPDATE product SET Quantity=? WHERE Number=?";
                    $updateStmt = $connection->prepare($updateSql);
                    $updateStmt->bindValue(1, $newQuantity);
                    $updateStmt->bindValue(2, $item['Number']);
                    $updateRes = $updateStmt->execute();
                        }
            }
         
          
                $sql = "DELETE FROM cart WHERE ID=?";
                $stmt = $connection->prepare($sql);
                $stmt->bindValue(1,$_SESSION['ConanCloset_ID']);
                $res  = $stmt->execute();

                 if ($res) {
           
                    increaseOrderCount($connection);
                    $successMsg = "Order Has Been Placed Successfully.";
                    header("Location: ../CheckOut/success.php");
                  
                }else {
         
                    $fillMsg = "Order Has Not Been Placed Successfully Some Error Occurred!";

                   
                exit;
                }

         
        } 
    }
        else {
            header("Location: ../UserProfile/UserProfile.php");
            exit;
        }
        
?>
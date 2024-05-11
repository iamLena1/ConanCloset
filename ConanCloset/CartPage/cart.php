
<?php
    require "..\db_conn.php";
    include "getCart.php";

    $items=getAllCart($connection); // to get all the product from the database
   
    include("..\Classes\Connect.php");
    include("..\Classes\LoginClass.php");
    include("..\Classes\ProfileClass.php");
    
    if(isset($_SESSION['ConanCloset_ID']) && is_numeric($_SESSION['ConanCloset_ID']))
    {
      $id = $_SESSION['ConanCloset_ID'];

      $login = new Login();
      $result= $login->check_loginUser($id);

      if($result)
      {
        $user = new User();
        $user_data = $user->get_dataUser($id);

        if(!$user_data)
        {
          header("location: ..\UserLoginPage\UserLoginPage.php");
          die;
        }
      }
      else
      {
        header("location: ..\UserLoginPage\UserLoginPage.php");
        die;
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
  <!-- bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- bootstrap JS bundle 5 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
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
  <title>Document</title>
</head>
<body>
<div class="CartContainer1">
   	   <div class="Header">
   	   	<h3 class="Heading">Here's your Shopping Cart</h3>

   	   </div>
		  <?php if(isset($_GET['success'])) {?>
            <div class="alert alert-success" 
                 role="alert">
                <?=filter_var($_GET['success'],FILTER_SANITIZE_STRING); ?>
            </div>
            <?php } ?>

        <?php if(isset($_GET['error'])) {?>
            <div class="alert alert-danger" 
                 role="alert">
                <?=filter_var($_GET['error'],FILTER_SANITIZE_STRING); ?>
            </div>
        <?php } ?>
<?php
// if the user update the Quantity 
if(isset($_POST["Update"]))
{
	$id = $_POST["Update"];
	$qq = $_POST['qunt']; 
	require "..\db_conn.php";
	$sql = "UPDATE cart SET Quantity=? WHERE Number=?";
	$stmt = $connection->prepare($sql);
	$stmt->bindValue(1,$qq);
	$stmt->bindValue(2,$id);
	$res  = $stmt->execute();
	if ($res) {
		# success message
		$successMsg = "Product Quantity Updated Successfully.";
		header("Location: cart.php?success=$successMsg");
	}else {
		$fillMsg = "Product Quantity can not be Updated Error Occurred!";
		header("Location: cart.php?error=$fillMsg");
	   exit;
	}

}
// if the user click remove 
if(isset($_POST["Deleted"]))
{
require "..\db_conn.php";
$deleted= $_POST["Deleted"];
$DeleteQ= "DELETE FROM cart WHERE Number =?;";
$stmt = $connection->prepare($DeleteQ);
$stmt->bindValue(1,$deleted);
$stmt->execute();
}


require "..\db_conn.php";

$sql = "SELECT * FROM cart where ID=?";
$stmt = $connection->prepare($sql);
$stmt->bindValue(1,$_SESSION['ConanCloset_ID']);
$stmt->execute();
if ($stmt->rowCount() > 0) {
$Array=[];
while($CartData=$stmt->fetch())
{
	
		$Products=$CartData['Number'];
		$Array[]=$Products;
		$q=$CartData['Quantity'];
		$qun[]=$q; 
	
	
}	


$counter=0; 

foreach($Array as $product)
{

$Psql = "SELECT * FROM product WHERE Number=?";
$stmt = $connection->prepare($Psql);
$stmt->bindValue(1,$product);
$stmt->execute();

while($row=$stmt->fetch())
	{
	
$Base64=base64_encode( $row['Image'] );

 
?>



<div class="items-list">
 
    <table class="table table-bordered shadow">
            <thead>

                <tr class="first-row">
                    <th width="100">Product Image</th>
                    <th width="100">Name</th>
                    <th width="190">Product Description</th>
                    <th width="100">Quantity</th>
                    <th width="100">Price</th>
                    <th width="90">Action</th>
                </tr>

            </thead>
            <tbody>
           
            <td>
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Image'] ).'"style: height="120px;"/>'; ?>        
            </td>
            
            <td><?php echo $row["Name"];?></td>
            <td><?php echo $row["Character"];?></td>

            <td>
			<form method="POST" action="cart.php">
				<input name="qunt" type="number" class="form-control" id="qunt" min="1" value="<?php echo $qun[$counter]?>">
					<button name="Update" value=<?php echo $row["Number"]; ?> style="background-color: white; border: none; border-radius: 5px; color: #333; /* Dark grey */ padding: 15px 32px color:blue"> 
						<u>Update</u>
					</button>
            </form>
            </td>
           
            <?php $totalPrice = $row["price"] * $qun[$counter]; ?>
   	   	  	<td><?php echo $totalPrice;?></td>
   	   	  	
            <td>
            <form method="POST" action="cart.php">
             <button name="Deleted" value=<?php echo $row["Number"]; ?> style="background-color: white; border: none; border-radius: 5px; color: #333; /* Dark grey */ padding: 15px 32px color:blue"> <u>Remove</u></button> 
            </form>
            </td>
            </tbody>
        </table>
      
</div>	
<?php 
++$counter;
	}
}?>
<button class="rectangle-15" onclick="window.location.href = '../CheckOut/checkout.php';">
        Continue
       </button>	
  	<?php }
else
{
	echo "<h3> Empty Cart, Please Add Some Product To The Cart </h3>";
}
?>

</div>

<?php } else {  //if the user is not logged in
	$msg= "Please Login To See the Shopping Cart";
    header("Location: ../UserLoginPage/UserLoginPage.php?error=$msg");
    exit;
}
?>

    <div class="rectangle-1384"></div>
    <img class="image-8" src="image-80.png" />
    <div
      class="footer"
      style="
        background: url(footer0.png) center;
        background-size: cover;
        background-repeat: no-repeat;
      "
    >
      <div class="frame-52">
        <div class="frame-50">
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
      </div>
      <div class="frame-51">
        <div class="group-12">
          <div class="ellipse-3"></div>
          <img class="ri-instagram-fill" src="ri-instagram-fill0.svg" />
        </div>
        <img class="group-13" src="group-130.svg" />
      </div>
      <div class="frame-53">
        <div class="information">Information</div>
        <div class="about">About</div>
        <div class="product2">Product</div>
        <div class="blog">Blog</div>
      </div>
      <div class="frame-54">
        <div class="company">Company</div>
        <div class="community">Community</div>
        <div class="career">Career</div>
        <div class="our-story">Our story</div>
      </div>
      <div class="frame-55">
        <div class="contact">Contact</div>
        <div class="getting-started">Getting Started</div>
        <div class="pricing">Pricing</div>
        <div class="resources">Resources</div>
      </div>
      <div class="_2024-all-right-reserved-term-of-use-conan-closet">
        2024 all Right Reserved Term of use CONAN CLOSET
      </div>
    </div>
    <?php include("..\DHeader.php")?>
  
  
</body>
</html>
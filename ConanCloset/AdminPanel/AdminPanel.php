<?php
    require "db_conn.php";
    include "Products.php";
    include "dash.php";
    $items2=getCategoryTotalQuantity($connection); // to get all the product from the database
    $items=getAllItems($connection); // to get all the product from the database
   
    include("..\Classes\Connect.php");
    include("..\Classes\LoginClass.php");
    include("..\Classes\ProfileClass.php");
    if(isset($_SESSION['ConanCloset_ID']) && is_numeric($_SESSION['ConanCloset_ID']))
    {
      $id = $_SESSION['ConanCloset_ID'];

      $login = new Login();
      $result= $login->check_loginAdmin($id);

      if($result)
      {
        $user = new User();
        $user_data = $user->get_dataAdmin($id);

        if(!$user_data)
        {
          header("location: ..\AdminLoginPage\AdminLoginPage.php");
          die;
        }
      }
      else
      {
        header("location: ..\AdminLoginPage\AdminLoginPage.php");
        die;
      }
    }
    else
    {
      header("location: ..\AdminLoginPage\AdminLoginPage.php");
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

  <title>Admin Panel</title>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   
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
  <title>Admin Panel</title>
</head>
<body>
  <div class="admin-panel">
    <div class="header-dashboard"></div>
    <div class="side-bar">
      <div class="admin-info">
        <div class="admin">Admin</div>
        <div class="line-33"></div>
      </div>
      <img class="amuro-pic" src="amuro-pic0.png" />
      <img class="akai-pic" src="akai-pic0.png" />
      
    /*for shaima Admin info*/
      <div class="admin-info2">
        <div class="line-34"></div>
        <div class="name">Name</div>
        <div class="some-one"><?php echo $user_data['First_Name'] . " " . $user_data['Last_Name'] ?></div>
        <div class="email">Email</div>
        <div class="oguchemaureenm-gmail-com"><?php echo $user_data['Email']?></div>
        <div class="line-32"></div>
        <div class="phone-number">Phone Number</div>
        <div class="_234-803-041-1314"><?php echo $user_data['Phone_Number']?></div>
        <div class="gender"></div>
        <div class="female"></div>
        <div class="line-332">
          <br><a href="..\Classes\Logout.php">Logout</a>
        </div>
      </div>


    </div>
    <div class="dash-title">
      <div class="dashboard">Dashboard</div>
      <div class="date">
        <img class="calendar" src="calendar0.svg" />
        <div class="oct-11-2023-nov-11-2022"><?php echo date("Y-m-d  |  H:i:s"); ?></div>
      </div>
    </div>
    <div
      class="saleas-graph"
      style="
        background: url(saleas-graph0.png) center;
        background-size: cover;
        background-repeat: no-repeat;
      "
    >
      <div class="sales-title">
        <div class="sale-graph">Total Quantity</div>
      </div>
      <div class="sales-graph">
        <div class="frame-2609101">

          <div class="chart-container">
            <canvas id="categoryTotalQuantityChart"></canvas>
          </div>

          <script>
            var ctx = document.getElementById('categoryTotalQuantityChart').getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: <?php echo json_encode($categories); ?>,
                datasets: [{
                  label: 'Total Quantity',
                  data: <?php echo json_encode($quantities); ?>,
                  backgroundColor: 'rgba(54, 162, 235, 0.2)',
                  borderColor: 'rgba(54, 162, 235, 1)',
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  xAxes: [{
                    barPercentage: 0.6 // Adjust this value to control category width
                  }]
                },
                y: {
                  beginAtZero: true
                }
              }
            });
          </script>
        
        </div>
        <img class="group-2988" src="group-29880.svg" />

      </div>
    </div>

     <?php include("..\DHeader.php")?>
   
  
      <button class="rectangle-15" onclick="window.location.href = 'ShowUsers.php';">
        Show Users
      </button>

      <button class="rectanglee-15"onclick="window.location.href = 'AdminPanel.php';">
        Show Products
      </button>

      <button class="rectangleee-15" onclick="window.location.href = 'AddProductPage.php';">
        Add Product
      </button>

  

  
    <div class="items-list">
 
    <table class="table table-bordered shadow">
            <thead>

                <tr class="first-row">
                <th width="80">ID</th>
                    <th>Product Image</th>
                    <th>Category</th>
                    <th>Product Description</th>
                    <th width="100">Quantity</th>
                    <th width="100">Price</th>
                    <th width="140">Action</th>
                </tr>

            </thead>
            <tbody>
                <?php  foreach ($items as $item) { ?>
                <tr>
                    <td> <?=$item['Number'] ?> </td>
                    <td>
                        <? $Base64=base64_encode( $item['Image'] );?> 
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $item['Image'] ).'"style: height="100px;"/>'; ?>
                    </td>
                    <td><?=$item['Categry']?> </td>
                    <td><?=$item['Character'] ?> </td>
                    <td><?=$item['Quantity'] ?> </td>
                    <td><?=$item['price'] ?> SAR</td>
                    <td>    


                            <a href="editItem.php?id=<?=$item['Number'] ?>" class="edittt">
                                Edit
                            </a> 

                            <a href="deleteProduct.php?id=<?=$item['Number'] ?>" class="deletee">
                                Delete
                            </a>

                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
      
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
          <div class="group-122">
            <div class="ellipse-3"></div>
            <img class="ri-instagram-fill" src="ri-instagram-fill0.svg" />
          </div>
          <img class="group-13" src="group-130.svg" />
        </div>
        <div class="information">
          <div class="information2">Information</div>
          <div class="about">About</div>
          <div class="product">Product</div>
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

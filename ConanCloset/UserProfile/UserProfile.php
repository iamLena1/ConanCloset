<?php
  
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
  <div class="user-profile">
    <img class="vector" src="vector0.svg" />
    <div class="log-out-botton">
      <img class="fi-rr-arrow-left" src="fi-rr-arrow-left0.svg" />
      <div class="logout2">
         <a href="..\Classes\Logout.php"><span style = "color: grey;" >Logout</span></a>
      </div>
      
    </div>
    <div class="username"><?php echo $user_data['First_name'] . " " . $user_data['Last_name'] ?> </div>
    <div class="user-info">
      <div class="email">Email</div>
      <div class="oguchemaureenm-gmail-com"><?php echo $user_data['Email']?></div>
      <div class="line-32"></div>
      <div class="phone-number">Phone Number</div>
      <div class="_234-803-041-1314"><?php echo $user_data['Phone_Number']?></div>
      <div class="line-33"></div>
      <div class="number-of-orders">Number of orders</div>
      <div class="_0">
      <?php echo $user_data['Number_Of_Orders']?>
        <br />
      </div>
    </div>
    <!-- <div class="rectangle-1384"></div> -->
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
        <div class="product">Product</div>
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
    <img class="untitled-project-14-1" src="untitled-project-14-10.png" />
    <img class="untitled-design-1" src="untitled-design-10.png" />
  </div>
  
</body>
</html>



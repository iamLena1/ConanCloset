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
  <div class="forgot-password">
    <div class="forget-pass-frame">

    <?php include("..\DHeader.php")?>

      <div class="full-frame">
        
        <div class="forg-frame">
          <div class="main">
            
            <div class="info">
              
              <div class="back-text">
                
                <a href="..\UserLoginPage\UserLoginPage.php" class="back">
                  <img class="chevron-back" src="chevron-back0.svg" />
                  <div class="back-to-login">Back to login</div>
                </a>
                
                
                <div class="text">
                  <div class="forgot-your-password">Forgot your password?</div>
                  <div class="don-t-worry-happens-to-all-of-us-enter-your-email-below-to-recover-your-password">
                    Don’t worry, happens to all of us. Enter your email below to
                    recover your password
                  </div>
                </div>

              </div>

              <form id="myForm" action="submit.php" method="post">
                <div class="submit-botton">
                  <button type="submit" class="submit-botton2">Submit</button>
                </div>
                              
                <div class="email">
                  <input id="emailInput" type="email" name="email" placeholder="Email">
                </div>
              </form>
              
              <div id="message" style="display: none;">Email has been sent!</div>

            </div>

          </div>
        </div>

        <img class="image-5" src="image-50.png" />
        
      </div>

    </div>
  </div>

  <script>
  // this script for massage when submitting the form
    document.addEventListener("DOMContentLoaded", function() {
      var form = document.getElementById('myForm');
      var emailInput = document.getElementById('emailInput');
  
      form.addEventListener('submit', function(event) {
        event.preventDefault();
        showAlert();
      });
  
      function showAlert() {
        var email = emailInput.value;
        alert('An Email has been sent to: ' + email);
        emailInput.value = '';
      }
    });
  </script>


  <script>
   // this script forswiching images
    document.addEventListener("DOMContentLoaded", function() {
      var image = document.querySelector('.image-5');
      image.addEventListener('mouseover', function() {

        if (image.src.endsWith('image-50.png')) {
          image.src = 'image-100.png';
        }
      });

      image.addEventListener('mouseout', function() {
        if (image.src.endsWith('image-100.png')) {
          image.src = 'image-50.png';
        }
      });
    });
  </script>

</body>
</html>


<?php
 include("..\Classes\Connect.php");
include('singUpclass.php');

$firstName = "";
$lastName = "";
$phoneNumber = "";
$email = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $signup = new signup();
    $result = $signup->evaluate($_POST);

    if ($result != "") {
        echo "<div style='text-align:center;font-size:12px;color:white;background-color:navy;'>";
        echo "<br>The following errors occurred: <br> <br>";
        echo $result;
        echo "</div>";
    } else {
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $phoneNumber = $_POST['phone-number'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Assuming you have a connection to the database and $DB->save() method in Database class
        $query = "INSERT INTO user (first_name, last_name, phone_number, email, password) VALUES ('$firstName', '$lastName', '$phoneNumber', '$email', '$password')";

        // Execute the query
        $DB = new Database();
        $res = $DB->save($query);

        if ($res) {
            // Success message and redirection
            $fillMsg = "Successfully signed up.";
            echo "<script>alert('$fillMsg');</script>";
            echo "<script>window.location.href = '../UserLoginPage/UserLoginPage.php';</script>";
            exit; // Ensure script execution stops after redirection
        }
    }
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
<div class="sign-up">
    <div class="success-message" id="successMessage" style="display: none; background-color: #4CAF50; color: white; text-align: center; padding: 10px;">
      Sign up successful!  
</div>
  <div class="sign-up">
    <div class="sign-frame">
      <img class="image-7" src="image-70.png" />
      <div class="sign-up-main">
        <div class="main">
          <div class="part-1">
            <div class="sign-up2">Sign up</div>
            <div
              class="let-s-get-you-all-st-up-so-you-can-access-your-personal-account"
            >
              Let’s get you all st up so you can access your personal account.
            </div>
          </div>
          <form action=" " method="post">
            <div class="credential">
              <div class="confirm-password">
                <div class="con-password">Confirm your Password</div>
                <input type="password" name="confirm-password" placeholder="Confirm your Password">
              </div>
          
              <div class="password">
                <div class="password2">Password</div>
                <input type="password" name="password" placeholder="Enter your Password">
              </div>
          
              <div class="email">
                <div class="email2">Email</div>
                <input type="email" name="email" placeholder="Enter your Email">
              </div>
          
              <div class="phone-number">
                <div class="phone-number2">Phone Number</div>
                <input type="text" name="phone-number" placeholder="Enter your phone number">
              </div>
          
              <div class="last-name">
                <div class="last-name2">Last name</div>
                <input type="text" name="last-name" placeholder="Enter your Last Name">
              </div>
          
              <div class="first-name">
                <div class="first-name2">First name</div>
                <input type="text" name="first-name" placeholder="Enter your first Name">
              </div>
           </div>

           <div class="create-account-botton">
           <button type="submit" class="create-account-botton1">Create Account</button>
          </div>
          </form>
          <div class="already-have-an-account-login">
            <span>
              <span class="already-have-an-account-login-span">
                Already have an account?
              </span>
              <a href="../UserLoginPage/UserLoginPage.php" class="already-have-an-account-login-span2">Login</a>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="header">
      <div class="closet">closet</div>
      <div class="conan">Conan</div>
      <img class="cart-account" src="cart-account0.svg" />
    </div>

    </body>
    </html>

    <script>
    const form = document.getElementById('myForm');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');

    // Validate the password and confirm password inputs
    function validatePassword() {
      const message = document.getElementById('password-message');
      passwordInput.setCustomValidity('');
      const password = passwordInput.value;

      if (password.length < 8 ) {
        message.innerHTML = 'Password must contain at least characters long and include at least one lowercase letter, one uppercase letter, and one number.';
        message.style.display = 'block';
        return false;
      } else if (!/[a-z]/.test(password) || !/[A-Z]/.test(password) || !/\d/.test(password) || !/\w/.test(password)) {
        message.innerHTML = 'Password must include at least one lowercase letter, one uppercase letter, one special character,and one number.';
        message.style.display = 'block';
        return false;
      } else {
        message.innerHTML = '';
        message.style.display = 'none';
      }

      if (passwordInput.value !== confirmPasswordInput.value) {
        message.innerHTML = 'Passwords do not match.';
        message.style.display = 'block';
        return false;
      }

      return true;
    }

    // Add an event listener to the form's submit button
    form.addEventListener('submit', function(event) {
      // Prevent the form from submitting automatically
      event.preventDefault();

      const isPasswordValid = validatePassword();

      // Submit the form if all input is valid
      if (isPasswordValid) {
        form.submit();
      }
    });
     

</script>
</body>
</html>



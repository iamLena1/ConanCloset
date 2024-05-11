<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css">
  <title>Document Title</title>
</head>
<body>
  <header>
    <nav>
    <button class="closet-conan-btn">
       <div class="closet">closet</div>
       <div class="conan3">Conan</div>
    </button>
      <ul>
        <li><a href="../CartPage/cart.php"><img src="..\include\cart.png" alt="Cart"></a></li>
        <li><a href="../UserProfile/UserProfile.php"><img src="..\include\pers.png" alt="uPage"></a></li>
        </ul>
    </nav>
  </header>
</body>
</html>
<script>
  const closetConanBtn = document.querySelector('.closet-conan-btn');

closetConanBtn.addEventListener('click', () => {
  window.location.href = '../MainPage/MainPage.php';
});

</script>
<style>
header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 80px
  background-color:  #f0f0f0; /* Optional background color */
  z-index: 100; /* Makes sure the header stays on top */
}

.closet-conan-btn {
  background-color: transparent; /* Remove default button background */
  border: none; /* Remove default button border */
  padding: 0; /* Remove default button padding */
  cursor: pointer; /* Indicate clickable behavior */
  display: flex; /* Arrange divs horizontally */
  /* Add other styles as needed (color, font, etc.) */
  position: absolute; /* Make the list absolutely positioned */
  top: 5px; /* Position it at the top of the page */
  left: 30px; /* Position it at the right edge of the page */
}


nav {
  background-color: #f0f0f0;
  color: #ececec;
  display: flex; /* Make elements display horizontally */
  justify-content: space-between; /* Align items horizontally */
  align-items: center; /* Align content vertically */
  padding: 50px 100px;
}

.logo {
  font-size: 20px; /* Adjust logo size */
  position: fixed;
  z-index: 100;
}
nav ul {
  /* Existing styles... */
  position: absolute; /* Make the list absolutely positioned */
  top: 5px; /* Position it at the top of the page */
  right: 30px; /* Position it at the right edge of the page */
  list-style: none; /* Remove bullet points */
  margin: 0; /* Remove default margin and padding */
  padding: 10px 20px; /* Add your desired padding */
    background-color: #f0f0f0;
 /* Optional background color for the list */
}
nav ul li {
  list-style: none; /* Remove bullet points */
  margin-left: 5px; 
  margin-right: 10px;
  display: inline-block;
}

nav ul li img{
  width: 69px;
  height: 70px;
  margin-right: 5px;
}
nav li a {
  nav li a {
  padding: 10px 20px;
  display: inline-block; /* Display list items horizontally */
  margin-right: 0; /* Add spacing between links */
  background-color: transparent;
  text-decoration: none;
  color: #ffffff;
  border: 1px solid red;  /* 1px width, solid style, red color */
}
}
.closet {
  color: #920000;
  text-align: left;
  font-family: "BungeeInline-Regular", sans-serif;
  font-size: 60px;
  font-weight: 400;
  position: absolute;
  left: 295px;
  top: 19px;
  -webkit-text-stroke: 1px #a27e00;
}
.conan3 {
  color: #920000;
  text-align: left;
  font-family: "BungeeInline-Regular", sans-serif;
  font-size: 80px;
  font-weight: 400;
  position: absolute;
  left: 0px;
  top: 0px;
  -webkit-text-stroke: 1px #a27e00;
}
</style>


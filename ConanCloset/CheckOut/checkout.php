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
    select,
    h1,
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
    }

    .payment-methods div {
      cursor: pointer;
      padding: 10px 20px;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    .payment-methods div.active {
      background-color: #eee;
    }
  </style>
  <title>Document</title>
</head>
  ?>

<body>
  <div class="check-out-page">
    <img class="kaitou-kid-1" src="kaitou-kid-10.png" />
    <div class="select-payment-method">Select Payment Method</div>
    <div class="payment-methods">
      <div class="credit-card" onclick="selectPaymentMethod(this)">
        <div class="credit-debit-cards">Credit/Debit Cards</div>
        <img class="_5-1" src="_5-10.png" />
      </div>
      <div class="stc-pay" onclick="selectPaymentMethod(this)">
        <div class="stc-pay2">STC Pay</div>
        <img class="stc-pay-1" src="stc-pay-10.png" />
      </div>
      <div class="ner-banking" onclick="selectPaymentMethod(this)">
        <div class="net-banking">Net Banking</div>
        <img class="chunk-museum" src="chunk-museum0.svg" />
      </div>
      <div class="cash" onclick="selectPaymentMethod(this)">
        <div class="cash-on-delivery">Cash on delivery</div>
        <img class="casw" src="casw0.svg" />
      </div>
    </div>
    <?php include("..\DHeader.php")?>
    <img class="image-3" src="image-30.png" />

    <div class="continue-button">
      <form method="POST" action="../CartPage/order.php" onsubmit="return handleCheckout()">
        <button name="order" id="order">Place Order</button>
     </form>
    </div>

     
 
</div>
  </div>

  <script>
    let selectedPaymentMethod = null;

    function selectPaymentMethod(element) {
      if (selectedPaymentMethod) {
        selectedPaymentMethod.classList.remove('active');
      }
      selectedPaymentMethod = element;
      selectedPaymentMethod.classList.add('active');
    }
      function handleCheckout() {
      const paymentMethod = selectedPaymentMethod;
     if (!paymentMethod) {
       alert("Please choose a payment method before placing your order.");
        return false; // Prevent form submission
      }
  // Form submission can proceed
  return true;
}

    

    
  </script>
</body>

</html>

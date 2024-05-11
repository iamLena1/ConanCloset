<?php

include("../include/header.php"); // Include header file (optional)
include("../Classes/connect.php"); // Include connection class

// Start a session if not already started
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Get product ID from the form submission
$product_id = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0; // Cast to integer and set default to 0

// Validate product ID
if ($product_id <= 0) {
  // Handle invalid product ID (e.g., display error message)
  echo "Invalid product ID.";
  exit;
}

// Check if product exists in database (optional)
$database = new Database();

$sql = "SELECT * FROM product WHERE Number = $product_id";
$product_data = $database->read($sql);

if ($product_data) {
  // Product exists, proceed with adding to cart
} else {
  // Handle non-existent product (e.g., display error message)
  echo "Product not found.";
  exit;
}

// If product is valid, add it to the cart session
if (true) { // Assuming validation passed above

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // Initialize cart session if it doesn't exist
  }

  $product_quantity = 1; // Assuming default quantity is 1

  // Check if product already exists in cart (optional)
  // If exists, update quantity

  // Add product to cart
  $_SESSION['cart'][$product_id] = $product_quantity;

  // Redirect to the cart page (or desired page)
  header("Location: cart.php");
  exit;
}



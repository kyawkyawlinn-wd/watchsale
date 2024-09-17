<?php

include 'conn.php';
include 'function.php';
if (!empty($_SESSION['user'])) {
  $user_name = $_SESSION['user'];
  $query = "select * from user where username='$user_name'";
  $go_query = mysqli_query($conn, $query);
  
  while ($out = mysqli_fetch_array($go_query)) {
      $user_name = $out['username'];
      $email = $out['email'];
     
  }
}
?>
<head>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" />
 <!-- font awsome cdn link -->
 <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
</head>
<style>
    .nav-link{
        font-size: 1.4rem;
        color: #000;
        transition: all 0.3s;
    }
    .nav-link:hover{
        color: #718355;
    }
    a span{
        color: #718355;
    }

    .home{
      color: #718355;
    }

</style>
<body>


<nav class="bg-white border-gray-200 dark:bg-gray-900 shadow-lg">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
   
        <img src="Photo/logo.png" class="h-11" alt="Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap">Timepieces Haven</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex items-center flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="index.php" class="nav-link block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page"><span class="home">Home</span></a>
        </li>
        <li>
          <a href="#" class="nav-link block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">About Us</a>
        </li>
        <li>
          <a href="product.php"  class="nav-link block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Products</a>
        </li>
        <li>
          <a href="cart.php" class="relative nav-link block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
          <svg class = "w-7 h-7 inline-block mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
          </svg>
          <?php
    $cartQuantity = 0; // Initialize cart quantity to zero
    
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
      foreach ($_SESSION['cart'] as $id => $qty) {
        $id = mysqli_real_escape_string($conn, $id);
        $result = mysqli_query($conn, "SELECT qty FROM product WHERE productid='$id'");

        if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $availableStock = $row['qty'];
          
          // Adjust the quantity if there is insufficient stock
          $quantity = ($qty > $availableStock) ? $availableStock : $qty;
          
          // Add the adjusted quantity to the cart quantity
          $cartQuantity += $quantity;
        }
      }
    }
    
    // Display the cart quantity with a red background if it's greater than zero
    if ($cartQuantity > 0) {
      echo '<span class="bg-red-500 text-white rounded-full px-2 py-1 text-xs absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2">' . $cartQuantity . '</span>';
    }
    ?>
          
          </a>
        </li>
        
        <li>
              <button type="button" class="ml-10 flex text-sm py-2 px-3" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
              <span class="sr-only">Open user menu</span> 
              <i class="fa-solid fa-circle-user fa-2xl"></i>
              <!-- bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 -->
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
              <div class="px-4 py-3">
                <span class="block text-sm text-gray-900 dark:text-white"><?php if(isset($user_name)){echo $user_name;}?></span>
                <span class="block text-sm  text-gray-500 truncate dark:text-gray-400"><?php if(isset($email)){echo $email;}?></span>
              </div>
              <ul class="py-2" aria-labelledby="user-menu-button">
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">My Orders</a>
                </li>
                
                <li>
                  <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                </li>
              </ul>
            </div>
            <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
              </svg>
          </button>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>



<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>


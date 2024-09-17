<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include 'conn.php';
include 'function.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Timepieces Haven</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" />
    <!-- custom css -->
    <link rel="stylesheet" href="css/indexstyle.css">
        <!-- font awsome cdn link -->
        <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
</head>

<body>
  <?php include 'header.php';?>
  
  <!-- Main Section starts -->
      <section class="main-content" id="main-content">
        <div class="container">
            <img class="bg" src="Photo/bg.jpg" alt="">
            <div class="bg-text">
                <h1 class="main-heading">Welcome to <span>Timepieces Haven</span></h1>
                <p class="bg-para">Indulge in the allure of luxury timepieces at Timepieces Haven. We meticulously curate an extensive collection of premium branded watches, offering you a gateway to the world's most renowned horological craftsmanship. Our passion lies in bringing together a diverse range of timepieces from esteemed watchmakers across the globe.</p>
                <div>
                    <a href="product.php" class="shop-btn">Shop Here</a>
                </div>
            </div>
        </div>
      </section>
<!-- Main Section ends -->

<!-- Secondary Section starts -->
      <section class="carousel-section" id="carousel-section">
          <h1 class="carousel-heading">Trending Items</h1>
          <div id="carousel-container">
            <div class="carousel-arrow arrow-left" onclick="prevCard()"><i class="fa-solid fa-caret-left"></i></div>
            <div id="card-carousel">
              <div class="card">
                <img
                  src="Photo/gshock1.jpg"
                  alt="Image 1"
                />
              </div>
              <div class="card">
                <img
                  src="Photo/omega4.jpg"
                  alt="Image 2"
                />
              
              </div>
              <div class="card">
                <img
                  src="Photo/omega9.jpeg"
                  alt="Image 3"
                />
              
              </div>
              <div class="card">
                <img
                  src="Photo/rolex7.jpg"
                  alt="Image 4"
                />
              
              </div>
              <div class="card">
                <img src="Photo/patekphilippe2.jpg" alt="Image 5" />
              </div>
            </div>
            <div class="carousel-arrow arrow-right" onclick="nextCard()"><i class="fa-solid fa-caret-right"></i></div>
          </div>
      </section>
<!-- Secondary section ends -->

<!-- Tertiary Section starts  -->
      <section class="section-step" id="section-step">
        <div class="container">
          <h3 class="sub-heading">
            <span>Timekeepers:</span> Where Luxury Meets Functionality
          </h3>
        </div>

        <div class="container grid grid--col--2 grid--center--v step-container">
          <!-- step one -->
          <div class="step-text-box">
            <h3 class="heading-tertiary">
                Timepieces That Reflect Your Personality
            </h3>
            <p class="step-description">
            At our watch shop, we believe that timepieces are more than just instruments for keeping track of time. They are reflections of your personality and style. Each watch in our collection has been carefully curated to offer a diverse range of designs, materials, and functionalities that cater to different tastes and preferences.
            </p>
          </div>
          <div class="step-img-box">
            <img
              src="Photo/pngwing.com.png"
              class="step-img"
              alt="iphone app preference selection screen"
            />
          </div>

          <!-- step two -->
          <div class="step-img-box">
            <img
              src="Photo/pngwing.com(1).png"
              class="step-img"
              alt="iphone app preference selection screen"
            />
          </div>
          <div class="step-text-box">
            <h3 class="heading-tertiary">Quality Watches for Every Occasion</h3>
            <p class="step-description">
            Visit our watch shop and explore our collection of quality watches that are designed to elevate your style and complement any occasion. We are confident that you'll find the ideal timepiece that combines functionality, durability, and undeniable style, allowing you to make a statement wherever you go.
            </p>
          </div>
        </div>
      </section>
      <!-- Tertiary Section ends -->

      <!-- Product Section starts -->
      <section class="products" id="products">
        <h1 class="heading">Latest Arrival</h1>

        <div class="box-container">
          <?php 
            $query = "SELECT * FROM product ORDER BY productid DESC LIMIT 4";
            $go_query = mysqli_query($conn, $query);

         
            while ($out = mysqli_fetch_array($go_query)) {
              $product_id = $out['productid'];
              $product_name = $out['productname'];
              $price = $out['price'];
              $photo = $out['photo'];
                  // Generate HTML markup for each product
                  echo '<div class="box">';
                  echo '<div class="image">';
                  echo '<img src="Photo/'.$photo.'"  />';
                  echo '<div class="icons">';
                  echo '<a href="addtocart.php?id='.$product_id.'" class="cart-btn">Add to Cart</a>';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="content">';
                  echo '<h3>'. $product_name .'</h3>';
                  echo '<div class="price">$<span>' . $price . '</span></div>';
                  echo '</div>';
                  echo '</div>';
              } 
              ?>
        </div>
        
      </section>
        <!-- Product section ends -->

        <!-- icons section starts -->
      <section class="icons-container">
        <div class="icons">
          <i class="fa-solid fa-truck"></i>
          <div class="info">
            <h3>free delivery</h3>
            <span>on all orders</span>
          </div>
        </div>

        <div class="icons">
          <i class="fa-solid fa-wallet"></i>
          <div class="info">
            <h3>10 days return</h3>
            <span>moneyback guarantee</span>
          </div>
        </div>

        <div class="icons">
          <i class="fa-solid fa-hand-holding-heart"></i>
          <div class="info">
            <h3>offer & gifts</h3>
            <span>on all orders</span>
          </div>
        </div>

        <div class="icons">
          <i class="fa-solid fa-credit-card"></i>
          <div class="info">
            <h3>secure payment</h3>
            <span>Payment protected</span>
          </div>
        </div>
      </section>
    <!-- icons section ends -->

      <!-- Section Feedback -->
      <section class="feedback">  
          <?php

        // feedback submitted
        function inputFeedback($feedback_text) {
          global $conn;
          $sql = "INSERT INTO feedback (feedback) VALUES ('$feedback_text')";

          if ($conn->query($sql) === TRUE) {
              return true; // Feedback added successfully
          } else {
              return "Error adding feedback: " . $conn->error;
          }
        }


        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            $feedback_text = $_POST['feedback_text'];
          $result = inputFeedback($feedback_text);

          if ($result === true) {
            $success_message = "Thank you for your feedback!";
            echo "<script>alert('$success_message');</script>";
          } else {
            $error_message = $result;
          }
        }


                  // if (isset($success_message)) {
                  //     echo "<p class='success'>$success_message</p>";
                  // }

                  // if (isset($error_message)) {
                  //     echo "<p class='error'>$error_message</p>";
                  // }

                
                  ?>
                <form class="feedback-form max-w-sm mx-auto" action="" method="post">
                  <label for="feedback_text" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Write your suggestion here</label>
                  <textarea name="feedback_text" id="feedback_text" rows="4" cols="10" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave a comment..."></textarea>
                  <button class="mt-3 feedback-btn">Submit</button>
                </form>
              
      </section>

      <section class="about-section" id="about-section">
        <h1 class="heading"><span>about</span> us</h1>

        <div class="row">
          <div class="video-container">
            <video src="vd/aboutus.mp4" loop autoplay muted></video>
          </div>

          <div class="content">
            <h3>why choose us?</h3>
            <p>
            At Timepieces Haven, we pride ourselves on being a premier destination for luxury timepieces. That's why we have curated an exceptional collection of luxury watches, combined with top-notch customer service, to provide you with an unparalleled shopping experience. 
            <br>
            We understand the importance of authenticity when it comes to luxury watches. We guarantee that all our watches are genuine and sourced directly from authorized dealers.
           
            </p>
            <p>
            We prioritize the security and convenience of our customers. Our website is designed with user-friendly features to make your browsing and shopping experience effortless. We use secure payment gateways to safeguard your financial information, ensuring that your transactions are protected.
            <br>
            Customer satisfaction is at the core of our business. We take pride in our reputation for providing exceptional service and exceeding customer expectations. We are dedicated to ensuring that you are delighted with your purchase and that your experience with us is nothing short of excellent.
          </p>           
          </div>
        </div>
      </section>

      <section class="footer-section" id="footer-section">
        <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
        <footer
          class="bg-neutral-200 text-center dark:bg-neutral-600 lg:text-left">
          <div class="p-4 text-center text-neutral-600 dark:text-neutral-200">
            © 2024 Copyright:
            <a
              class="text-neutral-500 dark:text-neutral-400"
              href="#"
              ><span>Timepieces Haven.</span></a
            > All rights reserved.
          </div>
        </footer>
      </section>
    
<script src="script/script.js"></script>

</body>
</html>

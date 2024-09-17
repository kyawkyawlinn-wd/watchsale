<?php 
session_start();
include 'conn.php';


if (!empty($_SESSION['user'])) {
    $user_name = $_SESSION['user'];
    $query = "select * from user where username='$user_name'";
    $go_query = mysqli_query($conn, $query);
    
    while ($out = mysqli_fetch_array($go_query)) {
        $user_id = $out['userid'];
        $user_name = $out['username'];
        $email = $out['email'];
        $phone = $out['phone'];
        $address = $out['address'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <style>

        body{
            background-color: #ebf2fa;
        }
        
        section{
            margin-top: 5rem;
        }

        .main-btn{
        background-color: #718355 !important;
        color: #fff !important;
        transition: all 0.3s;
        }
        .main-btn:hover{
            background-color: #adc178 !important;
            box-shadow: inset 0 0 1px #718355;
        }

        section{
            background-color: #ebf2fa;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Order</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" />
        <!-- font awsome cdn link -->
        <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
</head>
<body>
    <?php include 'header.php' ?>
<section>
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <div class="w-1/2 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                 Submit Your Order
              </h1>
              <form class="space-y-4 md:space-y-6" action="submit.php" method="post">

                    <div>
                      <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Username</label>
                      <input type="text" name="username" value="<?php if(isset($user_name)){echo $user_name;}?>"  id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Email</label>
                      <input type="email" name="email" value="<?php if(isset($email)){echo $email;}?>" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required="">
                  </div>
                  <div>
                      <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Phone Number</label>
                      <input type="text" name="phone" value="<?php if(isset($phone)){echo $phone;}?>" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <div>
                      <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Address</label>
                      <textarea name="address" id="address" col="5" row="5" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required=""><?php if(isset($address)){echo $address;}?></textarea>
                  </div>

                  <div>
                        <label for="payment_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Method</label>
                        <select name="payment_type" id="payment_type" class="form-select block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="visa">Visa Card</option>
                            <option value="master">Master Card</option>
                            <option value="credit">Credit Card</option>
                            <option value="paypal">Paypal</option>
                        </select>
                    </div>

                    <div>
                      <label for="cardno" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Card Number</label>
                      <input type="text" name="cardno" id="cardno" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>

                  <input type="hidden" value="<?php echo $user_id ?>" name="userid" />
                  <div class="flex justify-between">
                  <button href="show_success.php" type="submit" name="submit" class="main-btn w-full text-dark focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-md px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Submit</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>

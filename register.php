<?php
session_start();
include 'conn.php';
include 'function.php';

if (isset($_POST['register'])) //register button name
{
    $user_name = $_POST['username'];//textbox name
    $password = $_POST['password'];//textbox name
    $confirm_password = $_POST['confirmpassword'];//textbox name
    $email = $_POST['email'];//textbox name
    $phone = $_POST['phone'];//textbox name
    $address = $_POST['address'];//textbox name

    $errors = array(
        'username' => '',
        'password' => '',
        'confirm_password' => '',
        'match_password' => '',
        'email' => '',
        'phone' => '',
        'address' => '',
    );

    if (empty($user_name)) {
        $errors['username'] = 'User Name must be entered';
    } else {
        if (strlen($user_name) < 3) {
            $errors['username'] = 'User Name needs to be longer';
        }
    }

    if (empty($password)) {
        $errors['password'] = 'This field could not be empty';
    } else {
        if (strlen($password) < 3) {
            $errors['password'] = 'Password needs to be longer';
        }
    }

    if (empty($confirm_password)) {
        $errors['confirm_password'] = 'This Field could not be empty';
    } else {
        if ($password != $confirm_password) {
            $errors['match_password'] = 'Password Do not match';
        }
    }

    if (empty($email)) {
        $errors['email'] = 'This field could not be empty';
    }

    if (empty($phone)) {
        $errors['phone'] = 'This field could not be empty';
    }

    if (empty($address)) {
        $errors['address'] = 'This field could not be empty';
    }

    foreach ($errors as $key => $value) {
        if (empty($value)) {
            unset($errors[$key]);
        }
    }

    if (empty($errors)) {
        create_acc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>


    <style>

        body{
            background-color: #ebf2fa;
            font-family: 'Poppins', sans-serif;
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
            background-color: #ebf2fa !important;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" />
            <!-- font awsome cdn link -->
            <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
        <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<section class="bg-gray-50 dark:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <div class="w-1/2 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Create an account
              </h1>
              <form class="space-y-4 md:space-y-6" action="#" method="post">

                    <div>
                      <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Username</label>
                      <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Email</label>
                      <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <div>
                      <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                      <input type="password" name="confirmpassword" id="confirm-password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <div>
                      <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Phone Number</label>
                      <input type="text" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <div>
                      <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Address</label>
                      <textarea name="address" id="address" col="5" row="5" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required=""></textarea>
                  </div>

                  <button type="submit" name="register" class="main-btn w-full text-dark focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-md px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Register</button>
                  <p class="text-center text-md font-light text-gray-500 dark:text-gray-400">
                      Already have an account? <a href="login.php" class="font-medium text-dark-600 hover:underline dark:text-primary-500">Login here</a>
                  </p>
              </form>
          </div>
      </div>
  </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>

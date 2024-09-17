<?php 
session_start();
include 'conn.php';
include 'function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBWKktQdoPdOw2F1Wddc80ihUJq6Fm50nWNeySO9Niv6fNQhAT5j6trYKd0jJdu8i3X5a1XLQ0Hic6DZXV4v/bA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Products</title>
         <!-- font awsome cdn link -->
 <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <!-- custom css -->
    <link rel="stylesheet" href="css/productstyle.css">
</head>

<body class="p-8">
<?php include 'header1.php' ?>
<div class="mt-28 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
    <!-- Card 1 - Puma Shoes -->
    <div class="max-w-md mx-auto bg-white p-10 rounded-md overflow-hidden shadow-lg">
        <div class="prod-title">
            <p class="text-2xl uppercase text-gray-900 font-bold">Puma Shoes</p>
           
        </div>
        <div class="prod-img">
            <img src="https://unsplash.com/photos/IJjfPInzmdk/download?force=true&w=1920" class="w-full object-cover object-center" />
        </div>
        <div class="prod-info grid gap-10">
            
            <div class="flex flex-col md:flex-row justify-between items-center text-gray-900">
                <p class="font-bold text-xl">65 $</p>
                <button class="px-6 py-2 transition ease-in duration-200 rounded-full hover:bg-gray-800 hover:text-white border-2 border-gray-900 focus:outline-none">
                    <i class="fa-solid fa-cart-shopping"></i>
                </button>
            </div>
        </div>
    </div>


    <!-- Add more cards here... -->

</div>

</body>
</html>

<?php
session_start();
error_reporting(0);
//include 'function.php';
include 'conn.php';
$products = [];
if(!empty($_POST['search']))
{
    $search = $_POST['search'];
    //Select * from product WHERE productname LIKE '%$search%'
    $sql = "SELECT * FROM product ";
    $sql .= " WHERE catname LIKE '%$search%'";
    
}
$query = mysqli_query($conn,$sql);
$products = mysqli_fetch_all($query,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Products</title>
    <!-- tailwind css -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBWKktQdoPdOw2F1Wddc80ihUJq6Fm50nWNeySO9Niv6fNQhAT5j6trYKd0jJdu8i3X5a1XLQ0Hic6DZXV4v/bA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<style>
  * {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
html {
  scroll-behavior: smooth;
}

body {
  font-family: "Poppins", sans-serif;
  font-size: 1.2rem;
  line-height: 1.3;
  background-color: #ebf2fa;
  text-transform: capitalize;
}

.empty-search i{
    font-size: 6rem;
    display: flex;
    justify-content: center;
    color: #333;
}

.empty-search h2{
    font-size: 1.8rem;
    margin-top: 2.4rem;
}

.empty-search a{
    display: inline-block;

    text-decoration: none;
    padding: 10px 16px;
    margin-top: 1.6rem;
    font-size: 1.2rem;
    color: #fff;
    background-color: #718355;
    transition: all .3s ease-in-out;
    border-radius: 5px;
}

.empty-search a:hover{
    background-color: #adc178;
    box-shadow: inset 0 0 1px #718355;
}

.search-link{
    text-align: center;
}
</style>
<body>
   <?php include 'header1.php' ?> 
   <div class="mt-10 row">
   <?php if (empty($products)) : ?>
        <div class="empty-search">
            <i class="fa-solid fa-face-frown"></i>
            <h2 class="text-center">Sorry, we can't find the page you're looking for</h2>
            
            <div class="search-link">
            <a href="product.php">Explore Here</a>
            </div>
        </div>
    <?php else: ?>

    
    <div class="p-5 mt-10 grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($products as $product) :?>    
        <div class="max-w-md  mx-auto bg-white p-10 rounded-md overflow-hidden shadow-lg">
            <div class="prod-title">
                <p class="text-xl uppercase text-gray-900 font-bold"><?php echo $product['productname']; ?></p>
            </div>
            <div class="my-5 prod-img">
                <img src="Photo/<?php echo $product['photo']; ?>" class="w-full min-h-28 object-cover object-center" />
            </div>
            <div class="prod-info grid gap-10">
                <div class="flex flex-col md:flex-row justify-between items-center text-gray-900">
                    <p class="font-bold text-xl"><span>$</span><?php echo $product['price']; ?><i> (<?php echo $product['qty']; ?>)</i></p>
                    
                    <a href="addtocart.php?id=<?php echo $product['productid'] ?>" class="px-6 py-2 no-underline transition ease-in duration-200 rounded-full hover:bg-gray-800 hover:text-white border-2 border-gray-900 focus:outline-none">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
   </div>
  
</body>

</html>



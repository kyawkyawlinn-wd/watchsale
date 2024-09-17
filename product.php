<?php 
session_start();
include 'conn.php';
include 'function.php';

$getquery = "SELECT COUNT(*) AS total FROM product";
    $result = mysqli_query($conn, $getquery);
    $row = mysqli_fetch_assoc($result);
    $totalProducts = $row['total'];
    $perPage = 4;
    $totalPages = ceil($totalProducts / $perPage);
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($currentPage - 1) * $perPage;
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
    <!-- script -->
    <link rel="stylesheet" href="script/script.js">
</head>

<body>
<?php include 'header1.php' ?>

<div class="mt-5 p-5 min-h-32 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php 
            $query = "SELECT * FROM product ORDER BY productid LIMIT $offset, $perPage";
            $go_query = mysqli_query($conn, $query);

         
            while ($out = mysqli_fetch_array($go_query)) {
              $product_id = $out['productid'];
              $product_name = $out['productname'];
              $price = $out['price'];
              $photo = $out['photo'];
              echo '<div class="max-w-md mx-auto bg-white p-10 rounded-md overflow-hidden shadow-lg">';
              echo '<div class="prod-title">';
              echo '<p class="text-xl uppercase text-gray-900 font-bold">'.$product_name.'</p>';
              echo '</div>';
              echo '<div class="my-5 prod-img">';
              echo  '<img src="Photo/'.$photo.'" class="w-full h-64 object-cover object-center" />';
              echo '</div>';
              echo '<div class="prod-info grid gap-10">';
              echo '<div class="flex flex-col md:flex-row justify-between items-center text-gray-900">';
              echo '<p class="font-bold text-2xl"><span>$</span>'.$price.'</p>';
              echo '<a href="addtocart.php?id='.$product_id.'" class="px-6 py-2 no-underline transition ease-in duration-200 rounded-full hover:bg-gray-800 hover:text-white border-2 border-gray-900 focus:outline-none">';
              echo '<i class="fa-solid fa-cart-shopping"></i>';
              echo '</a>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
        }?>

    <!-- Add more cards here... -->
    <!-- <div class="flex justify-center col-span-2 mt-4"> -->
      <?php
        // for ($i = 1; $i <= $totalPages; $i++) {
        //   $isActive = ($i == $currentPage) ? 'bg-gray-900 text-white' : 'bg-gray-300 hover:bg-gray-400';
        //   echo '<a href="?page=' . $i . '" class="mx-1 px-3 py-2 rounded-md ' . $isActive . '">' . $i . '</a>';
        // }
      ?>
    <!-- </div> -->
</div>
<nav aria-label="Page navigation example">
  <ul class="list-style-none flex justify-center ">
    <?php if ($currentPage > 1) : ?>
      <li>
        <a href="product.php?page=<?php echo $currentPage - 1; ?>" class="relative block rounded bg-transparent px-3 py-1.5 text-md text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white">Previous</a>
      </li>
    <?php endif; ?>
    
    <?php for ($i = 1; $i <= $totalPages && $i <= 3; $i++) : ?>
      <li <?php if ($i == $currentPage) echo 'aria-current="page"'; ?>>
        <a href="product.php?page=<?php echo $i; ?>" class="relative block rounded bg-transparent px-3 py-1.5 text-md <?php if ($i == $currentPage) echo 'font-medium text-primary-700'; else echo 'text-neutral-600'; ?> transition-all duration-300 <?php if ($i != $currentPage) echo 'hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white'; ?>"><?php echo $i; ?></a>
      </li>
    <?php endfor; ?>
    
    <?php if ($currentPage < $totalPages) : ?>
      <li>
        <a href="product.php?page=<?php echo $currentPage + 1; ?>" class="relative block rounded bg-transparent px-3 py-1.5 text-md text-neutral-600 transition-all duration-300 hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white">Next</a>
      </li>
    <?php endif; ?>
  </ul>
</nav>
</body>
</html>

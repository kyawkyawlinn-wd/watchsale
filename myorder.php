<?php

session_start();
include 'conn.php';
$user_id = $_SESSION['userid'];

// Prepare the statement
$query = "SELECT * FROM orders WHERE customerid = ? ORDER BY orderid DESC";
if (!$query) {
    die("Error: " . mysqli_error($conn));
}
$stmt = mysqli_prepare($conn, $query);

// Bind the user ID parameter
mysqli_stmt_bind_param($stmt, "s", $user_id);

// Execute the query
mysqli_stmt_execute($stmt);

// Get the result set
$orders = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <!-- tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" />
</head>
<style>
    body{
        background-color: #ebf2fa;
    }
</style>
<body>
    <?php include 'header2.php' ?>

<div class="mt-6 px-7 relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                
                <th scope="col" class="px-6 py-3">
                    Order ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Product Name
                </th>

                <th scope="col" class="px-6 py-3">
                    Order Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Quantity
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                
                
            </tr>
        </thead>
        <tbody>
        <?php 
             
            while ($out = mysqli_fetch_array($orders)) {
                $orderid = $out['orderid'];
                $orderdate = $out['orderdate'];         
                $status=$out['status'];
              
                $order = mysqli_query($conn, "SELECT orderdetail.*, product.* FROM orderdetail LEFT JOIN product ON orderdetail.productid = product.productid WHERE orderdetail.orderid = '$orderid'"); 
                while ($row = mysqli_fetch_array($order)) {
                    
            ?>
                <tr class="border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <?php echo $row['orderid']; ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php echo $row['productname']; ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php echo $orderdate; ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php echo $row['productqty']; ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php echo $row['price']; ?>
                    </td>
                    <td class="px-6 py-4 <?php echo ($out['status'] === 1) ? 'text-green-500' : 'text-yellow-500'; ?>">
                        <?php echo ($out['status'] === 1) ? 'Delivered' : 'Pending'; ?>

                    </td>
                </tr>
            <?php 
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>


</body>
</html>
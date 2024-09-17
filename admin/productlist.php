<?php
session_start();
include 'conn.php';
include 'function.php';

if(isset($_GET['action'])&& $_GET['action']=='delete')
{
    del_product();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>
<style>
        body{
            background-color: #ebf2fa !important;
        }
        
        .main-btn{
            background-color: #718355 !important;
            color: #fff !important;
        }
        .main-btn:hover{
            background-color: #adc178 !important;
            border: 1px solid #718355;
        }
</style>
<body>
    <?php include 'header.php' ?>
    <div class="container Top">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="page-reader">
                        <h2>Welcome admin, 
                        <span class="text-danger">
                        <?php if(isset($_SESSION['admin']))
                        {echo $_SESSION['admin'];}
                        else{$_SESSION['admin']="";}
                        ?>
                        </span>
                    </h2>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-striped">
                        <tr>
                            <td colspan="7" align="left">
                                <a href="product.php" class="btn main-btn">
                                    Add Product
                                </a>
                            </td>
                        </tr>
                            <tr>
                                <th class="text-uppercase">Photo</th>
                                <th class="text-uppercase">ID</th>
                                <th class="text-uppercase">Name</th>
                                <th class="text-uppercase">Brand</th>
                                <th class="text-uppercase">Price</th>
                                <th class="text-uppercase">Qty</th>
                                <th class="text-uppercase">Action</th>
                            </tr>
                            <?php 
                            $query="select product.*,brand.* from product,brand where product.catid=brand.catid order by productid desc;";
                            $go_query=mysqli_query($conn,$query);
                            while($row=mysqli_fetch_array($go_query))
                            {
                                $product_id=$row['productid'];
                                $product_name=$row['productname'];
                                $cat_name=$row['catname'];
                                $price=$row['price'];
                                $qty=$row['qty'];
                                $photo=$row['photo'];
                                echo"<tr>";
                                echo"<td><img src='../Photo/{$photo}' width='100' height='100'></td>";
                                echo"<td>{$product_id}</td>";
                                echo"<td>{$product_name}</td>";
                                echo"<td>{$cat_name}</td>";
                                echo"<td>{$price}</td>";
                                echo"<td>{$qty}</td>";
                                echo"<td><a href='edit.php?action=edit&pid={$product_id}'class='btn btn-primary'>Edit</a>
                                <a href='productlist.php?action=delete&pid={$product_id}'class='btn btn-danger' onclick=\"return confirm('Are you sure?')\">Delete</a></td>";
                                echo "<tr>";
                            }
                            ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
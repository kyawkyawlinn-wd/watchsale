<?php
session_start();
include 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<style>
       .main-btn{
        background-color: #718355 !important;
        color: #fff !important;
        }
        .main-btn:hover{
            background-color: #adc178 !important;
            border: 1px solid #718355;
        }
    body{
        background-color: #ebf2fa !important;
    }
    .cardtap{
        display:block;
        cursor: pointer;
        text-decoration: none;
        color: #000;
        transition: all 0.3s;
    }

    .cardtap:hover{
        color: #808080;
    }
    .card{
        background-color: #DDE5B6 !important;
    }
</style>
<link rel="stylesheet" href="css/dashboardstyle.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
    <?php include 'header.php' ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>Welcome Admin,
                    <span class="text-danger">
                        <?php 
                        if(isset($_SESSION['admin']))
                        {echo $_SESSION['admin'];}
                        else{$_SESSION['admin']="";}
                        ?>
                    </span>
                </h2>
            </div>
        </div>
        <div id="main-content" class="container allContent-section py-4">
        <div class="row">
            <div class="col-sm-3">
                <a class="cardtap" href="userlist.php">
                    <div class="card">
                        <i class="fa fa-users  mb-2" style="font-size: 70px;"></i>
                        <h4 style="color:black;">Total Users</h4>
                        <h5 style="color:black;">
                        
                        <?php 
                            $total="select * from user";
                            $get_total=mysqli_query($conn,$total);
                            $num=mysqli_num_rows($get_total);
                            echo $num;
                        ?>
                        </h5>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">

            <a class="cardtap" href="brand.php">
                <div class="card">
                    <i class="fa fa-th-large mb-2" style="font-size: 70px;"></i>
                    <h4 style="color:black;">Total Brands</h4>
                    <h5 style="color:black;">
                    <?php 
                        $total="select * from brand";
                        $get_total=mysqli_query($conn,$total);
                        $num=mysqli_num_rows($get_total);
                        echo $num;
                    ?>
                   </h5>
                </div>
            </a>
            </div>
            <div class="col-sm-3">
                <a class="cardtap" href="productlist.php">
                    <div class="card">
                            <i class="fa fa-th mb-2" style="font-size: 70px;"></i>
                            <h4 style="color:black;">Total Products</h4>
                            <h5 style="color:black;">
                            <?php 
                                $total="select * from product";
                                $get_total=mysqli_query($conn,$total);
                                $num=mysqli_num_rows($get_total);
                                echo $num;
                            ?>
                        </h5>
                        </div>
                        </a>
            </div>
            <div class="col-sm-3">
                <a class="cardtap" href="ordermgmt.php">
                <div class="card">
                    <i class="fa fa-list mb-2" style="font-size: 70px;"></i>
                    <h4 style="color:black;">Total orders</h4>
                    <h5 style="color:black;">
                    <?php 
                        $total="select * from orders";
                        $get_total=mysqli_query($conn,$total);
                        $num=mysqli_num_rows($get_total);
                        echo $num;
                    ?>
                   </h5>
                </div>

                </a>
            </div>

            <div class="col-sm-3">
                <a class="cardtap" href="feedbacks.php">
                    <div class="card">
                            <i class="fa fa-th mb-2" style="font-size: 70px;"></i>
                            <h4 style="color:black;">Total Feedbacks</h4>
                            <h5 style="color:black;">
                            <?php 
                                $total="select * from feedback";
                                $get_total=mysqli_query($conn,$total);
                                $num=mysqli_num_rows($get_total);
                                echo $num;
                            ?>
                        </h5>
                        </div>
                        </a>
            </div>
        </div>
        
    </div>
       
    <div class="row mt-3">
            <div class="col-sm-12">
                <a href="product.php" class="btn main-btn">Add Product</a>
                <a href="user.php" class="btn main-btn">Add User</a>
            </div>

        </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</html>
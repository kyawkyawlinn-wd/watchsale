
<?php
session_start();
include 'conn.php';
include 'function.php';
if(isset($_POST['update_product']))//button name
{
    update_product();
}

if(isset($_GET['action']) && $_GET['action'] == 'edit'){
    $pid = $_GET['pid'];
    $query = "select * from product where productid = '$pid'";
    $go_query = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($go_query)){
        $product_id = $row['productid'];
        $product_name = $row['productname'];
        $product_cat_id = $row['catid'];
        $price = $row['price'];
        $qty = $row['qty'];
        $photo = $row['photo'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit</title>
    <style>
        body{
            background-color: #ebf2fa !important;
        }
        .card{
            background-color: #DDE5B6 !important;
           

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
</head>
<body>
    <?php include 'header.php'?>
    <div class="container mb-5 mt-4">
        <div class="row mb-3">
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
        <div class="card mx-auto p-4" style="width: 500px;">
            <div class="card-header">
                <h4 class="card-title text-center">Update Product</h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <!-- Product Name -->
                    <div class="form-group">
                        <label for="productName">Product Name:</label>
                        <input type="text" name="productname" class="form-control" id="productName" value="<?php echo $product_name?>">
                    </div>
    
                    <!-- Category Name Dropdown -->
                    <div class="form-group">
                        <label for="categoryName">Brand Name:</label>
                        <select class="form-control" id="categoryName" name="category">
                            <option value="" disabled selected>Select Brand Names</option>
                            <?php
                            $query="Select * from brand";
                            $go_query=mysqli_query($conn,$query);
                            while($row=mysqli_fetch_array($go_query))
                            {
                                $catid=$row['catid'];
                                $catname=$row['catname'];
                                if($product_cat_id == $catid)
                                {
                                    echo"<option value={$catid} selected>{$catname}</option>";
                                } else{
                                    echo"<option value={$catid}>{$catname}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
    
                    <!-- Price -->
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" id="price" name="price" value="<?php echo $price ?>">
                    </div>
    
                    <!-- Quantity -->
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="text" class="form-control" id="quantity" name="qty" value="<?php echo $qty ?>">
                    </div>
    
                    <!-- File Input -->
                    <div class="form-group">
                        <label for="fileInput">Upload Product Image:</label>
                        <input type="file" class="form-control-file" id="fileInput" name="photo" value="<?php echo $photo?>">
                        <img src="../Photo/<?php echo $photo ?>" width="100" height="100" alt="">
                    </div>
    
                    <!-- Submit Button -->
                    <button type="submit" name="update_product" class="mt-3 btn main-btn btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    </body>
    </html>
</body>
</html>
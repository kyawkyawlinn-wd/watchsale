<?php
session_start();
include 'conn.php';
include 'function.php';
//Add Button
if(isset($_POST['btncategory']))
{
    insert_category();
}
//Delete Category
if(isset($_GET['action'])&& $_GET['action']=='delete')
{
    delcat();
}
//Delete Button
if(isset($_POST['btnupcat']))
{
    updatecategory();
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<body>
    <?php include 'header.php' ?>
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <h3>Welcome Admin,
                    <span class="text-danger">
                    <?php 
                            if(isset($_SESSION['admin']))
                            {echo $_SESSION['admin'];}
                            else{$_SESSION['admin']="";}
                            ?>
                    </span>
                </h3>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-6" style="width: 30%;">
                <form action="" method="post">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Add Brand</label>
                        <input type="text" name="category" class="form-control">
                    </div>
                    <div>
                        <button class="btn main-btn" type="submit" name="btncategory">Add Brand Name</button>
                    </div>
                </form>
                <hr>

                <?php
                if(isset($_GET['action']) && $_GET['action']=='edit')
                {
                    $cat_id=$_GET['cid'];
                    $query="Select * from brand where catid='$cat_id'";
                    $go_query=mysqli_query($conn,$query);
                    while($out=mysqli_fetch_array($go_query))
                    {
                        $catname=$out['catname'];                   
                
            ?>


                
                <form action="" method="post">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Update Brand Name</label>
                        <input type="text" name="catname" class="form-control" value="<?php echo $catname ?>">
                    </div>
                    <div>
                        <button class="btn main-btn" type="submit" name="btnupcat">Update Brand Name</button>
                    </div>
                </form>
                <?php
                }
                }
                ?>
            </div>
                <div class="col-md-6">
                    <table class="table table-hover mr-5">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $query="Select * from brand";
                        $go_query=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_array($go_query))
                        {
                            $catid=$row['catid'];
                            $catname=$row['catname'];
                            echo"<tr>";
                            echo"<td>{$catid}</td>";
                            echo"<td>{$catname}</td>";
                            echo"<td><a href='brand.php?action=delete&cid={$catid}' class='btn btn-danger'>Delete</a>
                            <a href='brand.php?action=edit&cid={$catid}'class='btn btn-primary'>Edit</a></td>";
                            echo"</tr>";
                        }
                        ?>
                    </table>
                </div>
        </div>

    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>



</html>
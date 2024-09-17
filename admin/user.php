<?php
include 'conn.php';
include 'function.php';
if(isset($_POST['adduser']))
{
    adduser();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>
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

        .input-box{
            position: relative;
        }
        .input-box input{
            padding-left: 30px;
        }
        .user-icon{
            font-size: 1.2rem;         
            position: absolute;
            top: 71%;
            left: 5px;       
            transform: translateY(-50%);
            color: #999;
            pointer-events: none;
        }
</style>
<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<body>
    <?php include 'header.php' ?>
    <div class="container">
        
        <div class="row mt-5">
            
                <div class="col-md-6 offset-3">
                    <div class="card p-4">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="input-box mb-3">                            
                                <label class="form-label">User Name</label>        
                                <ion-icon class="user-icon" name="contact"></ion-icon>                    
                                <input type="text" name="username" id="" placeholder="Please Enter Username" class="form-control" required>
                                
                            </div>
                            <div class="input-box mb-3">
                                <label class="form-label">Password</label>
                                <ion-icon class="user-icon" name="lock"></ion-icon>
                                <input type="password" name="password" id="" placeholder="Please Enter Password" class="form-control" required>
                               
                            </div>
                            
                            <div class="input-box mb-3">
                                <label class="form-label">Confirm Password</label>
                                <ion-icon class="user-icon" name="lock"></ion-icon>
                                <input type="password" name="cpassword" placeholder="Please Confirm Password" id="" class="form-control" required>
                                
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">User Type</label>
                                <select name="usertype" id="" value="Select User Type" class="form-control">
                                    
                                    <option value="admin">Admin</option>
                                   
                                </select>
                            </div>

                            <div class="mb-3 d-grid mt-5">
                                <input type="submit" value="Add User" name="adduser" class="btn main-btn">
                            </div>
                        </form>             
                        
                    </div>
                    </div>
            </div>   
        </div>

    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>



</html>
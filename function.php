<?php
function adminlogin(){ 

    global $conn; 
    $name=$_POST['username']; 
    $password=$_POST['password']; 
    $hpass=md5($password); 
    $query="Select * from user"; 
    $go_query=mysqli_query($conn,$query); 
    while($out=mysqli_fetch_array($go_query)) 
    { 
       $db_user_name=$out['username']; 
        $db_password=$out['password']; 
        $db_user_role=$out['role']; 
        if($db_user_name==$name && $db_password==$hpass && $db_user_role=='admin') 
        { 
            $_SESSION['admin']=$name; 
            header('location:dashboard.php'); 
        } 
        else 
        { 
            echo "<script>window.alert('Invalid Admin Name and Password')</script>"; 
            echo "<script>window.location.href='index.php'</script>"; 
        } 
    } 
} 

function insert_category(){ 
    global $conn; 
    global $msg; 
    $catname=$_POST['category']; 
    if($catname=="") 
    { 
        echo "<script>window.alert('Please Insert Brand Name')</script>"; 
    } 
    elseif($catname!="") 
    { 
        $query="Select * from brand where catname='$catname'"; 
        $ch_query=mysqli_query($conn,$query); 
        $count=mysqli_num_rows($ch_query); 
        if($count>0) 
        { 
            echo "<script>window.alert('This record is already existed.')</script>"; 
        } 
        else 
        { 
            $query="insert into brand(catname)values('$catname')"; 
            $go_query=mysqli_query($conn,$query); 
            if(!$go_query) 
            { 
               die("QUERY FAILED".mysqli_error($conn)); 
            } 
            else 
            { 
                echo "<script>window.alert('Saved Successfully')</script>"; 
            }
        } 
    } 
} 

function updatecategory(){ 

    global $conn; 

    $catname=$_POST['catname']; 

    $catid=$_GET['cid']; 

    $query="update brand set catname='$catname' where catid='$catid'"; 

    $go_query=mysqli_query($conn,$query); 

    if(!$go_query){ 

        die("QUERY FAILED".mysqli_error($conn)); 

    } 

    header("location:brand.php"); 

} 

function delcat(){ 

    global $conn; 

    $catid=$_GET['cid']; 

    $query="delete from brand where catid='$catid'"; 

    $go_query=mysqli_query($conn,$query); 

    header("location:brand.php"); 

} 

function adduser() 

{ 

    global $conn; 

    $username=$_POST['username']; 

    //check password match (start) 

    $password=$_POST['password']; 

    $confirmpassword=$_POST['cpassword']; 

    if($password!=$confirmpassword) 

    { 

        echo "<script>window.alert('Password and Confirm Password must be the same')</script>"; 

        //check password match (end) 

    } 

     

    // check record duplicate (start) 

    else if($password!="" && $username!="") 

    { 

        $query="Select * from user where username='$username' and password='$password'"; 

        $ch_query=mysqli_query($conn,$query); 

        $count=mysqli_num_rows($ch_query); 

        if($count>0) 

        { 

            echo "<script>winddow.alert('Username & Password already exist!')</script>";  

        } 

         

        // check record duplicate (end) 

        else 

        //insert record user table 

        { 

            $hashvalue=md5($password); 

            $user_role=$_POST['usertype']; 

            $query="insert into user(username,password,role)values('$username','$hashvalue','$user_role')"; 

            $go_query=mysqli_query($conn,$query); 

            if(!$go_query) 

            { 

                die("QUERY FAILED ".mysqli_error($conn)); 

            } 

            header("location:userlist.php"); 

             

        } 

         

    } 

} 

function deluser() 

{ 

    global $conn; 

    $uid=$_GET['id']; 

    $query="delete from user where userid='$uid'"; 

    $go_query=mysqli_query($conn,$query); 

    header("location:userlist.php"); 

} 

function addproduct()
{
    global $conn;
    $productname=$_POST['productname'];
    $categoryid=$_POST['category'];
    $price=$_POST['price'];
    $quantity=$_POST['qty'];
    $photo=$_FILES['photo']['name'];
    if(is_numeric($price)==false)
    {
        echo "<script>window.alert('Please Enter a numeric value')</script>";
    }
    elseif(is_numeric($quantity)==false)
    {
        echo "<script>window.alert('Please Enter a numeric value')</script>";
    }
    elseif($photo=="")
    {
        echo "<script>window.alert('Choose Product Images')</script>";
    }
    elseif($productname!="" && $photo!="")
    {
        $query="Select * from product where productname='$productname'";
        $ch_query=mysqli_query($conn,$query);
        $count=mysqli_num_rows($ch_query);
        if($count>0)
        {
            echo"<script>window.alert('This product is already existed')</script>";
        }
        else
        {
            $query="insert into product(productname,catid,price,qty,photo) values('$productname','$categoryid','$price','$quantity','$photo')";
            $go_query=mysqli_query($conn,$query);
            if(!$go_query)
            {
                die("QUERY FAILED".mysqli_error($conn));
            }
            else
            {
                move_uploaded_file($_FILES['photo']['tmp_name'],'../Photo/'.$photo);
                header("location:productlist.php");
            }
        }
    }
}

function del_product()
{
    global $conn;
    $pid=$_GET['pid'];
    $query="Delete from product where productid='$pid' ";
    $go_query=mysqli_query($conn,$query);
    header("location:productlist.php");
}
function update_product()
{
    global $conn;
    $pid=$_GET['pid'];
    $productname=$_POST['productname'];
    $categoryid=$_POST['category'];
    $price=$_POST['price'];
    $quantity=$_POST['qty'];
    $photo=$_FILES['photo']['name'];
    if(!$photo)
    {
        $query="update product set productname='$productname',catid='$categoryid',price='$price',qty='$quantity' where productid='$pid'";
    }
    else
    {
        $query="update product set productname='$productname',catid='$categoryid',price='$price',qty='$quantity',photo='$photo' where productid='$pid'";
    }
    $go_query=mysqli_query($conn,$query);
    if(!$go_query)
    {
        die("QUERY FAILED".mysqli_error($conn));
    }
    else
    {
        move_uploaded_file($_FILES['photo']['tmp_name'],'../Photo/'.$photo);
    }
    header("location:productlist.php");
}


// function show_result()
// {
//     global $conn;
//    $data =$_POST['search'];
//    $query="Select * from product where productname LIKE '%$data%'";
//    $go_query=mysqli_query($conn,$query);
//    $count_result=mysqli_num_rows($go_query);
//    print-r($count_result);
//    dd();
//    if($count_result==0)
//    {
//     echo '<div class="blockquote">Sorry, No result found!<a href="index.php">Back</a></div>';
//    }
//    elseif($count_result>0)
//    {
//     while($out=mysqli_fetch_array($go_query))
//     {
//         $productid=$out['productid'];
//         $productname=$out['productname'];
//         $categoryid=$out['catid'];
//         $price=$out['price'];
//         $qty=$out['qty'];
//         $photo=$out['photo'];
      
//         $display='<div class="col-md-4 col-sm-4">';
//         $display.='<div class="card" height="300px">';
//         $display.='<img src="Photo/{$photo}" class="card-img-top">';
//         $display.='<div class="card-body">';
//         $display.='<h3>{$productname}</h3>';
//         $display.='<p>{$price}</p>';
//         $display.='<p class="text-center"><a href="addtocart.php?id='.$productid.'" class="btn btn-info">Add to Cart</a></p>';
//         $display.='</div></div></div>';
//         echo $display;
//     }
//    }

// }
function create_acc(){
    global $conn;
    global $user_name;
    global $password;
    global $email;
    global $phone;
    global $address;

    $hpass=md5($password);
    $query="select * from user where username='$user_name' and password='$hpass'";
    $user_query=mysqli_query($conn,$query);
    $count=mysqli_num_rows($user_query);
      if($count>0)
        {
          echo "<script>window.alert('already exists')</script>";
        }
        else
        {
          $query="insert into user (username,password,email,phone,address,role)";
          $query.="values ('$user_name','$hpass','$email','$phone','$address','user')";
          $go_query=mysqli_query($conn,$query);
            if(!$go_query)
            {
              die("QUERY FAILED".mysqli_error($conn));
            }
            else
                    {
                        echo "<script>window.alert('you successfully created an account')</script>";
                    }
              }
}
?>

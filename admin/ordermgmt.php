<?php
session_start();
global $conn;
include('conn.php');
include('function.php');
$orders=mysqli_query($conn,"select * from orders order by orderid desc");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../asset/bootstrap.css"/>
	<script type="text/javascript" src="../asset/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="../asset/bootstrap.js"></script>
	<title>Order Manangement</title>
</head>
<style>
	body{
		background-color: #ebf2fa !important;
	}
</style>
<body>
	<?php
	include('header.php');
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
					<div class="row">
						<div class="page-header">
							<h2>Welcome to admin,
								<span class="text-danger">
								
								<?php
								if(isset($_SESSION['admin'])){
									echo $_SESSION['admin'];
									
								}
								else{
									$_SESSION['admin']='';
								}
								?></span>
							</h2>
						</div>
					</div>
					<div class="row">
						<table  border="0" class="table table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>Customer Name</th>
									<th>Phone</th>
									<th width="20%">Delivery Address</th>
									<th width="30%">Item(s)</th>
									<th>Ordered_Date</th>
									<th>Sent_Date</th>
									<th>Action</th>
								</tr>
							</thead>
									<?php while($out=mysqli_fetch_array($orders)){
										$check=$out['status'];
										{
											if($check>0){
												$show='<tr class="mark">';
												}
												else
												{
												$show='<tr>';
												}
												$show.='<td>'.$out['orderid'].'</td>';
												$show.='<td>'.$out['deliveryname'].'</td>';
												$show.='<td>'.$out['deliveryphone'].'</td>';
												$show.='<td>'.$out['deliveryaddress'].'</td>';
												$show.='<td>';
												$orderid=$out['orderid'];
												$order=mysqli_query($conn,"SELECT orderdetail.*,product.* from orderdetail left join product on orderdetail.productid=product.productid where orderdetail.orderid='$orderid'");
												while($row=mysqli_fetch_assoc($order)){
													$show.='<ul><li>'.$row['productname'].'<span style="color:red;">
														['.$row['productqty'].']</span></li></ul>';}
														$show.='</td>';
														$show.='<td>'.$out['orderdate'].'</td>';
														
														$chesec=$out['status'];
														if($chesec>0)
														{$show.='<td>'.$out['senddate'].'</td>';}
														else{
															$show.='<td>----/--/--</td>';}
															
															if($out['status']){
																$show.='<td><a href="status.php?id='.$out['orderid'].'&status=0" class="btn btn-danger">
																	Undo</a></td>';}
																	else
																	{ $show.='<td><a href="status.php?id='.$out['orderid'].'&status=1" class="btn btn-success">
																		Mark as Delivered</a></td>';}
																		$show.='</tr>';
																		echo $show; 
																	}
																	}									
																	?>	
						</table>
					</div>
		</div>
	</div>
</body>
</html>
														
<?php
include_once("conf/loadconfig.inc.php"); 
session_start();
	extract($_POST);
	extract($_GET);
	$obj_product = new Photomanager();
$currentTimestamp = getCurrentTimestamp();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Photo Print Studio | Cart</title>
<?php 
		include('includes/common_css.php');
		include('includes/header.php');
?>
 
<div class="cp-inner-banner">
<div class="container">
<div class="cp-inner-banner-outer">
<h2>Order Detail</h2>
 
<!--<ul class="breadcrumb">
<li><a href="index.html">Home</a></li>
<li class="active">Order Detail</li>
</ul> -->
</div>
</div>
</div>
 
 
<div class="cp-main-content">
 
<section class="cp-signup-section pd-tb60">
<div class="container">

<?php
$orderdetail = $obj_product->getMyOrderSingle($orderid, $_SESSION['userId']);
$productType = $orderdetail->productType;
$productPreOrderId = $orderdetail->productPreOrderId;
$productFreeOrderId = $orderdetail->productFreeOrderId;

if($productType == "paid")
{
	$orderdata = $obj_product->getPaidOrderDetails($orderid, $_SESSION['userId']);
	$printingPhotos = $obj_product->getAllPremiumPrintPhoto($productPreOrderId);
}
else
{
	$orderdata = $obj_product->getFreeOrderDetails($orderid, $_SESSION['userId']);
	$printingPhotos = $obj_product->getAllFreePrintPhoto($productFreeOrderId);
}


	$productTitle = $orderdata->productTitle;
	
	$final_order_id = $orderdata->final_order_id;
	
	$productImage = $orderdata->productImage;
	$productSize = $orderdata->productSize;
	$no_of_photos = $orderdata->no_of_photos;
	$upload_no_photo = $orderdata->upload_no_photo;
	$orderDate = $orderdata->orderDate;
	$productType = $orderdata->productType;
	$printPrice = $orderdata->printPrice;
	$printTotalPrice = $orderdata->printTotalPrice;
	$printPhotoId = $orderdata->printPhotoId;
	
	$createDate = new DateTime($orderDate);
	$strip = $createDate->format('M d,Y');


?>

<?php
if($orderdata!=''){ ?>
<div class="col-md-12">
<center><h2><?=$productTitle?> (<?=$productType?>)</h2></center>
<div class="clearfix">&nbsp;</div>
<div class="clearfix">&nbsp;</div>
	<div class="col-md-4">
        <img src="<?=DEFAULT_URL?>/userfiles/product_img/<?=$productImage;?>" width="400px" height="250px" />
    </div>
    <div class="col-md-1">
     &nbsp;
     </div>
    <div class="col-md-6">
    	<div class="table-responsive">
            <table class="table" style="border: 1px solid #eee;">
            	<tr>
                	<td><h4>No Of Photos</h4></td>
                    <td><?=$no_of_photos?> Photos</td>
                </tr>
                <tr>
                	<td><h4>Uploaded Photos</h4></td>
                    <td><?=$upload_no_photo?> Photos</td>
                </tr>
                <?php
				if($printPrice != "")
				{
				?>
                <tr>
                	<td><h4>Price for 1 Sheet</h4></td>
                    <td>Rs. <?=$printPrice?></td>
                </tr>
                <?php
				}
				if($printTotalPrice != "")
				{
				?>
                <tr>
                	<td><h4>Total Price</h4></td>
                    <td>Rs. <?=$printTotalPrice?></td>
                </tr>
                <?php
				}
				?>
                 <tr>
                	<td><h4>Order Date</h4></td>
                    <td><?=$strip?></td>
                </tr>
                 <tr>
                	<td><h4>Order No.</h4></td>
                    <td><?=$final_order_id?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <div class="clearfix">&nbsp;</div>
   <?php 
  			$count = $db->numRows($printingPhotos);
			 if($db->numRows($printingPhotos)>0){
				 $i=1;
				 while($photosUploadedData = $db->fetchNextObject($printingPhotos)) {
					 if($productType == "paid")
						{
						 	$photoName = $photosUploadedData->premiumPhotoName;
						 
						 	$upload_server=$photosUploadedData->upload_server;
							
							if ($upload_server=='our') {
								$photoName = DEFAULT_URL.'/uploads/'.$photoName;
							}else if($upload_server=='s3'){
								$photoName =S3_URL.$photoName;
							}else{
								$photoName =$photoName;
							}
						}
						else
						{
						$photoName = $photosUploadedData->freePhotoName;
						
							$upload_server=$photosUploadedData->upload_server;
							
							if ($upload_server=='our') {
								$photoName = DEFAULT_URL.'/uploads/'.$photoName;
							}else if($upload_server=='s3'){
								$photoName =S3_URL.$photoName;
							}else{
								$photoName =$photoName;
							}
						}
					 	

							
					 ?>
            <div class="col-md-3">
              <div class="control-group">
                <label class="control-label">Print photo <?=$i;?></label>
                <div class="controls">
                     <img width="300" height="300" src="<?=$photoName?>" alt="" class="img-thumbnail printingPhotoOrder">
                      </div>
              </div>
            </div>
            
                     <?php
					 $i++;
				 }
				 
			 }
			 ?>  
             
             
             
    
    
</div>
<?php }else{ ?>
	<div class="col-md-12">
		<center><h2>no Record Found !</h2></center>
	</div>
 <?php }

?>







<div class="table-responsive">
<table class="table">
   <tr>
  	<td colspan="4"><h3>SHOP PRODUCTS YOU MAY LIKE:</h3></td>
  </tr>
  <tr>
    <td colspan="4">
    	<ul class="peoplelikeproduct">
        	<li class="col-lg-3">
            	<img src="<?=DEFAULT_URL?>/images/ex5.jpg" alt="" class="img-responsive"><p>Brass geo stands <br>$60 - <a href="#">info</a></p>
            </li>
            <li class="col-lg-3">
            	<img src="<?=DEFAULT_URL?>/images/ex2.jpg" alt="" class="img-responsive"><p>Brass geo stands <br>$60 - <a href="#">info</a></p>
            </li>
            <li class="col-lg-3">
            	<img src="<?=DEFAULT_URL?>/images/ex3.jpg" alt="" class="img-responsive"><p>Brass geo stands <br>$60 - <a href="#">info</a></p>
            </li>
            <li class="col-lg-3">
            	<img src="<?=DEFAULT_URL?>/images/ex4.jpg" alt="" class="img-responsive"><p>Brass geo stands <br>$60 - <a href="#">info</a></p>
            </li>
        </ul>
    </td>
    
  </tr>
  
</table>
</div>




</div>
</section> 
</div>
 
 <?php
	include('includes/footer.php');
	include('includes/common_js.php');
?>
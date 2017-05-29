<?php
include_once("conf/loadconfig.inc.php"); 
$obj_product = new Photomanager();
$obj_users = new Usermanager();
$currentTimestamp = getCurrentTimestamp();
// print_r($_SESSION); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Printmysnap - Free Photos for Lifetime | Checkout</title>
<?php 
		include('includes/common_css.php');
		include('includes/header.php');
?>
<div class="cp-inner-banner">
<div class="container">
<div class="cp-inner-banner-outer">
<h2>REVIEW & PAY</h2>
<ul class="breadcrumb">
<li><a href="index.html">Home</a></li>
<li class="active">Payment</li>
</ul> 
</div>
</div>
</div>
<div class="cp-main-content">
<section class="cp-signup-section pd-tb60">
<div class="container">
	<div class="col-lg-3"></div>
    <div class="col-lg-6">
    
	<?php
		$guestUserId = $_SESSION['guestUserId'];
		if($_SESSION['userId']== ""){ 
			$userDetail = $obj_users->get_user_by_guestid($guestUserId);
			$userId = $userDetail->userId;
		} else {
			$userId = $_SESSION['userId'];	 
		}
//$userId;
//echo $userId;
if($_SESSION['userId'] == "" && !isset($_SESSION['userId'])){
	$paymentDetail = $obj_product->getPaymentPageDetailGuest($userId);	
} else {
	$paymentDetail = $obj_product->getPaymentPageDetail($userId);
}
if($db->numRows($paymentDetail) > 0)
		{   
		   	$cartId='';
			$i =1;
			while($paymentData = $db->fetchNextObject($paymentDetail)){
				//$freePhotoOrderId=$paymentData->freePhotoOrderId;
				//$premiumPhotoOrderId=$paymentData->premiumPhotoOrderId;
				
				$premiumdetail = $obj_product->getPremiumPhotoOrderDetails($paymentData->premiumPhotoOrderId);
				$proFinishing .= $premiumdetail->proFinishing.",";
				
				 $cart_id_final=$cartId=$paymentData->checkoutcartId;
				
				 $checkoutId =$paymentData->checkout_Id;
				
				$cart_id=explode(',', $cart_id_final);
				$total_cart_item=count(explode(',', $cart_id_final));
				
				for($i=0;$i<$total_cart_item;$i++){

					$cart_item_Detail = $obj_product->getCartDetails($cart_id[$i]);
				?>
                <div class="col-md-12">
                	<div class="table-responsive">
                        <table class="table" style="border: 1px solid #eee;">
                            <tbody>
                            <tr>
                            	<td>S.no.</td>
                                <td><?=$i+1?>.</td>
                            </tr>
                            <tr>
                                <td><h4>Product Title</h4></td>
                                <td><h4><?=$cart_item_Detail->productTitle?></h4></td>
                            </tr>
                            <tr>
                                <td><h4>Product Price</h4></td>
                                <td><h4><?=$cart_item_Detail->printPrice?></h4></td>
                            </tr>
                            <tr>
                                <td><h4>Product Plan</h4></td>
                                <td><h4><?=$cart_item_Detail->plan?></h4></td>
                            </tr>
                            <tr>
                                <td><h4>Number of Photos</h4></td>
                                <td><h4><?=$cart_item_Detail->no_of_photos?> photos</h4></td>
                            </tr>
                            <tr>
                                <td><h4>Uploaded no of Photos</h4></td>
                                <td><h4><?=$cart_item_Detail->uploaded_no_photos?> photos</h4></td>
                            </tr>
                        </tbody></table>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
              <?php 
			  	
				$cartId .=$cart_item_Detail->cartId.",";
				$premiumPhotoOrderId .=$cart_item_Detail->premiumPhotoOrderId.",";
				$freePhotoOrderId.=$cart_item_Detail->freePhotoOrderId.",";
				$uploaded_no_photos .=$cart_item_Detail->uploaded_no_photos.",";
				$productType .= $cart_item_Detail->plan.",";
				$productId .= $cart_item_Detail->productId.",";
				$productSizeId .=$cart_item_Detail->productSizeId.",";
			  
			   } ?>
                <?php

				$i++;
			}
			 $cartId = rtrim($cart_id_final,',');
			 $productSizeId = rtrim($productSizeId,',');
			 $premiumPhotoOrderId = rtrim($premiumPhotoOrderId,',');
			 $freePhotoOrderId = rtrim($freePhotoOrderId,',');
			 $uploaded_no_photos = rtrim($uploaded_no_photos,',');
			 $productType =  rtrim($productType,',');
			 $productId =  rtrim($productId,',');
			 $proFinishing = rtrim($proFinishing,',');
			//echo $proFinishing;

			?>
            <div class="clearfix">&nbsp;</div>
            <a class="read-more" href="javascript:void(0)" data-cartId="<?=$cartId?>" data-preorderId="<?=$premiumPhotoOrderId?>" data-freeorderId="<?=$freePhotoOrderId?>" dataprSizeid="<?=$productSizeId?>" data-userId="<?=$userId?>" data-uploadno="<?=$uploaded_no_photos?>" data-productType="<?=$productType?>" data-productId="<?=$productId?>" data-profinishing="<?=$proFinishing?>" data-checkoutId="<?=$checkoutId?>" id="paymentSuccess">Payment</a>
            <?php
		}
	
		?>
        
         
        
    </div>
    <div class="col-lg-3"></div>

</div>
</section> 
</div>
<style>
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
    border-right: 1px solid #ddd;
}
</style>
 
 <?php
	include('includes/footer.php');
	include('includes/common_js.php');
	//include('checkout-script.php');
	
?>
<script>
$(document).on('click','#paymentSuccess',function(){
	//$('.preloader').css('display','block');
	var cartId = $(this).attr('data-cartId');
	var final_checkoutId= $(this).attr('data-checkoutId');
	var premiumOrderId = $(this).attr('data-preorderId');
	var freeOrderId = $(this).attr('data-freeorderId');
	var userId = $(this).attr('data-userId');
	var uploaded_no_photos =$(this).attr('data-uploadno');
	var productType = $(this).attr('data-productType');
	var productId = $(this).attr('data-productId');
	var productSizeId = $(this).attr('dataprSizeid');
	var profinishing = $(this).attr('data-profinishing');
	

	$.ajax({
         
		type: "POST",
		url: "<?=DEFAULT_URL?>/success-ajax.php",
		data: {action:"updateAllStatus",cartId:cartId,premiumOrderId:premiumOrderId,freeOrderId:freeOrderId,userId:userId,uploaded_no_photos:uploaded_no_photos,productType:productType,productId:productId,productSizeId:productSizeId,profinishing:profinishing,final_checkoutId:final_checkoutId}, 
		success: function(response_add) {
			
			var response_add = response_add.split('@@@');
			
			response_add1=response_add[0];
			
			if(response_add1 != '' && response_add1 == 1){
				window.location.href="<?=DEFAULT_URL?>/payu-payment.php?orderId="+response_add[1];	
			}
		
			
		}
	});
});
</script>
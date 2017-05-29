<?php
include_once("conf/loadconfig.inc.php"); 
session_start();
	extract($_POST);
	extract($_GET);
	$obj_product = new Photomanager();
	$obj_users = new Usermanager();
$currentTimestamp = getCurrentTimestamp();

if($action == "updateAllStatus" && $action != "")
{
		$final_checkoutId;
		$cartId = explode(',',$cartId);
		$premiumOrderId = explode(',',$premiumOrderId);
		$freeOrderId = explode(',',$freeOrderId);
		$productId = explode(',',$productId);
		$uploaded_no_photos = explode(',',$uploaded_no_photos);
		$productType = explode(',',$productType);
		$productSizeId = explode(',',$productSizeId);
		$profinishing= explode(',',$profinishing);
		
		
	$cartIdcount = count($cartId);
	$premiumOrderIdcount = count($premiumOrderId);	
	$freeOrderIdcount = count($freeOrderId);	
	$premiumOrderIdcount;
	
		
	
for($i=0;$i<$premiumOrderIdcount;$i++)
{
	
$dataArrayorder = array('userId'=>$userId,
							   'guestUserId'=>$_SESSION['guestUserId'],
							   'productId'=>$productId[$i],
							   'productFreeOrderId'=>$freeOrderId[$i],
							   'productPreOrderId'=>$premiumOrderId[$i],
							   'upload_no_photo'=>$uploaded_no_photos[$i],
							   'productType'=>$productType[$i],
							   'productSizeId'=>$productSizeId[$i],
							   'proFinishing'=>$profinishing[$i],
							   'orderDate'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A")))),
							   'createdDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))
						
					);
$myOrderId = $obj_product->insertMyOrder($dataArrayorder,$obj_product->tblmyorder);

	if(!empty($myOrderId)){
		$final_order_id='P'.date('Ydm').(100000+$myOrderId); 
		mysql_query("Update myOrdersManager Set `final_order_id`= '".$final_order_id."' Where orderId = ".$myOrderId);	
	}
}

for($i=0;$i<$cartIdcount;$i++)
{
	$dateArr = array('cartBuyStatus'=>'1');
	
$obj_product->updateCartItems($dateArr,$cartId[$i],$obj_product->tblcart);
}

for($i=0;$i<$cartIdcount;$i++)
{
	$dateArr = array('buyStatus'=>'1',
				'onetimeStatus'=>'1',
);
$obj_product->updateFreePhotoOrder($dateArr,$freeOrderId[$i],$obj_product->tblfreeorder);
$obj_product->updatePremiumPhotoOrder($dateArr,$premiumOrderId[$i],$obj_product->tblpremiumorder);
}



$updateQuery = "Update checkout set `buy_status` = 1 where checkoutId = ".$final_checkoutId." And userId = ".$userId;

mysql_query($updateQuery);		
$dateArr = array('userId'=>$userId);
$update = $obj_product->updatePremiumPhotoGuestId($dateArr,$_SESSION['guestUserId'],$obj_product->tblpremiumorder);
$update2 = $obj_product->updatePremiumPrintPhotoGuestId($dateArr,$_SESSION['guestUserId'],$obj_product->tblpremiumphoto);
$update3 = $obj_product->updateCartItemsGuestId($dateArr,$_SESSION['guestUserId'],$obj_product->tblcart);

echo "1@@@".$myOrderId;
		
}
?>
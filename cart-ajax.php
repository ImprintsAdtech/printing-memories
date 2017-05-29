<?php
include_once("conf/loadconfig.inc.php"); 
session_start();
	extract($_POST);
	extract($_GET);
	$obj_product = new Photomanager();
$currentTimestamp = getCurrentTimestamp();

if($action == "deletecart" && $action != "")
{
$obj_product->delete_entry('cartId', $cartId, $obj_product->tblcart);
if($productType == "free")
{	 
$obj_product->delete_entry('freePhotoOrderId', $orderId, $obj_product->tblfreeorder);
$obj_product->delete_entry('freePhotoOrderId', $orderId, $obj_product->tblfreephoto);	
}
if($productType == "paid")
{	 
//$obj_product->delete_entry('productMasterDetailId', $orderId, $obj_product->tblpaidorder);	
}
  		   
	echo '1';
}
?>
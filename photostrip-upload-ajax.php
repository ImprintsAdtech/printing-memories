<?php
ini_set("display_errors",1);
include_once("conf/loadconfig.inc.php"); 
require_once('classes/class.ImageFilter.php');
session_start();
	extract($_POST);
	extract($_GET);
	$obj_product = new Photomanager();
$currentTimestamp = getCurrentTimestamp();

$userId = $_SESSION['userId'];
$guestUserId = $_SESSION['guestUserId'];
if($userId == "")
{
$userId = $_SESSION['guestUserId'];	
}

if($action == "printingPhoto" && $action != "")
{
if(isset($_POST))
{
     $Destination = 'uploads';
    foreach($_FILES['ImageFile'] as $key=>$fileData){
    	foreach($fileData as $j=>$val){
    		$imagedata[$j][$key] = $val;
    	}
    }
    $i=1;
   	foreach($imagedata as $data){
    	if(!isset($data) || !is_uploaded_file($data['tmp_name'])) {
			die('Something went wrong with Upload!');
		}
		/*
		$filter = new ImageFilter;
	    $score = $filter->GetScore($data['tmp_name']);
		if(isset($score))
		{
			if($score >= 60)
			{
				 echo "It seems that you have uploaded a nude picture :-("; exit;
			}
		}
		*/
	    $RandomNum   = rand(0, 9999999999);
	    $ImageName      = str_replace(' ','-',strtolower($data['name']));
	    $ImageType      = $data['type']; //"image/png", image/jpeg etc.
	    $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
	    $ImageExt = str_replace('.','',$ImageExt);
	    $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
	    //Create new image name (with random number added).
	    $NewImageName = $productMasterDetailId.'-'.$ImageName.'-'.$RandomNum.'.'.$ImageExt;
	    move_uploaded_file($data['tmp_name'], "$Destination/$NewImageName");

		$dataArray = array('premiumPhotoOrderId'=>$premiumPhotoOrderId,
						   	'userId'=>$userId,
						   	'guestUserId'=>$userId,
						   	'productId'=>$productId,
						    'premiumPhotoName'=>$NewImageName,
							'productName'=>$productName,
							'photo_sequence'=>$i,
							'createdDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))
					
				);
	
		$last_inserted = $obj_product->insertPremiumPrintPhoto($dataArray,$obj_product->tblpremiumphoto);
		
		$photosUploaded = $obj_product->getAllPremiumPrintPhoto($premiumPhotoOrderId, $_SESSION['userId']);
        $count = $db->numRows($photosUploaded);
		$divideVal = $count/$no_of_photo;
		$noOfSheet = ceil($divideVal);
    	$printTotalPrice = $printPrice * $noOfSheet;
		$dateArr = array( 'printTotalPrice'=>$printTotalPrice,);
		$update = $obj_product->updatePremiumPhotoOrder($dateArr,$premiumPhotoOrderId,$obj_product->tblpremiumorder);
		$i++;
	}
		
		echo "1";

}
}

if($action == "printingPhotoDelete" && $action != "")
{
	$obj_product->delete_entry('PremiumPhotoId', $printPhotoId, $obj_product->tblpremiumphoto);	
	
	
		$photosUploaded = $obj_product->getAllPremiumPrintPhoto($premiumPhotoOrderId, $_SESSION['userId']);
        $count = $db->numRows($photosUploaded);
		$divideVal = $count/$no_of_photo;
		$noOfSheet = ceil($divideVal);
			
        $printTotalPrice = $printPrice * $noOfSheet;
		
	$dateArr = array( 'printTotalPrice'=>$printTotalPrice,);

$update = $obj_product->updatePremiumPhotoOrder($dateArr,$premiumPhotoOrderId,$obj_product->tblpremiumorder);
	
	   		   
	echo '1';
}

if($action == "autofillPhoto" && $action != "")
{
$PremiumPhotoId;
//echo $PremiumPhotoId;
$premiumPhotoDetail = $obj_product->getPremiumPhotoDetails($PremiumPhotoId);	

$premiumPhotoOrderId = $premiumPhotoDetail->premiumPhotoOrderId;
$productName = $premiumPhotoDetail->productName;
$productId = $premiumPhotoDetail->productId;
$userId = $premiumPhotoDetail->userId;
$guestUserId = $premiumPhotoDetail->guestUserId;
$premiumPhotoName = $premiumPhotoDetail->premiumPhotoName;

$dataArray = array('premiumPhotoOrderId'=>$premiumPhotoOrderId,
						   'userId'=>$userId,
						   'guestUserId'=>$guestUserId,
						   'productId'=>$productId,
						    'premiumPhotoName'=>$premiumPhotoName,
							'productName'=>$productName,
							 'createdDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))
					
				);
	
		$last_inserted = $obj_product->insertPremiumPrintPhoto($dataArray,$obj_product->tblpremiumphoto);
		
		
		
		
		$photosUploaded = $obj_product->getAllPremiumPrintPhoto($premiumPhotoOrderId, $_SESSION['userId']);
        $count = $db->numRows($photosUploaded);
		$divideVal = $count/$no_of_photo;
		$noOfSheet = ceil($divideVal);
			
        $printTotalPrice = $printPrice * $noOfSheet;
		
	$dateArr = array( 'printTotalPrice'=>$printTotalPrice,);

$update = $obj_product->updatePremiumPhotoOrder($dateArr,$premiumPhotoOrderId,$obj_product->tblpremiumorder);
		
		
		
		echo '1';
}

if($action == "changeAllelements" && $action != "")
{
$proSizeValue;
$productId;
$premiumOrderIdss;
$sizeDetail = $obj_product->getProDetailwithSize($productId,$proSizeValue);

$printPrice = $sizeDetail->printPrice;
$no_of_photos = $sizeDetail->no_of_photos;


$dateArr = array( 'no_of_photos'=>$no_of_photos,
					'productSize'=>$proSizeValue,
					'printPrice'=>$printPrice,
					'proFinishing'=>$proFinishing,
					);

$update = $obj_product->updatePremiumPhotoOrder($dateArr,$premiumOrderIdss,$obj_product->tblpremiumorder);

$userId = $_SESSION['userId'];
$guestUserId = $_SESSION['guestUserId'];
if($userId == "")
{
$userId = $_SESSION['guestUserId'];	
}
$photosUploaded = $obj_product->getAllPremiumPrintPhoto($premiumOrderIdss, $_SESSION['userId']);
        $count = $db->numRows($photosUploaded);
		$divideVal = $count/$no_of_photos;
		$noOfSheet = ceil($divideVal);
			
        $printTotalPrice = $printPrice * $noOfSheet;




		
		$cartData = $obj_product->checkPaidCartalready($userId,$premiumOrderIdss);
		
		if($db->numRows($cartData)> 0)
		{
			while($cartDataRes = $db->fetchNextObject($cartData)){
				$cartId = $cartDataRes->cartId;
			}
			
			$dataArray = array( 'printPrice'=>$printTotalPrice,
							   'no_of_photos'=>$no_of_photos,
					);
			$cartId = $obj_product->updateCartItems($dataArray,$cartId,$obj_product->tblcart);
			
			
		}


echo "1";

}


if($action == "changePrice" && $action != "")
{
$proSizeValue;
$productId;

$sizeDetail = $obj_product->getProDetailwithSize($productId,$proSizeValue);

$printPrice = $sizeDetail->printPrice;
$no_of_photo = $sizeDetail->no_of_photos;
echo $printPrice."@@@".$no_of_photo;
	
}









if($action == "printingContinue" && $action != "")
{
	
	$premiumPhotoOrderId;
	$prePhotoOrderDetail = $obj_product->getPremiumPhotoOrderDetails($premiumPhotoOrderId);
	
	
	$productId = $prePhotoOrderDetail->productId;
	$no_of_photos = $prePhotoOrderDetail->no_of_photos;
	$productSize = $prePhotoOrderDetail->productSize;
	
	$productSizeData = $obj_product->getProDetailwithSizePhotos($productId,$productSize,$no_of_photos);
	$productSizeId = $productSizeData->productSizeId;
	
	$dataArray = array( 'productSizeId'=>$productSizeId,
					);
	$premiumorder = $obj_product->updatePremiumPhotoOrder($dataArray,$premiumPhotoOrderId,$obj_product->tblpremiumorder);	
	
	
	$printDetail = $obj_product->getAllPremiumPrintPhoto($premiumPhotoOrderId, $_SESSION['userId']);
	$count = $db->numRows($printDetail);
	if($db->numRows($printDetail) > 0)
	{
		$freePhotoId;
		while($photoData = $db->fetchNextObject($printDetail)){
			$PremiumPhotoId.=$photoData->PremiumPhotoId.',';
			
		}
		
		$PremiumPhotoId = rtrim($PremiumPhotoId, ','); 
		
		$userId = $_SESSION['userId'];
$guestUserId = $_SESSION['guestUserId'];
if($userId == "")
{
$userId = $_SESSION['guestUserId'];	
}
		
		$cartData = $obj_product->checkPaidCartalready($userId,$premiumPhotoOrderId);
		
		if($db->numRows($cartData) == 0)
		{
			
			$dataArray = array('userId'=>$userId,
								'guestUserId'=>$guestUserId,
							   'printPhotoId'=>$PremiumPhotoId,
							   'productSizeId'=>$productSizeId,
							   'productId'=>$prePhotoOrderDetail->productId,
							   'premiumPhotoOrderId'=>$premiumPhotoOrderId,
							   'plan'=>'paid',
							   'no_of_photos'=>$prePhotoOrderDetail->no_of_photos,
							   'cartBuyStatus'=>0,
							   'printPrice'=>$prePhotoOrderDetail->printTotalPrice,
							   'uploaded_no_photos'=>$count,
							   'createDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))
						
					);
			$last_inserted = $obj_product->insertCart($dataArray,$obj_product->tblcart);

			
			echo "1";
		}
		else
		{
			while($cartDataRes = $db->fetchNextObject($cartData)){
				$cartId = $cartDataRes->cartId;
			}
			
			$dataArray = array( 'printPhotoId'=>$PremiumPhotoId,
							   'uploaded_no_photos'=>$count,
							   'productSizeId'=>$productSizeId,
							   'printPrice'=>$prePhotoOrderDetail->printTotalPrice,
					);
			$cartId = $obj_product->updateCartItems($dataArray,$cartId,$obj_product->tblcart);
			
			echo '0';
		}
	}

	
}

if($action == "updateFreeorder" && $action != "")
{
$dataArray = array( 'productSize'=>$proSize,
					'no_of_photos'=>$proNoPhoto,
					);
$cartId = $obj_product->updateFreePhotoOrder($dataArray,$freeOrderIdss,$obj_product->tblfreeorder);	
echo '1';
}

?>
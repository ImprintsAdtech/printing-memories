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

	$defaultWidth = "";
	$defaultHeight = ""; 
	$photosUploaded = $obj_product->getPremiumPhotoOrderDetails($premiumPhotoOrderId, $_SESSION['userId']);
	$productSize = $photosUploaded->productSize;
	$productSizeDetail = $obj_product->getProDetailwithSize($productId, $productSize);
	$photoSizes = $productSizeDetail->minResolution;
	if(!empty($photoSizes)){
		$sizes = explode(" X ", $photoSizes);
		$defaultWidth = $sizes[0];
		$defaultHeight = $sizes[1]; 
	}
	if(isset($_POST)){
	    $Destination = 'uploads';
	    foreach($_FILES['ImageFile'] as $key=>$fileData){
	    	foreach($fileData as $j=>$val){
	    		$imagedata[$j][$key] = $val;
	    	}
	    }
	    $i=1;
	   	foreach($imagedata as $data){
	   		if(!isset($data) || !is_uploaded_file($data['tmp_name'])) {
				echo 'Something went wrong with Upload!'; exit;
			} 

			/*$filter = new ImageFilter;
		    $score = $filter->GetScore($data['tmp_name']);
			if(isset($score))
			{
				if($score >= 60)
				{
					 echo "It seems that you have uploaded a nude picture :-("; exit;
				}
			}*/
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
			if($productSlug == "passports-2"){
				$noOfSheet = $noOfSheet*$count;
			}
			$printTotalPrice = $printPrice * $count;
			$dateArr = array( 'printTotalPrice'=>$printTotalPrice,);
			$update = $obj_product->updatePremiumPhotoOrder($dateArr,$premiumPhotoOrderId,$obj_product->tblpremiumorder);
			$i++;
		}
	echo $NewImageName."@@@1";
	}
}

if($action == "printingPhotoDelete" && $action != ""){
	$obj_product->delete_entry('PremiumPhotoId', $printPhotoId, $obj_product->tblpremiumphoto);	
	$photosUploaded = $obj_product->getAllPremiumPrintPhoto($premiumPhotoOrderId, $_SESSION['userId']);
    $count = $db->numRows($photosUploaded);
	$printTotalPrice = $printPrice * $count;
	$dateArr = array( 'printTotalPrice'=>$printTotalPrice,);
	$update = $obj_product->updatePremiumPhotoOrder($dateArr,$premiumPhotoOrderId,$obj_product->tblpremiumorder);
	echo '1';
}

if($action == "autofillPhoto" && $action != "")
{
$PremiumPhotoId;
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
		//echo $count;
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
$productSizeId = $sizeDetail->productSizeId;

$dateArr = array( 
				'no_of_photos'=>$no_of_photos,
				'productSizeId'=>$productSizeId,
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

	if($db->numRows($cartData)> 0){
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
		$cartQuery = "SELECT * FROM `cart` WHERE `userId` = ".$_SESSION['userId']." AND `plan` LIKE 'free' AND `cartBuyStatus` = '0'"; 
		$resourceCart = mysql_query($cartQuery);
		if($db->numRows($cartData) == 0 && $db->numRows($resourceCart)==0)
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


/*
Himanshu Sharma
Photo save from facebook url
*/

if($action == "imageFromFacebook" && $action != "")
{

	$defaultWidth = "";
	$defaultHeight = ""; 
	$photosUploaded = $obj_product->getPremiumPhotoOrderDetails($premiumPhotoOrderId);
	$productSize = $photosUploaded->productSize;
	$productSizeDetail = $obj_product->getProDetailwithSize($productId, $productSize);
	$photoSizes = $productSizeDetail->minResolution;
	if(!empty($photoSizes)){
		$sizes = explode(" X ", $photoSizes);
		$defaultWidth = $sizes[0];
		$defaultHeight = $sizes[1]; 
	}
	if(isset($_POST)){
		$Destination = "uploads/";
	    $url = $_POST["photo_url"];
	    /*
		$tempName = tempnam('/tmp', 'php_files');
		$originalName = basename(parse_url($url, PHP_URL_PATH));
		$imgRawData = file_get_contents($url);
		file_put_contents($tempName, $imgRawData);
		$data = array(
		    'name' => $originalName,
		    'type' => mime_content_type($tempName),
		    'tmp_name' => $tempName,
		    'error' => 0,
		    'size' => strlen($imgRawData),
		);
	    */
	    $baseName = basename($url);
	    if(strpos($baseName, "?")!== false) {
	    	$basenameArray = explode("?", $baseName); 
	    	$baseName = $basenameArray[0];
	    }
	    if(copy($url, $Destination.$baseName)){
			$dataArray = array('premiumPhotoOrderId'=>$premiumPhotoOrderId,
				'userId'=>$userId,
				'guestUserId'=>$userId,
				'productId'=>$productId,
				'premiumPhotoName'=>$baseName,
				'productName'=>$productName,
				'createdDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))
			);

			$last_inserted = $obj_product->insertPremiumPrintPhoto($dataArray,$obj_product->tblpremiumphoto);
			$photosUploaded = $obj_product->getAllPremiumPrintPhoto($premiumPhotoOrderId);
			$count = $db->numRows($photosUploaded);
			$divideVal = $count/$no_of_photo;
			$noOfSheet = ceil($divideVal);
			$printTotalPrice = $printPrice * $noOfSheet;
			$dateArr = array( 'printTotalPrice'=>$printTotalPrice,);
			$update = $obj_product->updatePremiumPhotoOrder($dateArr,$premiumPhotoOrderId,$obj_product->tblpremiumorder);
			echo $NewImageName."@@@1";			
		}
   	}
}

/*
Himanshu Sharma
Update ProductOrder after login facebook
*/

if($action == "updatePrintOrder" && $action != ""){
	$guestUserId = $_POST["guestUserId"];
	$premiumPhotoOrderId = $_POST["premiumPhotoOrderId"];
	$productId = $_POST["productId"];
	$userId = $_POST["user_id"];
	$dataArr = array('userId'=>$userId,
					'guestUserId'=>$userId,
	);	
	$premiumPhotoOrderId = $obj_product->updatePremiumPhotoOrder($dataArr, $premiumPhotoOrderId, $obj_product->tblpremiumorder); 
	echo "updated@@@1";
	
}

/*
//Update old image with updated cropped image
if(isset($action) && $action=="croppedImageSave"){
	if(!empty($imageDataUrl)){
		$uri =  substr($imageDataUrl,strpos($imageDataUrl,",") 1);
	    // create a filename for the new image
	    $file = md5(uniqid()) . '.png';

	    // decode the image data and save it to file
	    file_put_contents($file, base64_decode($uri));

	    // return the filename
	    echo $file; echo "<br>"; die("Jai Mata Di");
	    /*
		if(file_exists($imageUrl)){
			unlink($imageUrl);
			
			$updateQuery = "Update `premiumPrintPhoto` set `premiumPrintPhoto`.`premiumPhotoName`=".$baseName." Where `premiumPrintPhoto`.`PremiumPhotoId` = ".$premiumPhotoId." And `premiumPrintPhoto`.`userId` = ".$_SESSION["userId"];
			echo $updateQuery; die;
			if(mysql_query($updateQuery)){
				echo "Success";
			} else {
				echo "Error while saving Image.";
			}
			
		} 
		
	}
}*/

?>
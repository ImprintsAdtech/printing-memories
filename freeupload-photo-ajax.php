<?php

ini_set("display_errors",1);

include_once("conf/loadconfig.inc.php"); 

require_once('classes/class.ImageFilter.php');

session_start();

	extract($_POST);

	extract($_GET);

	$obj_product = new Photomanager();

$currentTimestamp = getCurrentTimestamp();

if($action == "filestack_image_upload" && $action != ""){

			$dataArray = array('freePhotoOrderId'=>$freeOrderIdss,
								'userId'=>$_SESSION['userId'],
								'productId'=>$productId,
								'freePhotoName'=>$test_url,
								'productName'=>$productName,
								'upload_server'=>'s3',
								'createdDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))
			);
			$last_inserted = $obj_product->insertFreePrintPhoto($dataArray,$obj_product->tblfreephoto);
			echo "1";
}

if($action == "printingPhoto" && $action != ""){
	if(isset($_POST) && $_FILES['ImageFile']['name']!=""){
		$Destination = 'uploads';
		$photoUploaded = count($_FILES['ImageFile']['name']);
		$totalUploaded = $photoUploaded + $uploaded_no_photos;
		if($totalUploaded > $no_of_photo){
			echo "exceed_no_of_photo";
		} else {
		    foreach($_FILES['ImageFile'] as $key=>$fileData){
				foreach($fileData as $j=>$val){
		    		$imagedata[$j][$key] = $val;
		    	}
		    }
		    $i=1;
		   	foreach($imagedata as $data){
				/*
				if(!isset($data) || !is_uploaded_file($data['tmp_name'])) {
					die('Something went wrong with Upload!');
				}
				$filter = new ImageFilter;
				$score = $filter->GetScore($data['tmp_name']);
				if(isset($score)){
					if($score >= 60){
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
			    $NewImageName = $freePhotoOrderId.'-'.$ImageName.'-'.$RandomNum.'.'.$ImageExt;
			    move_uploaded_file($data['tmp_name'], "$Destination/$NewImageName");
				$dataArray = array('freePhotoOrderId'=>$freePhotoOrderId,
									'userId'=>$_SESSION['userId'],
									'productId'=>$productId,
									'freePhotoName'=>$NewImageName,
									'productName'=>$productName,
									'createdDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))
				);
				$last_inserted = $obj_product->insertFreePrintPhoto($dataArray,$obj_product->tblfreephoto);
				$i++;
			}

				//$_SESSION["success_message"] = "Your ".$photoUploaded." photos have been uploaded.";
				echo "1";
		}
	}
}



if($action == "printingPhotoDelete" && $action != "")

{

	$obj_product->delete_entry('freePhotoId', $printPhotoId, $obj_product->tblfreephoto);	   		   

	echo '1';

}



if($action == "printingContinue" && $action != "")

{

	

	$freePhotoOrderId;

	

	$freePhotoOrderDetail = $obj_product->getFreePhotoOrderDetails($freePhotoOrderId);

	

	

	$productId = $freePhotoOrderDetail->productId;

	$no_of_photos = $freePhotoOrderDetail->no_of_photos;

	$productSize = $freePhotoOrderDetail->productSize;

	

	$productSizeData = $obj_product->getProDetailwithSizePhotos($productId,$productSize,$no_of_photos);

	$productSizeId = $productSizeData->productSizeId;

	

	$dataArray = array( 'productSizeId'=>$productSizeId,

					);

	$freeorder = $obj_product->updateFreePhotoOrder($dataArray,$freePhotoOrderId,$obj_product->tblfreeorder);	

	

	

	

	

	$printDetail = $obj_product->getAllFreePrintPhoto($freePhotoOrderId);

	$count = $db->numRows($printDetail);

	if($db->numRows($printDetail) > 0)

	{

		$freePhotoId;

		while($photoData = $db->fetchNextObject($printDetail)){

			$freePhotoId.=$photoData->freePhotoId.',';

			

		}

		

		$freePhotoId = rtrim($freePhotoId, ','); 

		

		$cartData = $obj_product->checkFreeCartalready($_SESSION['userId'],$freePhotoOrderId);

		$cartQuery = "SELECT * FROM `cart` WHERE `userId` = ".$_SESSION['userId']." AND `cartBuyStatus` = '0'"; 

		$resourceCart = mysql_query($cartQuery);

		if($db->numRows($cartData) == 0 && $db->numRows($resourceCart)==0){

			$dataArray = array('userId'=>$_SESSION['userId'],

							   'printPhotoId'=>$freePhotoId,

							   'productSizeId'=>$productSizeId,

							   'productId'=>$freePhotoOrderDetail->productId,

							   'freePhotoOrderId'=>$freePhotoOrderId,

							   'plan'=>'free',

							   'no_of_photos'=>$freePhotoOrderDetail->no_of_photos,

							   'cartBuyStatus'=>0,

							   'uploaded_no_photos'=>$count,

							   'createDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))

						

					);

			$last_inserted = $obj_product->insertCart($dataArray,$obj_product->tblcart);



			

			echo "1";

		} else {

			while($cartDataRes = $db->fetchNextObject($cartData)){

				$cartId = $cartDataRes->cartId;

			}

			$dataArray = array( 'printPhotoId'=>$freePhotoId,

							   'uploaded_no_photos'=>$count,

					);

			$cartId = $obj_product->updateCartItems($dataArray,$cartId,$obj_product->tblcart);

			echo '0';

		}

	}



	

}



if($action == "autofillPhoto" && $action != ""){

	$freePhotoId;
	$freePhotoDetail = $obj_product->getFreePrintPhotoDetails($freePhotoId);	
	$freePhotoOrderId = $freePhotoDetail->freePhotoOrderId;
	$orderDataResource = mysql_query("Select `freePhotoOrder`.`no_of_photos` From `freePhotoOrder` Where `freePhotoOrder`.`freephotoorderId` = ".$freePhotoOrderId);
	$orderData = mysql_fetch_assoc($orderDataResource);
	$noOfPhotosAllowed = $orderData["no_of_photos"];
	$checkPhotosResource = mysql_query("Select * From `freePrintPhotos` Where `freePrintPhotos`.`freePhotoOrderId` = ".$freePhotoOrderId);
	$checkPhotoes = mysql_num_rows($checkPhotosResource);
	if($checkPhotoes < $noOfPhotosAllowed){
		$productName = $freePhotoDetail->productName;
		$productId = $freePhotoDetail->productId;
		$userId = $freePhotoDetail->userId;
		$freePhotoName = $freePhotoDetail->freePhotoName;
		$dataArray = array('freePhotoOrderId'=>$freePhotoOrderId,
							'userId'=>$userId,
							'productId'=>$productId,
							'freePhotoName'=>$freePhotoName,
							'productName'=>$productName,
							'createdDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))
		);
		$last_inserted = $obj_product->insertFreePrintPhoto($dataArray,$obj_product->tblfreephoto);
		echo '1';
	} else {
		echo "not allow";
	}
}



if($action == "updateFreeorder" && $action != ""){
	$dataArray = array( 'productSize'=>$proSize,
						'no_of_photos'=>$proNoPhoto,
						);
	$cartId = $obj_product->updateFreePhotoOrder($dataArray,$freeOrderIdss,$obj_product->tblfreeorder);	
	echo '1';
}

if(isset($action) && $action=="changeSetting"){
	if(mysql_query("Update `freePhotoOrder` set freeFinishing = '".$finish."' WHERE `freePhotoOrder`.`freePhotoOrderId` = ".$freePhotoOrderId)){
		echo "Success";
	}	
}


if($action == "imageFromFacebook" && $action != ""){
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
			$createdDatatime = date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))));
			$query = "INSERT INTO `freePrintPhotos` (freePhotoOrderId, productName, productId, userId, freePhotoName,createdDatetime) VALUES (".$freePhotoOrderId.", '".$productName."', ".$productId.", ".$userId.", '".$baseName."', '".$createdDatatime."')";
			if(mysql_query($query)) {
				echo $baseName."@@@1";
			}
		}
   	}
}

?>
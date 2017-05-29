<?php
include_once("conf/loadconfig.inc.php");
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

$data =  $_POST['blockimg_large'];

list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);
$data = base64_decode($data);
$file = 'uploads/'.$userId.'-IMAGE-'. uniqid() . '.png';
file_put_contents($file, $data);
if(file_exists("uploads/".$imageName)){
	unlink("uploads/".$imageName);
}
$filesave = explode("uploads/",$file);

if($productType == "free"){
	$dataArr = array('freePhotoName'=>$filesave[1]);

	$printingphoto=$obj_product->updateFreePrintPhoto($dataArr, $printPhotoId, $obj_product->tblfreephoto);
} else {
	$dataArr = array('premiumPhotoName'=>$filesave[1]);
	$printingphoto=$obj_product->updatePremiumPrintPhoto($dataArr, $printPhotoId, $obj_product->tblpremiumphoto);
}

echo 'Success';


?>
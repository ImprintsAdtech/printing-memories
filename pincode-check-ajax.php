<?php

ini_set("display_errors",1);

include_once("conf/loadconfig.inc.php"); 

require_once('classes/class.ImageFilter.php');

	session_start();

	extract($_POST);
	extract($_GET);

	$obj_Pincode = new Pincodemanager();

	$currentTimestamp = getCurrentTimestamp();

if($action == "check_pincode" && $action != "")
{
	$pincode_data = $obj_Pincode->getCheckpincode($_POST['pincode']);
	$pincodeId=$pincode_data->pincodeId;
	if($pincodeId!=''){
		echo "shipping yes";
	}else{
		echo "shipping no";
	}
}
?>
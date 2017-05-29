<?php

include_once("conf/loadconfig.inc.php"); 

session_start();

	extract($_POST);

	extract($_GET);

	$obj_product = new Photomanager();

	$obj_users = new Usermanager();

$currentTimestamp = getCurrentTimestamp();



if($action == "updatecheckoutinfo" && $action != "")

{

	if($_SESSION['userId'] != "" && isset($_SESSION['userId'])){

		// For Permanent Address

		//$userDetail = $obj_users->get_user_by_id($_SESSION['userId']);
	
		//if(!empty($userDetail)){
			
			if(empty($userDetail->house_no) && empty($userDetail->street) && empty($userDetail->area) && empty($userDetail->city_id) && empty($userDetail->state_id)){  


				$dataArraycck = array(
						   'house_no'=>!empty($house_no) ? $house_no : "",
						   'street'=>!empty($street) ? $street : "",
						   'area'=>!empty($area) ? $area : "",
						   'city_id'=>!empty($userCity_id) ? $userCity_id : "",
						   'state_id'=>!empty($userState_id) ? $userState_id : "",
						   'pincode'=>!empty($pincode) ? $pincode : "",
				);

				$update=$obj_users->updateuser($dataArraycck, $_SESSION['userId'], $obj_users->tbl_user);

			}

	//	}



		// User Interests

		if(isset($_POST["interest_id"]) && !empty($_POST["interest_id"])){

			$interest_id = $_POST["interest_id"];

			$query = "Select * FROM user_interests WHERE user_id = ".$_SESSION["userId"]." AND product_id = ".$productId;

			$interestQuery = mysql_query($query);

			if(mysql_num_rows($interestQuery)==0){

				foreach($interest_id as $interest){

					mysql_query("insert into user_interests (`user_id`, `interest_id`, `product_id`, `status`, `created`, `modified`) Values (".$_SESSION["userId"].", ".$interest.", ".$productId.", 1, '".date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))."', '".date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))."')");

				} 

			} else {

				mysql_query("Delete from user_interests where user_id = ".$_SESSION["userId"]." AND product_id = ".$product_id);

				foreach($interest_id as $interest){

					mysql_query("insert into user_interests (`user_id`, `interest_id`, `product_id`, `status`, `created`, `modified`) Values (".$_SESSION["userId"].", ".$interest.", ".$product_id.",1, '".date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))."', '".date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))."')");

				}

			}	

		}

		



		//Checkout Info

		if(isset($interest_id) && is_array($interest_id)){

			$interestPostData = implode(",", $interest_id);

		} else {

			$interestPostData = $interest_id;

		} 

		$checkoutData = $obj_product->getCheckoutInfo($_SESSION['userId']);

		if($db->numRows($checkoutData) > 0){

			while($checkoutDatares = $db->fetchNextObject($checkoutData)){

				$basicInfoId = $checkoutDatares->basicInfoId;

				$checkoutAddId = $checkoutDatares->checkoutAddId;

			}

			$dataArrayinfo = array('userId'=>$_SESSION['userId'],
								'checkoutOccupation'=>!empty($checkoutOccupation) ? $checkoutOccupation : "" ,
								'interest_ids'=>$interestPostData,
								'createdDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))

						

					);

			$obj_product->updateCheckoutBasicinfo($dataArrayinfo,$basicInfoId,$obj_product->tblcheckoutbasic);

		} else {

			$dataArrayinfo = array('userId'=>$_SESSION['userId'],
							   'checkoutOccupation'=>!empty($checkoutOccupation) ? $checkoutOccupation: "", 
							   'interest_ids'=>!empty($interestPostData) ? $interestPostData : "",
							   'createdDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))
					);

			$basicInfoId = $obj_product->insertCheckoutBasicinfo($dataArrayinfo,$obj_product->tblcheckoutbasic);

		}

		$dataArrayadd = array('userId'=>$_SESSION['userId'],
						   'checkoutHouseNo'=>!empty($checkoutHouseNo) ? $checkoutHouseNo : $house_no,
						   'checkoutStreet'=>!empty($checkoutStreet) ? $checkoutStreet : $street,
						   'checkoutArea'=>!empty($checkoutArea) ? $checkoutArea : $area,
						   'checkoutCity_id'=>!empty($checkoutCity_id) ? $checkoutCity_id : $userCity_id,
						   'checkoutState_id'=>!empty($checkoutState_id) ? $checkoutState_id : $userState_id,
						   'checkoutPincode'=>!empty($checkoutPincode) ? $checkoutPincode : $pincode,
						   'createdDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))
				);

		$checkoutAddId = $obj_product->insertCheckoutAddress($dataArrayadd,$obj_product->tblcheckoutAdd);





		//Delte previous checkouts of the same user

		mysql_query("Delete from checkout where userId = '".$_SESSION['userId']."' AND buy_status ='0'");
		$alreadyIncheckout = $obj_product->getCheckoutAccCart($cartId);
		if($db->numRows($alreadyIncheckout) > 0){
			$dataArr = array( 'checkoutAddId'=>$checkoutAddId,'basicInfoId'=>$basicInfoId,);
			$checkoutId = $obj_product->updateCheckout($dataArr,$checkoutId,$obj_product->tblcheckout);
		} else {

			$productId;

			$dataArraycck = array('userId'=>$_SESSION['userId'],
								   'cartId'=>!empty($cartId) ? $cartId : "",
								   'checkoutAddId'=>!empty($checkoutAddId) ? $checkoutAddId : "",
								   'basicInfoId'=>!empty($basicInfoId) ? $basicInfoId : "",
								   'productId'=>!empty($productId) ? $productId : "",
								   'createdDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))

			);

			$checkoutId = $obj_product->insertCheckout($dataArraycck,$obj_product->tblcheckout);

			$final_check_outId=$_SESSION["checkoutId"] = $checkoutId;

		}

		// Update Cart With CheckOut Id

		if($checkoutId!=""){
			mysql_query("Update cart Set `checkoutId`= ".$checkoutId.", cartBuyStatus = 1 Where userId = ".$_SESSION['userId']." AND productId = ".$productId);
		}


		$freePhotoOrderIds = explode(',',$freePhotoOrderId);
		$cartId = explode(',',$cartId);
		$productType = explode(',',$productType);

		if(in_array('paid',$productType))
		{
			echo "paid 1";	
		} else {

			$ordercount = count($freePhotoOrderIds);
			$i=0;
			$cartIdcount = count($cartId);
			$finishingResource  = mysql_query("Select `freeFinishing` from `freePhotoOrder` where `freePhotoOrder`.`freePhotoOrderId` = ".$freePhotoOrderIds[$i]);
			$Finishing = mysql_fetch_assoc($finishingResource);
			$proFinishing = !empty($Finishing["freeFinishing"]) ? $Finishing["freeFinishing"] : "" ;
			for($i=0;$i<$cartIdcount;$i++) {
				
				$myorder_already_check="SELECT * FROM `myOrdersManager` WHERE `productType`='free' AND `productId`='".$productId[$i]."' AND `userId`='".$_SESSION['userId']."' AND `productSizeId`='".$productSizeId[$i]."' AND YEAR(orderDate) = '".date('Y')."' AND MONTH(orderDate)='".date('m')."'";
				$already_reult=mysql_query($myorder_already_check);
					  	 
				if(mysql_num_rows($already_reult)<1){
					
					$dataArrayorder = array('userId'=>$_SESSION['userId'],
												   'productId'=>$productId[$i],
												   'productFreeOrderId'=>$freePhotoOrderIds[$i],
												   'upload_no_photo'=>is_array($uploaded_no_photos) ? $uploaded_no_photos[$i] : $uploaded_no_photos,
												   'productType'=>$productType[$i],
												   'productSizeId'=>$productSizeId[$i],
												   'proFinishing'=>$proFinishing,
												   'orderDate'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A")))),
												   'createdDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))									
										);
					$myOrderId = $obj_product->insertMyOrder($dataArrayorder,$obj_product->tblmyorder);
				}
				 

				if(!empty($myOrderId)){

					 //$final_order_id=date('Ydm').(100000+$myOrderId); 

					 $sql_order_no="SELECT om.proFinishing, ps.product_short_code FROM myOrdersManager AS om INNER JOIN productSizeManager AS ps ON ps.productSizeId=om.productSizeId WHERE om.orderId='".$myOrderId."'";

					 $result=mysql_query($sql_order_no);

					 $row=mysql_fetch_array($result);
					
					 if($row['proFinishing']=='glossy'){
						 $finish='G';
					 }else{
						 $finish='M';
					 }
					 if($row['productSizeId']=='1'){
						 $finish='G';
					 }
					 $product_short_code=$row['product_short_code'];

					 $myOrderId;

					 $final_order_id=$product_short_code.$finish.date('Ymd').(100000+$myOrderId);

					 $sql_order_id="Update myOrdersManager Set `final_order_id`= '".$final_order_id."' Where orderId = '".$myOrderId."'";

					 mysql_query($sql_order_id);	

				}

							

				if(!empty($myOrderId)){

					$UpdateCheckoutAddress = array(
						'orderId'=>$myOrderId
						);
					$updateAdd = $obj_product->updateCheckoutAddress($UpdateCheckoutAddress,$checkoutAddId,$obj_product->tblcheckoutAdd);

				}

			}



			for($i=0;$i<$ordercount;$i++) {
				$dateArr = array('buyStatus'=>'1',
							'onetimeStatus'=>'1',
				);
				$obj_product->updateFreePhotoOrder($dateArr,$freePhotoOrderIds[$i],$obj_product->tblfreeorder);

			}

			if(!empty($final_check_outId)){
				mysql_query("UPDATE `checkout` SET `buy_status` = '1' WHERE `checkoutId` = ".$final_check_outId);	
			}

			

			$dateArr = array('cartBuyStatus'=>'1');
			$obj_product->updateCartItemsFree($dateArr,$_SESSION['userId'],$obj_product->tblcart);

				

/*			for($i=0;$i<$cartIdcount;$i++){

				$dateArr = array('cartBuyStatus'=>'1');

				$obj_product->updateCartItems($dateArr,$cartId[$i],$obj_product->tblcart);

			}*/

			$orderId=$myOrderId;
			include('email/email-free-order.php');
			include('email/email-free-order-admin.php');

			echo "1";

		}

	}

}



/*

Himanshu Sharma

Getting City For Permanent address while checking out

*/

if($action == "getPermanentCity"){

	$cityOptions = "";

	$cityResource = mysql_query("Select * from city where state_id = '".$state_id."' ORDER BY `city` ASC");
	$cityOptions .= "<option value=''>Select City</option>";
	while($cities = mysql_fetch_assoc($cityResource)){
		
		$cityOptions .= "<option value='".$cities["id"]."'>".$cities["city"]."</option>";

	}

	echo $cityOptions;

}

if($action == "getPermanentPincode"){

	$pincodeOptions = "";

	$pincodeResource = mysql_query("Select * from pincode where cityId = '".$cityId."'");

	while($pincodes = mysql_fetch_assoc($pincodeResource)){
		
		$pincodeOptions .= "<option value='".$pincodes["pincode"]."'>".$pincodes["pincode"]."</option>";

	}

	echo $pincodeOptions;

}

/*

Himanshu Sharma

Getting City For Shipping address while checking out

*/

if($action == "getShippingCity"){

	$cityOptions = "";

	$cityResource = mysql_query("Select * from city where state_id = '".$state_id."' ORDER BY `city` ASC ");

	while($cities = mysql_fetch_assoc($cityResource)){

		$cityOptions .= "<option value='".$cities["id"]."'>".$cities["city"]."</option>";

	}

	echo $cityOptions;

}

?>
<?php

include_once("conf/loadconfig.inc.php");

$currentTimestamp = getCurrentTimestamp();

	session_start();

	extract($_POST);

	extract($_GET);

	$obj_users = new Usermanager();

	$obj_product = new Photomanager();



if(isset($action) && $action == 'user_registration'){

	if($userFname != "" && $userEmail != ""){

		$userReslut = $obj_users->get_user_by_email($userEmail);

			if($db->numRows($userReslut)>0){

				$insertedUserId = $db->fetchNextObject($userReslut);

				if(isset($from) && $from=="facebook"){

					$_SESSION["userId"] = $insertedUserId->userId;

				}

				echo $insertedUserId->userId."@@@already";	

			} else {

				$otp=rand(1111, 9995);

				

				

				/*SEO Friendly URL*/

				$title = $userFname." ".$userLname;

				$userSlug=$obj_users->slugUrl($title);

				

				$userSlug=$obj_users->slug_check('userSlug', $userSlug, $obj_users->tbl_user);

				

				$userSlug_row = $db->fetchNextObject($userSlug);

				

				$userSlug=$userSlug_row->userSlug;

				

				if($userSlug!=''){



								 $userSlugInner=$obj_users->total_slug_check('userSlug', $userSlug, $obj_users->tbl_user);

								

								 $userSlug_row = $db->fetchNextObject($userSlugInner);

								 

								 $slugId=$userSlug_row->slugId;

								 

									  if($slugId!=0){

										 $slugId =$slugId+1;

									  }

										else{

											$slugId='2';

										}

										 $userSlug;

										 $slugId;

				}

				else{

					 $userSlug=$obj_users->slugUrl($title);

					 $slugId;

				}



				

				if($slugId!=''){

					$slugIdn='-'.$slugId;

				}

				else{

					$slugIdn='';

				}

				$userSlug;

				

				 $finalSlug=$userSlug.$slugIdn;

			 

			 	/*End SEO Friendly URL*/



					if(!empty($userPassword)){

						$encrypted =base64_encode(base64_encode($userPassword));	

					} else {

						$encrypted = "";

					}

					if(!isset($userPhone) && empty($userPhone)){

						$userPhone = "";	

					}

					if(!isset($userDob) && empty($userDob)){

						$userDob = "";	

					}

					if(!isset($facebook_id) && $facebook_id == ""){

						$facebook_id = "";

					}

					

					$dataArray = array('userFname'=>$userFname,



						'userLname'=>$userLname,



						'userPassword'=>$encrypted,



						'userEmail'=>$userEmail,



						'userPhone'=>$userPhone,

						

						'userDob'=>date("Y-m-d", strtotime($userDob)),

						

						'userGender'=>$userGender,

						

						'userStatus'=>'0',

						

						'otp'=>$otp,

						

						'otpStatus'=>'0',

						

						'userSlug'=>$userSlug,

						

						'slugId'=>$slugId,

						

						'finalSlug'=>$finalSlug,



						'facebook_id'=>$facebook_id,

					

						'createDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A")))),



					);



					$last_inserted = $obj_users->insertUser($dataArray,$obj_users->tbl_user);

					

					include('sms/sms-otpSend-Register.php');

					echo $last_inserted."@@@send";

				}



	}



	else{



		echo '0'; exit;



	}

}



if(isset($action) && $action == 'check_email'){



		$response = '';



		if($email != ''){



			$userReslut = $obj_users->get_user_by_email($email);



			if($db->numRows($userReslut)>0)



				$response = 1;



			else



				$response = 0;



		}



		echo $response; exit;



	}

	

if(isset($action) && $action == 'otpCheck'){



		$response = '';



		if($userOTP != '' && $userId != ''){



			$userReslut = $obj_users->check_user_otp($userId , $userOTP);



			if($db->numRows($userReslut)>0)

			{

				

			

				

			$dataArr = array('otpStatus'=>'1' ,'userStatus'=>'1');



			$forgot_password=$obj_users->updateuser($dataArr, $userId, $obj_users->tbl_user);

			

			while($userReslutData = $db->fetchNextObject($userReslut)){

				

				$userEmail = $userReslutData->userEmail;

				$userFname = $userReslutData->userFname;

				

				$_SESSION['userId'] =$userId ;

				$_SESSION['userEmail'] = $userEmail;

				$_SESSION['userFname'] = $userFname;

				

			}

			

			

			include('email/email-complete-signup.php');

				

			$response = 1;

			}

			else

			{



				$response = 0;

			}

		}



		echo $response; exit;



	}

		

if(isset($action) && $action == 'check_login'){

	$login_email = trim($login_email);

	$login_password = trim($login_password);

	$encrypted =base64_encode(base64_encode($login_password));



	if($login_email != '' && $login_password != ''){



		

		$user_result = $obj_users->user_login($login_email, $encrypted);

		

		



		if($db->numRows($user_result)>0){

			

			$userstatus_result = $obj_users->check_userStatus($login_email, $encrypted);

			

				if($db->numRows($userstatus_result)>0){

			



					$user_row = $db->fetchNextObject($user_result);

					

					$dateArr = array('loginwith'=>"",

									'guestUserId'=>$_SESSION['guestUserId']

										);

					

					$updatelogin=$obj_users->updateuser($dateArr,$user_row->userId,$obj_users->tbl_user);

					

					$dateArr = array( 'userId'=>$user_row->userId);

					$update = $obj_product->updatePremiumPhotoGuestId($dateArr,$_SESSION['guestUserId'],$obj_product->tblpremiumorder);

					$update2 = $obj_product->updatePremiumPrintPhotoGuestId($dateArr,$_SESSION['guestUserId'],$obj_product->tblpremiumphoto);

					$update3 = $obj_product->updateCartItemsGuestId($dateArr,$_SESSION['guestUserId'],$obj_product->tblcart);

					

				



					$_SESSION['userId'] = $user_row->userId;



					$_SESSION['userFname'] = $user_row->userFname;



					$_SESSION['userEmail'] = $user_row->userEmail;



					echo 'login sucessful'; exit;

				}

				else

				{

					$userotpstatus_result = $obj_users->check_userotpStatus($login_email, $encrypted);

					if($db->numRows($userotpstatus_result)>0){

						echo 'deactivate'; exit;

					}

					else

					{

						while($userotpReslutData = $db->fetchNextObject($user_result)){



							$userId =  $userotpReslutData->userId;



							 $userFname = $userotpReslutData->userFname;

							 

							 $userPhone = $userotpReslutData->userPhone;

							 

							 $otp = $userotpReslutData->otp;

		

						}

						include('sms/sms-otpSend-Register.php');

						

						echo $userId."@@@resend otp";

					}

					

				}

				



		}else{

					echo 'invalid username or password'; exit;



		}



	}



	else{



		echo 'invalid username or password'; exit;



	}

}



if(isset($action) && $action == 'otpCheck_login'){



		$response = '';



		if($userOTP != '' && $userId != ''){



			$userReslut = $obj_users->check_user_otp($userId , $userOTP);



			if($db->numRows($userReslut)>0)

			{

				

			

				

			$dataArr = array('otpStatus'=>'1' ,'userStatus'=>'1');



			$forgot_password=$obj_users->updateuser($dataArr, $userId, $obj_users->tbl_user);

			

			while($userReslutData = $db->fetchNextObject($userReslut)){

				

				$userEmail = $userReslutData->userEmail;

				$userFname = $userReslutData->userFname;

				

				$_SESSION['userId'] =$userId ;

				$_SESSION['userEmail'] = $userEmail;

				$_SESSION['userFname'] = $userFname;

				

			}

			

			

			include('email/email-complete-signup.php');

				

			$response = 1;

			}

			else

			{



				$response = 0;

			}

		}



		echo $response; exit;



	}



if(isset($action) && $action == 'lost_password'){



		if($email != "" && isset($email)){



			$userReslut = $obj_users->get_user_by_email($email);







			if($db->numRows($userReslut)>0)



			{



				while($userReslutData = $db->fetchNextObject($userReslut)){



					$uid =  $userReslutData->userId;



					 $uFname = $userReslutData->userFname;



				}

				



				$userId = base64_encode(base64_encode($uid));



				



				include('email/email-forgot-password.php');



				echo "message sent";



			}



			else



			{



				echo "not_exist";



			}



		}}





if(isset($action) && $action == 'forgotSet_pass'){



		if($userPassword != "" && isset($userPassword) && $userId != "" && isset($userId)){

			

			$dataArrayForgotPwd = array('userPassword'=>base64_encode(base64_encode($userPassword)));



			$forgot_password=$obj_users->updateuser($dataArrayForgotPwd, $userId, $obj_users->tbl_user);



			echo "1";



		}}

		

if(isset($action) && $action == 'user_updation'){

	

		$userImage=$old_image;



		if($_FILES['userImage']['name']!=""){



   			$userImage=$currentTimestamp.$_FILES['userImage']['name'];



   			$user_img_path = VNT_FOLDER_ROOT.'userfiles/user_img/'.$userImage;



   			move_uploaded_file($_FILES['userImage']['tmp_name'], $user_img_path);



  		}

	



			$userId = $_SESSION['userId'];

			

			$dataArray = array('userFname'=>$userFname,

										'userLname'=>$userLname,

										'userPhone'=>$userPhone,

										'userDob'=>$userDob,

										'userGender'=>$userGender,

										'userProfileImg'=>$userImage,

										);



			$updateUser=$obj_users->updateuser($dataArray, $userId, $obj_users->tbl_user);



			echo "1";



		}		

		

if(isset($action) && $action == 'change_pass'){



		if($userPassword != "" && isset($userPassword) && $userId != "" && isset($userId)){

			

			$dataArrayForgotPwd = array('userPassword'=>base64_encode(base64_encode($userPassword)));



			$forgot_password=$obj_users->updateuser($dataArrayForgotPwd, $userId, $obj_users->tbl_user);



			echo "1";



		}

}		



if(isset($_SESSION["userId"]) && !empty($_SESSION["userId"])){

	if(isset($action) && $action == "reviewRating"){

		if(isset($review) && $review != ""){

			$user_id=!empty($_SESSION["userId"]) ? $_SESSION["userId"] : "";

			$rating=!empty($rating) ? $rating : '';

			$review=!empty($review) ? $review : '';

			$status=0;

			$created=date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))));

			$modified=date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))));

			$insertQuery = "Insert into `reviews` (user_id, rating, review, status, created, modified) Values (".$user_id.", '".$rating."', '".$review."', '".$status."', '".$created."', '".$modified."')";

			if(mysql_query($insertQuery)){

				echo "Success";

			} else {

				echo "Some thing went wrong with reviews.";

			}

		} else {

			echo "Please fill review area properly.";

		}

	}		

}



if(isset($action) && $action="updateUserProfile"){

	unset($_SESSION["comingFrom"]);

	unset($_SESSION['userName']);

	unset($_SESSION['userEmail']);

	

	$query = "Select * from `user_master` where `user_master`.`userEmail` = '". $email."'";

	$getUserDetailResource = mysql_query($query);

	$userDetail = mysql_fetch_assoc($getUserDetailResource);

	$userId = $userDetail["userId"];

	$dateOfBirth = date("Y-m-d", strtotime($userDob));

	$otp=rand(1111, 9995);

	$updateQuery = "Update `user_master` set `userPhone` = '".$userPhone."', `userDob` = '".$dateOfBirth."', `otp` = '".$otp."',`userGender` = '".$userGender."' where `userId`=".$userId;

	if(mysql_query($updateQuery)){

		include('sms/sms-otpSend-Register.php');

		echo $userId."@@@userId";

	}

}

		

?>


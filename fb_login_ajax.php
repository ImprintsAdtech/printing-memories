<?php
include_once("conf/loadconfig.inc.php");
	$currentTimestamp = getCurrentTimestamp();
	session_start();
	extract($_POST);
	extract($_GET);
	$obj_users = new Usermanager();
	$obj_product = new Photomanager();
	
	function slugUrl($str) {
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
		$clean = strtolower(trim($clean, ''));
		$clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
		return $clean;

	}

	if ($loginwith == "facebook") {
	
		$name	 	 =	$_POST['name'];
		$email		=	$_POST['email'];
		$lastName	 =	$_POST['last_name'];
		$outh_id	  =	$_POST['outh_id'];
		$gender	   =	$_POST['gender'];
		$userImage	=	$_POST['picture']['data']['url'];
		$loginwith	=	$_POST['loginwith'];
				
				$title = $name." ".$lastName;

				$userSlug=slugUrl($title);

				$sql_query="SELECT * FROM user_master WHERE userSlug='".$userSlug."'";

				$sql_run=mysql_query($sql_query);

				$result_slug=mysql_fetch_array($sql_run);

				

				if($result_slug['userSlug']!=''){
					$sql_query="SELECT max(slugId) AS slugId, userSlug FROM `user_master` WHERE userSlug='".$userSlug."'";
					$sql_run=mysql_query($sql_query);
					$result_slug=mysql_fetch_array($sql_run);
						if($result_slug['slugId']!=0){
							$slugId =$result_slug['slugId']+1;
						}
						else{
							$slugId='2';
						}
				}
				else{
				}
				if($slugId!=''){
					$slugIdn='-'.$slugId;
				}
				else{
					$slugIdn='';
				}
				 $finalSlug=$userSlug.$slugIdn;
				 
			

	    	$gender_new = "";
			if($gender == "male"){
				$gender_new = "M";	
			} else if($gender == "female") {
				$gender_new = "F";	
			}
			$outh_id;
			
			$fb_sql="SELECT * FROM user_master WHERE userEmail = '".$email."' AND facebook_id='".$outh_id."' And otpStatus = '1'";
	 		$prev_query = mysql_query($fb_sql);
			if (mysql_num_rows($prev_query) > 0) {

                while ($row = mysql_fetch_array($prev_query)) {
                	unset($_SESSION['comingFrom']);

                    $_SESSION['userId']    = $row['userId'];
                    $_SESSION['userFname']  = $row['userFname'];
                    $_SESSION['userEmail'] = $row['userEmail'];
                    $_SESSION['isReferar'] = 1;
					
					echo "fblogin";

                }
	            $update = mysql_query("UPDATE user_master SET facebook_id = '" . $outh_id . "', userEmail = '" . $email . "', userFname = '" . $name . "', userGender = '" . $gender_new . "' , userLname = '" . $lastName . "',userFacebookImage='" . $userImage . "' WHERE userId = '" .$row['userId']. "'");

            } else {
				
				$sql_queryelse="SELECT * FROM user_master WHERE userEmail = '".$email."' AND facebook_id='".$outh_id."'";
				
            	$query = mysql_query($sql_queryelse);
				$result_fetch=mysql_fetch_assoc($query);
				
				mysql_num_rows($query);
				//print_r($result_fetch);
            	if (mysql_num_rows($query)==0) {
					

	                $date = date("Y-m-d H:i", strtotime('330 min', strtotime(gmdate("Y/m/d h:i:s A"))));
					
					$sql_query="INSERT INTO user_master SET facebook_id = '" . $outh_id . "', userEmail = '" . $email . "', userFname = '" . $name . "', userLname = '" . $lastName . "',userGender = '" . $gender_new . "', 
					userSlug= '" . $userSlug . "',finalSlug= '" . $finalSlug . "', slugId= '0', userFacebookImage='" . $userImage . "', createDatetime ='" . $date . "', otpStatus='0',  userStatus= '0'";
					
					mysql_query($sql_query);

	                $userFId = mysql_insert_id();
					
					$_SESSION['userFId']    = $userFId;
	                $_SESSION['userFname']  = $name;
	                $_SESSION['userEmail']  = $email;
	                $_SESSION['comingFrom'] = "facebook";
					
					echo "fblogin";

	            } else {
										
	            	$_SESSION['userFId']  = $result_fetch['userId'];
					$_SESSION['userFname']  = $name;
	                $_SESSION['userEmail'] = $email;
	                $_SESSION['comingFrom'] = "facebook";
					
					echo "fblogin";

	            }

	        }

	    } 
		

?>
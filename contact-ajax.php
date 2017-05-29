<?php

include_once("conf/loadconfig.inc.php");
$currentTimestamp = getCurrentTimestamp();
	session_start();
	extract($_POST);
	extract($_GET);
	$obj_users = new Usermanager();

if(isset($action) && $action == 'contact_form'){


				$dataArray = array('contactName'=>$contactName,
									'contactEmail'=>$contactEmail,
									'contactSubject'=>$contactSubject,
									'contactNumber'=>$contactNumber,
									'contactCity'=>$contactCity,
									'contactMessage'=>$contactMessage,
									'createdDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A")))),
									);

				$last_inserted = $obj_users->insertContactInfo($dataArray,$obj_users->tbl_contact);
				
				
				include('email/email-contact-form.php');
				echo "1";

				

}
?>
<?php

include_once("conf/loadconfig.inc.php");

	session_start();

	extract($_POST);

	extract($_GET);

	$obj_users = new Usermanager();

	$obj_product = new Productmanager();

$currentTimestamp = getCurrentTimestamp();


$_SESSION[userId];

$userDetail = $obj_users->get_user_by_idfront($_SESSION[userId]);

//echo "<pre>";
//print_r($userDetail);

if(isset($_SESSION['userId']) && $_SESSION['userId'] != "")

{ 

?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Printmysnap - Free Photos for Lifetime | User Profile</title>
<link rel="stylesheet" href="<?=DEFAULT_URL_MAIN?>css/jquery-ui.css">
<?php 

		include('includes/common_css.php');

		include('includes/header.php');

?>

<div class="cp-inner-banner">
  <div class="container">
    <div class="cp-inner-banner-outer">
      <h2>Register with Print My Snap</h2>
      
      <!-- <ul class="breadcrumb">

                <li><a href="<?//=DEFAULT_URL?>">Home</a></li>

                <li class="active">Signup</li>

            </ul> --> 
      
    </div>
  </div>
</div>
<div class="cp-main-content">
  <section class="cp-signup-section pd-tb60">
    <div class="container">
      <div class="cp-signup-form">
        <form id="update-form">
          <div class="row">
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-pencil prefix"></i>
                <input type="text" id="userFname" value="<?=$userDetail->userFname?>" name="userFname" required class="validate">
                <label>First Name</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-pencil prefix"></i>
                <input type="text" id="userLname" value="<?=$userDetail->userLname?>" name="userLname" required class="validate">
                <label>Last Name</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-envelope prefix"></i>
                <input id="userEmail" name="userEmail" value="<?=$userDetail->userEmail?>" readonly type="text">
                <label>Email</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-phone-square prefix"></i>
                <input type="tel"  id="userPhone" name="userPhone" readonly value="<?=$userDetail->userPhone?>" class="validate" required>
                <label>Contact Number</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-calendar prefix"></i>
                <input type="text"  id="userDob" name="userDob" value="<?php echo date('d-m-Y', strtotime($userDetail->userDob))?>" class="validate" required>
                <label>Date of Birth</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-male prefix"></i> <span class="radio-inline" style="margin-top: 30px;">
                <input type="radio" name="userGender" <?php if($userDetail->userGender == "M"){ echo "checked"; }?> id="userGender" value="M">
                Male </span> <span class="radio-inline" style="margin-top: 30px;">
                <input type="radio" <?php if($userDetail->userGender == "F"){ echo "checked"; }?> name="userGender" id="userGender" value="F">
                Female </span>
                <label>Gender</label>
              </div>
            </div>
            <?php /*?><div class="col-md-12">

                    	<div class="input-field">

                    

                            <i class="fa fa-picture-o prefix"></i>

                            

                            <input type="file" id="userImage" name="userImage" />

                            <input type="hidden" name="old_image" value="<?=$userDetail->userProfileImg ?>" />



								<?php

                                if($userDetail->userProfileImg!=''){

                                    ?>

                                   <img style="margin: 10px;" src="<?=DEFAULT_URL_MAIN?>userfiles/user_img/<?=$userDetail->userProfileImg;?>" width="80" height="80" /> 

                                    <?php 

                                 }

                                ?>

                            <label>Profile Image</label>

                    

                   		 </div>

                    </div><?php */?>
            <div class="col-md-12 col-sm-12">
              <div class="input-field btn-holder">
                <input type="hidden" name="action" value="user_updation" />
                <button class="btn-submit" href="javascript:void(0)" id="btn_update" type="button">Update</button>
              </div>
            </div>
            <div class="col-md-12 col-sm-12"> <strong class="login-btn"><a href="<?=DEFAULT_URL?>/change-password">Change Password</a></strong> </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
<?php

	include('includes/footer.php');

	include('includes/common_js.php');

	include('includes/home_script.php');

	}

else

{

header('Location: '.DEFAULT_URL);	

}

$yearbackDate=(date('Y'));

?>
<script type="text/javascript" src="<?=DEFAULT_URL_MAIN?>js/jquery-ui-datepicker.js"></script> 
<script>
	$(function() {
	var date = $('#userDob').datepicker({ dateFormat: 'dd-mm-yy', 
		changeMonth: true,
	    changeYear: true,
		yearRange: "1950:<?=$yearbackDate?>" }).val();

	});

</script>
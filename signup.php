<?php
include_once("conf/loadconfig.inc.php");
if(!isset($_SESSION['userId']) && $_SESSION['userId'] == ""){ 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Printmysnap - Free Photos for Lifetime | Sign up</title>
<link rel="stylesheet" href="<?=DEFAULT_URL_MAIN?>css/jquery-ui.css">
<?php 
		include('includes/common_css.php');
		include('includes/header.php');
?>

<div class="cp-inner-banner">
  <div class="container">
    <div class="cp-inner-banner-outer">
      <h2>Register with Printmysnap</h2>
    </div>
  </div>
</div>
<div class="cp-main-content">
  <section class="cp-signup-section pd-tb60">
    <div class="container">
      <div class="cp-signup-form">
        <form id="register-form">
          <div class="row">
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-pencil prefix"></i>
                <input type="text" id="userFname" name="userFname" required class="validate">
                <label>First Name</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-pencil prefix"></i>
                <input type="text" id="userLname" name="userLname" required class="validate">
                <label>Last Name</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-envelope prefix"></i>
                <input id="userEmail" name="userEmail" type="text" required class="validate">
                <div class="errorMessage help-block" id="email_errors"></div>
                <input type="hidden" value="1" id="check_email_user_result" name="check_email_user_result">
                
                <label>Email</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-unlock prefix"></i>
                <input type="password" id="userPassword" name="userPassword" class="validate" required>
                <label>Password</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-unlock prefix"></i>
                <input type="password"  id="userConfirmPassword" name="userConfirmPassword"  class="validate" required>
                <label>Confirm Password</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-phone-square prefix"></i>
                <input type="tel"  id="userPhone" name="userPhone" class="validate" required>
                <div class="errorMessage help-block" id="phone_errors"></div>
                <input type="hidden" value="1" id="check_user_result" name="check_user_result">
                <label>Mobile Number</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-calendar prefix"></i>
                <input type="text"  id="userDob" name="userDob" class="validate" required>
                <label>Date of Birth</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-male prefix"></i> <span class="radio-inline" style="margin-top: 30px;">
                <input type="radio" name="userGender" checked id="userGender" value="M">
                Male </span> <span class="radio-inline" style="margin-top: 30px;">
                <input type="radio" name="userGender" id="userGender" value="F">
                Female </span>
                <label>Gender</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="input-field checkbox">
                <label>
                  <input id="terms_checkbox" name="terms_checkbox" type="checkbox">
                  I've Read <a href="terms-condition.php" target="_blank">Terms & Conditions</a> </label>
              </div>
            </div>
            <div class="col-md-12 col-sm-12">
              <div class="input-field btn-holder">
                <input type="hidden" name="action" value="user_registration" />
                <button class="btn-submit" href="javascript:void(0)" id="btn_register" type="button">Signup</button>
              </div>
            </div>
            <div class="col-md-12 col-sm-12"> <strong class="login-btn">Already have an Account? <a href="<?=DEFAULT_URL?>/login">LOGIN NOW</a></strong> </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
<a style="display:none;" data-backdrop="static" data-keyboard="false" aria-hidden="true"  id="viewmodal" data-toggle="modal" data-target="#otp-popup" href="javascript:void(0)">otp</a>
<div class="modal fade" id="otp-popup" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    
    <div class="modal-content">
      <div class="modal-header"> 
        
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>-->
        
        <h4 class="modal-title">Please enter otp</h4>
      </div>
      <div class="modal-body">
        <form id="otp-form">
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-field"> <i class="fa fa-phone-square prefix"></i>
                <input type="text" placeholder="OTP" id="userOTP" name="userOTP" class="validate" required>
                <label>Enter OTP</label>
              </div>
            </div>
            <input type="hidden" id="userId" name="userId" class="form-control">
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-field"> <a href="javascript:void(0);" onclick="resendOtp()" class="btn btn-info" id="resendLink">Resend OTP</a> </div>
            </div>
          </div>
          <input type="hidden" name="action" id="action" value="user_registration_otp" />
          <div class="col-sm-12 controls" style="padding-left:0px !important; margin-top:10px;">
            <div class="login_message error_msg" id="otp_errors"></div>
            <button class="btn-submit" href="javascript:void(0)" id="btn_register_otp" type="button"><i class="glyphicon glyphicon-log-in"></i> Submit</button>
          </div>
        </form>
        <div class="clearfix"></div>
      </div>
      
      <!-- <div class="modal-footer">



          <button type="button" class="btn-submit" data-dismiss="modal">Close</button>



        </div>--> 
      
    </div>
  </div>
</div>
<?php
	include('includes/footer.php');
	include('includes/common_js.php');
	include('includes/home_script.php');

} else {



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
<?php
session_start();
include_once("conf/loadconfig.inc.php");
require 'mail/PHPMailerAutoload.php';
extract($_POST);
extract($_GET);
$obj_product = new Productmanager();
$currentTimestamp = getCurrentTimestamp();
$uId;

$userId = base64_decode(base64_decode($uId));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Printmysnap | Forgot Password</title>
<?php 
		include('includes/common_css.php');
		include('includes/header.php');
?>
 



<div class="cp-inner-banner">
    <div class="container">
        <div class="cp-inner-banner-outer">
            <h2>Forgot Password</h2>
            <!--<ul class="breadcrumb">
                <li><a href="<?=DEFAULT_URL?>">Home</a></li>
                <li class="active">Forgot Password</li>
            </ul> -->
        </div>
    </div>
</div>

 

 

<div class="cp-main-content">
    <section class="cp-signup-section pd-tb60">
        <div class="container">
            <div class="cp-signup-form">
            	<?php
				if($uId == "")
				{
				?>
                    <form id="forgotemail-form" class="forgotemail-form">
                        <div class="row">
                        
                            <div class="col-md-12">
                            
                                <div class="input-field">
                                
                                <i class="fa fa-user prefix"></i>
                                
                                <input id="lost_email" tabindex="1"  name="lost_email" type="text" required pattern="^[a-zA-Z0-9-\_.]+@[a-zA-Z0-9-\_.]+\.[a-zA-Z0-9.]{2,5}$" class="validate">
                                
                                <label>Email</label>
                                
                                </div>
                            
                            </div>
                            
                            <div class="col-md-12 col-sm-12">
                            
                                <div class="input-field btn-holder">

                                    <div class="fpassword_message error_msg displaynone" id="fpassword_message">Invalid Email</div>
                                   <div class="fpass_msg success_msg displaynone" id="fpass_msg">Check your mail</div>
                                
                                
                                <button  id="lost_password" tabindex="3" type="button" class="btn-submit lost_password" value="Submit">Submit</button>
                                
                                </div>
                            
                            </div>
                            
    
                        
                        </div>
                    </form>
                <?php
				}
				else
				{
				?>	
                
              	  <form id="forgot-form" class="forgot-form">
                        <div class="row">
                        
                             <div class="col-md-12">
                                <div class="input-field">
                            
                                    <i class="fa fa-unlock prefix"></i>
                                    
                                    <input type="password" id="userPassword" name="userPassword" class="validate" required>
                                    
                                    <label>Password</label>
                            
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="input-field">
                            
                                    <i class="fa fa-unlock prefix"></i>
                                    
                                    <input type="password"  id="userConfirmPassword" name="userConfirmPassword"  class="validate" required>
                                    
                                    <label>Confirm Password</label>
                            
                                </div>
                            </div>
                            
                            <div class="col-md-12 col-sm-12">
                            
                                <div class="input-field btn-holder">
                                <input type="hidden" name="userId" id="userId" value="<?=$userId?>" />

                                   <div class="fpass_msg success_msg displaynone" id="frgtpass_msg">Password changed successfully</div>
                                
                                
                                <button  id="forgotnew_password" tabindex="3" type="button" class="btn-submit forgotnew_password" value="Submit">Submit</button>
                                
                                </div>
                            
                            </div>
                            
    
                        
                        </div>
                    </form>
                
				<?php	
				}
				?>
            </div> 
        </div>
    </section> 
</div>

 

 <?php
	include('includes/footer.php');
	include('includes/common_js.php');
	include('includes/home_script.php');
?>
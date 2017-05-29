<?php
session_start();
include_once("conf/loadconfig.inc.php");
extract($_POST);
extract($_GET);
$obj_product = new Productmanager();
$currentTimestamp = getCurrentTimestamp();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Photo Print Studio | Forgot Password</title>
<?php 
		include('includes/common_css.php');
		include('includes/header.php');
?>
 



<div class="cp-inner-banner">
    <div class="container">
        <div class="cp-inner-banner-outer">
            <h2>Forgot Password</h2>
<!--            <ul class="breadcrumb">
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
            	
                
              	  <form id="changepass-form" class="changepass-form">
                        <div class="row">
                        
                             <div class="col-md-12">
                                <div class="input-field">
                            
                                    <i class="fa fa-unlock prefix"></i>
                                    
                                    <input type="password" id="userPassword_new" name="userPassword_new" class="validate" required>
                                    
                                    <label>New Password</label>
                            
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="input-field">
                            
                                    <i class="fa fa-unlock prefix"></i>
                                    
                                    <input type="password"  id="userConfirmPassword_new" name="userConfirmPassword_new"  class="validate" required>
                                    
                                    <label>Confirm Password</label>
                            
                                </div>
                            </div>
                            
                            <div class="col-md-12 col-sm-12">
                            
                                <div class="input-field btn-holder">
                                <input type="hidden" name="userId_new" id="userId_new" value="<?=$_SESSION['userId']?>" />

                                   <div class="cpass_msg success_msg displaynone" id="changepass_msg">Password changed successfully</div>
                                
                                
                                <button  id="change_password" tabindex="3" type="button" class="btn-submit change_password" value="Submit">Submit</button>
                                
                                </div>
                            
                            </div>
                            
    
                        
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
?>
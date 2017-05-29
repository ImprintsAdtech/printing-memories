<?php
include_once("conf/loadconfig.inc.php"); 
$obj_product = new Photomanager();
$currentTimestamp = getCurrentTimestamp();
session_start();

//echo "hello";
//echo "<pre>";

//print_r($_SESSION);

//print_r($_POST);
//exit;
if(isset($_SESSION["redirect_url"]) && !empty($_SESSION["redirect_url"])){
  $redirectUrl = DEFAULT_URL.$_SESSION["redirect_url"];
}
if(isset($_SESSION['isReferar']) && $_SESSION['isReferar']==1){
    unset($_SESSION['isReferar']);
    header("Location: ".$redirectUrl);
}
$guest_userId = rand(1000,100000);

if($_SESSION['guestUserId'] == "" && !isset($_SESSION['guestUserId']) && $_SESSION['userId'] == "" && !isset($_SESSION['userId'])){
  $_SESSION['guestUserId'] = $guest_userId;
}
if($_SESSION['userId'] != "" && isset($_SESSION['userId'])){
	unset($_SESSION['comingFrom']);
}

//echo $_SESSION['guestUserId'];

?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Printmysnap - FREE PHOTOS</title>
<?php 
	include('includes/common_css.php');
  	include('includes/common_js.php');
	include('includes/header.php');



?>
<input type="hidden" id="redirectUrl" value="<?php echo !empty($redirectUrl) ? $redirectUrl : '' ; ?>">
<div id="homev1-slider" class="owl-carousel">
  <div class="item">
    <div class="cp-slider-thumb"><img src="images/h1-slide1.jpg" alt=""></div>
    <div class="cp-slider-content">
      <h2>Every photo has a story</h2>
      <strong>Print yours...</strong><br>
      
      <!-- <a href="#" class="googleplaystore"></a> --> <a href="#shopFree" class="shopnow"></a></div>
  </div>
  <div class="item">
    <div class="cp-slider-thumb"> <img src="images/h1-slide2.jpg" alt=""> </div>
    <div class="cp-slider-content">
      <h2>Kingdom of Free Prints</h2>
      <strong>Free upto your doorstep</strong><br>
      
      <!-- <a href="#" class="googleplaystore"></a> --> <a href="#shopFree" class="shopnow"></a> </div>
  </div>
  <div class="item">
    <div class="cp-slider-thumb"> <img src="images/h1-slide3.jpg" alt=""> </div>
    <div class="cp-slider-content">
      <h2>Print Memories</h2>
      <strong>Print Happiness</strong><br>
      
      <!-- <a href="#" class="googleplaystore"></a> --> <a href="#shopFree" class="shopnow"></a> </div>
  </div>
  <div class="item">
    <div class="cp-slider-thumb"> <img src="images/h1-slide4.jpg" alt=""> </div>
    <div class="cp-slider-content">
      <h2>Free Photo World</h2>
      <strong>Print your memories, make them last</strong><br>
      
      <!-- <a href="#" class="googleplaystore"></a> --> <a href="#shopFree" class="shopnow"></a> </div>
  </div>
</div>
<div class="clearfix"></div>
<div class="container">
  <?php /*?><div class="text-center" style="padding:20px;"><h4>your photos shall be deleted automatically after prints are generated....your contact details shall not be used for tele-marketing or shared with anyone in any manner whatsoever...the system you are accessing is secure.</h4></div><?php */?>
</div>
<div class="cp-main-content">
  <section class="cp-Our-experties pd-tb60">
    <div class="container">
      <div class="cp-section-title">
        <h2>Free Prints</h2>
        <strong>Priceless moments deserve price-less prints. Yes, the word is PRICE-LESS.<br>
        These free prints are delivered absolutely free to your doorsteps. Print & rejoice.<br>
        You can order one category from this section each month......every month.</strong> </div>
      <div class="cp-ex-slider row" id="shopFree">
        <?php
		$freeProducts = $obj_product->getAllActiveFreeProduct();
		if($db->numRows($freeProducts)>0){
			$i=1;
			while($freeproductData = $db->fetchNextObject($freeProducts)){
			?>
        <div class="col-md-4 col-sm-6">
          <div class="slide homepdlink">
            <div class="cp-thumb"> <img src="<?=DEFAULT_URL?>/userfiles/product_img/<?=$freeproductData->productImage?>" alt="Images"> <a href="<?=DEFAULT_URL?>/product/<?=$freeproductData->finalSlug?>">
              <div class="cp-hover-content">
                <p>
                  <?=$freeproductData->productShortDesc?>
                </p>
                <p><strong>Read More</strong></p>
              </div>
              </a> </div>
            <a href="<?=DEFAULT_URL?>/product/<?=$freeproductData->finalSlug?>" class="fdds">
            <div class="cp-ex-title">
              <h3>
                <?=$freeproductData->productTitle?>
              </h3>
            </div>
            </a> </div>
        </div>
        <?php	
			}
	}
?>
      </div>
    </div>
  </section>
  <section class="cp-banner-newsltter pd-t30">
    <div class="container">
      <div class="row" style="margin-bottom: 30px">
        <div class="col-md-12">
          <div class="pro-banner"><a href="http://www.myinstaprint.in"><img src="images/mipbanner1.jpg" alt=""></a></div>
        </div>
      </div>
    </div>
  </section>
  <section class="cp-Our-experties pd-tb60">
    <div class="container">
      <div class="cp-section-title"> <a name="shopnows"></a>
        <h2>Paid Prints & Products</h2>
        
        <!-- <strong> Morlem ipsum dolor sit amet, vesena tomosi elit. Ut elit tellus luctus nec.</strong> --> 
        
      </div>
      <div class="cp-ex-slider row">
        <?php
				$paidProducts = $obj_product->getAllActivePaidProduct();
				if($db->numRows($paidProducts)>0){
					$i=1;
					while($paidproductData = $db->fetchNextObject($paidProducts)){?>
        <div class="col-md-4 col-sm-6">
          <div class="slide homepdlink">
            <div class="cp-thumb"> <img style="height: 270px;" src="<?=DEFAULT_URL?>/userfiles/product_img/<?=$paidproductData->productImage?>" alt="Images">
              <div class="cp-hover-content">
                <h3 style="font-size:60px; color:#fff;">Coming Soon</h3>
                <?php //echo $paidproductData->productShortDesc?>
                <?php /* ?> <?php
                    if($paidproductData->finalSlug == "snapbooks"){
                    ?>
                        <a href="<?=DEFAULT_URL?>/snapbook_product/<?=$paidproductData->finalSlug?>">Read More</a>
                    <?php
					} else if($paidproductData->finalSlug == "photostrips") {
						?>
                        <a href="<?=DEFAULT_URL?>/photostrip_product/<?=$paidproductData->finalSlug?>">Read More</a>
                    <?php
					} else {

					?>

                    	<a href="<?=DEFAULT_URL?>/premium_product/<?=$paidproductData->finalSlug?>">Read More</a>

                    <?php
					}
					?><?php */ ?>
              </div>
            </div>
            <?php /*?> <?php
					if($paidproductData->finalSlug == "snapbooks") {
					?>
                        <a href="<?=DEFAULT_URL?>/snapbook_product/<?=$paidproductData->finalSlug?>" class="fdds">
                    <?php
                    } else if($paidproductData->finalSlug == "photostrips") {
                    ?>
                        <a href="<?=DEFAULT_URL?>/photostrip_product/<?=$paidproductData->finalSlug?>" class="fdds">
                    <?php
                    } else {
                    ?>
                    <a href="<?=DEFAULT_URL?>/premium_product/<?=$paidproductData->finalSlug?>" class="fdds">
                    <?php   

                    }

                    ?><?php */ ?>
            <div class="cp-ex-title">
              <h3>
                <?=$paidproductData->productTitle?>
              </h3>
            </div>
            
            <!-- </a>    --> 
            
          </div>
        </div>
        <?php	


			}

	}
?>
      </div>
    </div>
  </section>
  <section class="cp-clients-section pd-t60">
    <div style="display:none"> </div>
    <div class="container">
      <h2>Satisfied Clients</h2>
      <div class="cp-clients-inner">
        <div id="cp-testimonial-slider">
          <?php

		$obj_userManger= new userManager();

		$reviewResult= $obj_userManger->getAllReviewFront();

		while($review_row= $db->fetchNextObject($reviewResult)){

			$review=$review_row->review;

			$full_name=$review_row->userFname.' '.$review_row->userLname;

			$userFacebookImage=$review_row->userFacebookImage;

			$userGooleImage=$review_row->userGooleImage;

			

			if($userFacebookImage!=''){

				$user_image=$userFacebookImage;

				$user_image=

				

				$user_image = FB_IMG_URL_1.$review_row->facebook_id.FB_IMG_URL_2;

				

			}else if($userGooleImage!=''){

				$user_image=$userGooleImage;

			}else {

				$user_image="https://www.printmysnap.com/images/test-sm-thumb.jpg";

			}

			 $user_image;

			



?>
          <div class="item">
            <div class="cp-top">
              <div class="cp-sm-thumb"> <img src="<?php echo $user_image ?>" alt=""> </div>
              <h5><?php echo ucfirst($full_name);?></h5>
            </div>
            <p> <?php echo $review; ?></p>
          </div>
          <?php }?>
        </div>
        <div class="clearfix">&nbsp;</div>
        <p><a href="#" class="read-more" data-toggle="modal" data-target="#writeareview">Write a Review</a></p>
      </div>
    </div>
  </section>
  <section class="cp-wps pd-tb30">
    <div class="container">
      <div class="row"> 
        
        <!-- <h2 class="text-center">Who is Print Studio?</h2><br> --> 
        
      </div>
      <div class="row wps-banner">
        <div class="col-md-5 text-center"style="margin-left: -20px;">
          <h1 style="font-size:300%;color:white;">Why Prints</h1>
          <br>
          <p style="font-size:130%;color: white;">B'coz Happiness is <i>Priceless</i></p>
          <br>
          <br>
          <p><a class="read-more" href="https://www.printmysnap.com/why-print" style=" background-color: ghostwhite;"> Learn More </a></p>
        </div>
        <div class="col-md-7"></div>
      </div>
    </div>
  </section>
  <section class="cp-shello pd-tb30">
    <div class="container">
      <div class="row shello-banner">
        <div class="col-md-3 text-left" style="width:initial;margin-left: 100px;">
          <h1 style="font-size:300%;color:white;">Why Us?</h1>
          <br>
          <p style="color:blue;">Trying to find a reason to print with us... <br>
            Cost, Quality, Service, Delivery...just name it</p>
          <br>
          <p><a href="https://www.printmysnap.com/guarantee" class="read-more" style="background-color: powderblue;"> Learn More</a></p>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
  </section>
  <section class="cp-ostory pd-tb30">
    <div class="container">

      <div class="row ostory-banner">
        
  <div style="
    margin-top: -50px;
    margin-bottom: 50px;
    " class="col-md-5 text-center">
    <h1 style="font-size: 300%;color: rgba(241,91,95,1);">About Us</h1>
    <br>
      <p style="color: black;">Everyone has a story, read ours...</p>
      <br>
        <p><a href="https://www.printmysnap.com/about-us" class="read-more" style="background-color: rgba(255,255,255,0.9);">About Us</a></p>
  </div>
</div>

    </div>
  </section>
  <section class="cp-about-section guaranteedbg pd-tb60">
    <div class="container">
      <div class="row">
  <div class="col-md-12 text-center"> 
	<img src="https://www.printmysnap.com/images/new100logo1.png" alt="" width="250" height="250">

        </div>
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
?>
<script>







jQuery("#reviewRatingForm").on("submit", function(e){







    e.preventDefault();







    var $reviewForm = jQuery("#reviewRatingForm");







    jQuery.ajax({







        type: "POST",







        url: "<?=DEFAULT_URL?>/home_ajax.php",







        data: $('form#reviewRatingForm').serialize(),







        success:function(data){







            if(data=="Success"){







                window.location.href = '<?=DEFAULT_URL?>';







            } else {







                $('.preloader').css('display','none');







                jQuery('#error-modal').addClass('modal-show');







                jQuery("#alert-message").html(data);







            }







        }







    });







});







</script>
<?php 







if(isset($_SESSION["comingFrom"]) && ($_SESSION["comingFrom"]=="facebook" || $_SESSION["comingFrom"]=="gmail")){







    $yearbackDate=(date('Y'));







?>
<script type="text/javascript" src="<?=DEFAULT_URL_MAIN?>js/jquery-ui-datepicker.js"></script> 
<script>



    jQuery(document).ready(function(){



            var date = $('#userDateOfBirth').datepicker({ 



                dateFormat: 'dd/mm/yy', 



                changeMonth: true,



                changeYear: true,



                yearRange: "1950:<?=$yearbackDate?>" 



            }).val();



            jQuery('#clickUpdateProfile').trigger('click');



            jQuery("#userPhone").on("blur", function(){



                $('.preloader').css('display','block');



                var phoneNumber = jQuery("#userPhone").val();



                var intRegex = /[0-9 -()+]+$/;



                if($(this).val() != ''){



                    if($(this).val().length >= 10 && intRegex.test(phoneNumber)) {



                        $('#phone_errors').html('');



                        $('#check_user_result').val(1);



                        //$('#register-form').loadingOverlay();     



                        $.ajax({



                            type: "POST",



                            url: "home_ajax.php",



                            data: {action:'check_phone', phoneNumber:$(this).val()},



                            success: function(responseText) {



                                //$('#register-form').loadingOverlay('remove');



                                $('.preloader').css('display','none');



                                if(responseText !='' && responseText == 1){



                                    jQuery('#phone_errors').css('display','block');



                                    jQuery('#phone_errors').html('Phone Number already exist');



                                    jQuery('#check_user_result').val(0); 



                               } else {



                                    jQuery('#phone_errors').html('');



                                    jQuery('#check_user_result').val(1); 



                                    jQuery("#btn_update_profile").removeAttr("style");



                                }



                            }



                        });



                    } else {



                        jQuery('.preloader').css('display','none');



                        jQuery('#phone_errors').html('Please enter a valid phone number');



                    }



                } else {



                    jQuery('.preloader').css('display','none');



                    jQuery('#phone_errors').html('Please enter phone number here');



                }               



            });



            jQuery("#btn_update_profile").on("click", function(){



                jQuery(".preloader").css("display", "block");



                var $updateProfileForm = jQuery("#updateUserProfile");



                jQuery.ajax({



                    type: "POST",



                    url: "<?=DEFAULT_URL?>/home_ajax.php",



                    data : $updateProfileForm.serialize(),



                    success:function(data){



                        $('.preloader').css('display','none');



                        var arr = data.split('@@@');



                        jQuery("#userId").val(arr[0]);



                        jQuery("#updateProfile").hide();
                        jQuery('#viewmodal').trigger('click');
                    }
                });
            });
        });
</script>
<?php    
}
?>
<script>
$(document).on('click','#btn_register_otp',function(e){
    $('.preloader').css('display','block');
    var userOTP = $.trim($('#userOTP').val());
    var userId = $.trim($('#userId').val());
    var redirectUrl = jQuery("#redirectUrl").val();
    if(userOTP != "" && userId != ""){
        $.ajax({
            type: "POST",
            url: "<?=DEFAULT_URL?>/home_ajax.php",
            data: {action:'otpCheck',userOTP:userOTP, userId:userId}, 
            success: function(response_add) {
                if(response_add != '' && response_add == 1){
                    window.location.href = redirectUrl;
                } else if(response_add != '' && response_add == 0){
                    $('.preloader').css('display','none');
                    $('#otp_errors').html('You OTP does not match. Try again');
                    setTimeout(function(){
                      $('#otp_errors').html('');
                    }, 2000);
                    return false;
                }
            }
        }); 
    } else {
        $('.preloader').css('display','none');
        $('#otp_errors').html('You OTP does not match. Try again');
        setTimeout(function(){
                      $('#otp_errors').html('');
                    }, 2000);
                    return false; 
    }
});



function resendOtp(){
  //e.preventDefault();
  $('.preloader').css('display','block');
  var userId = jQuery("#userId").val(); 
  jQuery.ajax({
    url: "<?=DEFAULT_URL?>/home_ajax.php",
    type:"POST",
    data:{userId:userId, action:"resendOtp"},
    success:function(response_add){
      if(response_add!=""){
        $('.preloader').css('display','none');
        $('#resendLink').html('Otp Resent, please check !');
        $('#resendLink').removeClass("btn-info");
        $('#resendLink').addClass("btn-success");
      }
    }
  });
}



</script> 

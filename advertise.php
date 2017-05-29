<?php
include_once("conf/loadconfig.inc.php"); 
$obj_product = new Productmanager();
$currentTimestamp = getCurrentTimestamp();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Printmysnap - Free Photos for Lifetime | Contact Us</title>
<?php 
		include('includes/common_css.php');
		include('includes/header.php');
?>
 
<div class="cp-inner-banner">
<div class="container">
<div class="cp-inner-banner-outer">
<h2>Advertise with Us</h2>
<!--<p class="white margnbot20">We're a group of artists, designers, and coders trying to answer the question "What can a company be, and what should it be?" One day the answer will be "Social Print Studio." Working on it since 2010!</p>-->
 
</div>
</div>
</div>
 
 
<div class="cp-main-content">

<section class="cp-contact-section pd-t60">
 
<div class="cp-contact-inner pd-b60">
<div class="container">
<div class="row">
<!--<h2 class="text-center margnbot50">Advertise</h2>-->
<div class="col-md-2"></div>
<div class="col-md-8">
 
<div class="cp-form-box">
<p>Printmysnap offers joyous photo prints connecting your precious brand with the sentimental memories and moments of your potential customers. We work on specific parameters to reach specific audience in order to promote and accelerate the visibility of your brand.</p><br>
<h3>Kindly fill the form to connect with us.</h3>
<div class="success-msg-contact" style="display:none">
<h2>Thank You</h2>
<p>We will connect with you shortly. Thank you</p>
</div>
<form action="" id="contact-form" class="contact-form" method="post">
<div class="row">
<div class="col-md-6 col-sm-6">
<div class="inner-holder">
<input type="text" placeholder="Business Name" name="contactName" id="contactName" required pattern="[a-zA-Z ]+">
</div>
</div>
<div class="col-md-6 col-sm-6">
<div class="inner-holder">
<input type="text" placeholder="Name" name="contactName" id="contactName" required pattern="[a-zA-Z ]+">
</div>
</div>
<div class="col-md-6 col-sm-6">
<div class="inner-holder">
<input type="text" placeholder="Contact no." name="contactCity" id="contactCity" required >
</div>
</div>
<div class="col-md-6 col-sm-6">
<div class="inner-holder">
<input type="text" placeholder="Your Email" name="contactEmail" id="contactEmail" required pattern="^[a-zA-Z0-9-\_.]+@[a-zA-Z0-9-\_.]+\.[a-zA-Z0-9.]{2,5}$">
</div>
</div>
<div class="col-md-12 col-sm-12">
<div class="inner-holder">
<input type="text" placeholder="Enquiry" name="contactSubject" id="contactSubject"  required pattern="[a-zA-Z ]+">
</div>
</div>
<div class="col-md-12 col-sm-12">
<div class="inner-holder">
<textarea placeholder="Message" name="contactMessage" id="contactMessage" required></textarea>
</div>
</div>
<div class="col-md-12 col-sm-12">
<div class="inner-holder cp-btn-holder">
<button type="button" class="btn-submit" id="contact-form-submit" value="Submit" name="contact-form-submit">Submit</button>
</div>
</div>
</div>
</form>
</div> 
</div>
<div class="col-md-2"></div>
<!-- <div class="col-md-4">
	 
	<div class="cp-contact-info">
		<h3>Customer Service</h3>
		<ul class="">
		<li><i class="fa fa-home"></i> 1234 N, Charles Street Balitomore, STN 00000</li>
		<li><i class="fa fa-phone"></i> +000 0000 0000</li>
		<li><i class="fa fa-envelope-o"></i> <a href="mailto:">info@demourl.com</a></li>
		</ul>
	</div> 
	 
	<div class="cp-contact-info">
		<h3>Soma Studio</h3>
		<ul class="">
		<li><i class="fa fa-home"></i> ABC, Avenue Corner Garnet Metro Manila Street</li>
		<li><i class="fa fa-phone"></i> +000 0000 0000</li>
		<li><i class="fa fa-envelope-o"></i> <a href="mailto:">info@demourl.com</a></li>
		</ul>
	</div> 
	 
	<div class="cp-contact-info cp-contact-info2">
		<h3>The Farm</h3>
		<ul class="">
		<li><i class="fa fa-home"></i> Cameron Road, Wirral Road Burgunday Block</li>
		<li><i class="fa fa-phone"></i> +000 0000 0000</li>
		<li><i class="fa fa-envelope-o"></i> <a href="mailto:">info@demourl.com</a></li>
		</ul>
	</div> 
</div>
 -->
</div>
</div>
</div> 
 
<!--<div class="cp-contact-map">
<div id="cp_map"></div>
</div>--> 
</section>

</div>
 
 <?php
	include('includes/footer.php');
	include('includes/common_js.php');
	include('contact-script.php');
?>
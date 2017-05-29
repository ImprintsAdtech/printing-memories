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
<title>Photo Print Studio | Sign up</title>
<?php 
		include('includes/common_css.php');
		include('includes/header.php');
?>
 
 
<div class="cp-inner-banner">
<div class="container">
<div class="cp-inner-banner-outer">
<h2>Print Studio</h2>
<!--<p class="white">by Print My Snap</p>
<p class="white margnbot20">The best way to print your mobile photos.</p>
 
<ul class="breadcrumb">
<li><a href="index.html">Home</a></li>
<li class="active">Get The App</li>
</ul>--> 
</div>
</div>
</div>
 
 
<div class="cp-main-content">

<section class="cp-process-section pd-tb60">
<div class="container">
<div class="row">
<div class="col-md-6 col-sm-6">
<div class="cp-process-box ">
<div class="cp-text text-right">
<i class="fa fa-star redtxt"></i><i class="fa fa-star redtxt"></i><i class="fa fa-star redtxt"></i><i class="fa fa-star redtxt"></i><i class="fa fa-star-half-full redtxt"></i>
<div class="clearfix"></div>
<h4>1777 Ratings</h4><br>
<img src="images/AppStore.svg" alt="img" class="app-link-img">
</div>
</div>
</div>

<div class="col-md-6 col-sm-6">
<div class="cp-process-box ">
<div class="cp-text text-left">
<i class="fa fa-star redtxt"></i><i class="fa fa-star redtxt"></i><i class="fa fa-star redtxt"></i><i class="fa fa-star redtxt"></i><i class="fa fa-star-half-full redtxt"></i>
<div class="clearfix"></div>
<h4>1990 Ratings</h4><br>
<img src="images/GooglePlay.svg" alt="img" class="app-link-img">
</div>
</div>
</div>
<div class="clearfix"></div>
<p class="text-center"><strong>Availible for iPhone, iPad, and Android</strong></p>

</div>
</div>
</section>

<section class="cp-process-section pd-tb60 rightapppic">
<div class="container">
<div class="row">
<h2 class="text-center margnbot10">How it works</h2>
<p class="text-center">Swipe right to prints.</p>

<div class="col-md-4 col-sm-6">
 
<div class="cp-process-box margntop60">
<div class="cp-text">
<h3>No Hassle Printing</h3>
<p>Create all your favorite Social Print Studio products from the comfort of your cell phone or tablet. You can choose from our curated line-up of Frames, Photobooks, Magnets and more, then print your photos without transferring them to your computer!</p>
<br>
<p>Create all your favorite Social Print Studio products from the comfort of your cell phone or tablet. You can choose from our curated line-up of Frames, Photobooks, Magnets and more, then print your photos without transferring them to your computer!</p>
</div>
</div> 
</div>
<div class="col-md-3 col-sm-6">
<img src="images/iphone_rose_meg.png" class="img-responsive"> 
</div>
<div class="col-md-5 col-sm-6"></div>

</div>
</div>
</section>

<section class="cp-process-section pd-tb60">
<div class="container">
<div class="row">
<h2 class="text-center margnbot10">SIMPLICITY AT ITS BEST</h2>
<p class="text-center">Here's how the magic happens:</p>

<div class="col-md-3 col-sm-6">
<div class="cp-process-box margntop60">
<div class="cp-text">
<img src="images/iphone_rose_meg.png" alt="img" class="img-responsive">
<h3>Browse</h3>
<p>Scroll through our curated print line-up.</p>
</div>
</div>

</div>

<div class="col-md-3 col-sm-6">
<div class="cp-process-box margntop60">
<div class="cp-text">
<img src="images/iphone_rose_meg.png" alt="img" class="img-responsive">
<h3>Pick a product</h3>
<p>Figure out how much wall space you need filled.</p>
</div>
</div>

</div>

<div class="col-md-3 col-sm-6">
<div class="cp-process-box margntop60">
<div class="cp-text">
<img src="images/iphone_rose_meg.png" alt="img" class="img-responsive">
<h3>Select your photos</h3>
<p>Choose from Instagram, iCloud, and mobile albums.</p>
</div>
</div>

</div>

<div class="col-md-3 col-sm-6">
<div class="cp-process-box margntop60">
<div class="cp-text">
<img src="images/iphone_rose_meg.png" alt="img" class="img-responsive">
<h3>Edit and Crop</h3>
<p>Get the perfect crop with our in-app editor.</p>
</div>
</div>

</div>

</div>
</div>
</section>

<section class="cp-process-section pd-tb60 whitebg">
<div class="container">
<div class="row">

<div class="col-sm-12">
<div class="cp-process-box">
<div class="cp-text text-center">
<img src="images/ApplePay.png" alt="img">
<h3>Speedy and Secure Checkout</h3>
<img src="images/Stripe_outline.png" alt="img">
</div>
</div>
</div>

</div>
</div>
</section>

<section class="cp-process-section pd-tb60">
<div class="container">
<div class="row">
<h2 class="text-center margnbot10">TRY IT NOW</h2>
<p class="text-center">Get the app</p>

<div class="col-md-6 col-sm-6">
<div class="cp-process-box margntop30">
<div class="cp-text text-right">
<img src="images/AppStore.svg" alt="img" class="app-link-img">
</div>
</div>

</div>

<div class="col-md-6 col-sm-6">
<div class="cp-process-box margntop30">
<div class="cp-text text-left">
<img src="images/GooglePlay.svg" alt="img" class="app-link-img">
</div>
</div>

</div>

</div>
</div>
</section>

</div>
 

 <?php
	include('includes/footer.php');
	include('includes/common_js.php');
?>
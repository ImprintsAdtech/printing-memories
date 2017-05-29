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
<title>Photo Print Studio | Photo Print</title>
<?php 
		include('includes/common_css.php');
		include('includes/header.php');
?>
 

<div class="cp-inner-banner">
<div class="container">
<div class="cp-inner-banner-outer">
<h2>Terms &amp; Conditions</h2>
<p class="white margnbot20">We're a group of artists, designers, and coders trying to answer the question "What can a company be, and what should it be?" One day the answer will be "Social Print Studio." Working on it since 2010!</p>

<ul class="breadcrumb">
<li><a href="index.html">Home</a></li>
<li class="active">Success</li>
</ul> 
</div>
</div>
</div>
 
 
<div class="cp-main-content">

<section class="cp-process-section pd-tb60">
<div class="container">
<div class="row">
<h2 class="text-center margnbot50">Thank you</h2>
<hr>
<div class="col-lg-12">
 
<div class="cp-process-box">
<div class="cp-text">
<p>Thank you for ordering product from Print My Snap.</p>



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
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

<title>Printmysnap - Free Photos for Lifetime | Why Printmysnap</title>

<?php 

		include('includes/common_css.php');

		include('includes/header.php');

?>

 

<div class="cp-inner-banner">

<div class="container">

<div class="cp-inner-banner-outer">

<h2>Why Printmysnap</h2>

<!--<p class="white margnbot20">We're a group of artists, designers, and coders trying to answer the question "What can a company be, and what should it be?" One day the answer will be "Social Print Studio." Working on it since 2010!</p>

 

<ul class="breadcrumb">

<li><a href="<?=DEFAULT_URL?>">Home</a></li>

<li class="active">PMS Values</li>

</ul> -->

</div>

</div>

</div>

 

 

<div class="cp-main-content">

 

<section class="cp-about-section pd-tb60">

<div class="container">

<div class="row">

<p align="center">Printmysnap ties a precious knot of love and emotions to turn your treasured memories into a priceless piece of art.</p>

<p align="center">3 simple steps of:</p>

<hr><h3 align="center">CLICK – UPLOAD – PRINT</h3><hr>

<p align="center">From your precious time, to avail priceless and unforgettable memories printed. Well presented, attractive and easy layout of our website and mobile application will help you shake hands with printmysnap. Our user friendly approach and fast processing model tags you as printmysnap’s friend.</p><br>



<p align="center">We combine your golden memories with high quality prints to enrich photo printing experience. Printmysnap serves as a perfect platter for photo prints at your doorstep with perfection, privacy and priceless approach. Printmysnap wardrobe offers variety of products across different photo sizes to immortalize your memories captured into beautiful frames and dress you up with a beautiful smile every single time.</p><br>



<p align="center">Still thinking……. Stop thinking and get into the world of glorious and memorilicious photo prints forever with printmysnap.</p>



</div>

</div>

</section>



</div>

 

 <?php

	include('includes/footer.php');

	include('includes/common_js.php');

?>
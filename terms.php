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

<title>Printmysnap - Free Photos for Lifetime | About us</title>

<?php 

		include('includes/common_css.php');

		include('includes/header.php');

?>

 

<div class="cp-inner-banner">

<div class="container">

<div class="cp-inner-banner-outer">

<h2>About Us</h2>

<!--<p class="white margnbot20">We're a group of artists, designers, and coders trying to answer the question "What can a company be, and what should it be?" One day the answer will be "Social Print Studio." Working on it since 2010!</p>

 

<ul class="breadcrumb">

<li><a href="index.html">Home</a></li>

<li class="active">About Us</li>

</ul>--> 

</div>

</div>

</div>

 

 

<div class="cp-main-content">

 

<section class="cp-about-section pd-tb60">

<div class="container">

<div class="row">

<div class="col-md-6">

<div class="cp-about-left">

<figure class="cp-about-img">

<img src="images/about-img.jpg" alt="">

</figure>

</div>

</div>

<div class="col-md-6">

 

<div class="cp-about-text">

<p>Printmysnap lets you rediscover "what can a printed snap be and how this priceless treasure of your valuable moments could be made price-less for you and your loved ones"</p>



<p>That special day, that special moment captured can be relived and printed into memorable and beautiful sharable prints. Your memories can be the strongest source of inspiration and motivation to make you happy, happier and happiest. We inspire you towards your most beautiful possession i.e. your “memories” and get them printed effortlessly.</p>



<p>We believe every snap clicked has a story and was taken for a reason, waiting to be shared with your loved ones. Your memories deserves prints because they carry unparalleled sentimental touch to it. We blend your priceless memories with the technology into precious prints, cherishable and re-liveable forever. </p>

<ul class="cp-about-listed">

<li>Brainstorming since 2015</li>

<li>Printing since 2016</li>

</ul>

</div>

</div>

</div>

</div>

</section> 

 

<?php /*?><section class="cp-about-section pd-tb60">

<div class="container">

<div class="row">

<div class="col-md-6">

<div class="cp-about-left">

<strong>THE BERKELEY CHAPTER</strong>

<figure class="cp-about-img">

<img src="images/berkeley-img1.jpg" alt="">

</figure>

<div class="clearfix">&nbsp;</div>

<figure class="cp-about-img">

<img src="images/berkeley-img2.jpg" alt="">

</figure>

<div class="clearfix">&nbsp;</div>

<figure class="cp-about-img">

<img src="images/berkeley-img3.jpg" alt="">

</figure>

</div>

</div>

<div class="col-md-6">

 

<div class="cp-about-text">

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu euismod nibh. Aenean ultrices, neque id vulputate aliquam, libero ante porta velit, vitae pharetra nulla dolor eu orci. Phasellus et nisl ut neque fringilla eleifend.</p>

<p>Suspendisse eleifend ligula ut lacus bibendum pulvinar. Donec aliquet hendrerit mauris. Praesent vel lectus cursus, rutrum nibh a, pellentesque lectus. Suspendisse nulla nisi, efficitur eu luctus nec, vulputate vel erat. In diam lectus, accumsan vel felis a, egestas dictum leo.</p>

<p>Vivamus odio odio, fringilla a venenatis nec, hendrerit et lectus. Aliquam ac urna ac dolor posuere convallis.</p>

<figure class="cp-about-img">

<img src="images/berkeley-img4.jpg" alt="">

</figure>

<div class="clearfix">&nbsp;</div>

<figure class="cp-about-img">

<img src="images/berkeley-img5.jpg" alt="">

</figure>

</div>

</div>

</div>

</div>

</section>



<section class="cp-about-section pd-tb60">

<div class="container">

<div class="row">

<div class="col-md-6">

<div class="cp-about-left">

<strong>THE SOMA CHAPTER</strong>

<figure class="cp-about-img">

<img src="images/soma-img1.jpg" alt="">

</figure>

<div class="clearfix">&nbsp;</div>

<figure class="cp-about-img">

<img src="images/soma-img2.jpg" alt="">

</figure>

<div class="clearfix">&nbsp;</div>

<figure class="cp-about-img">

<img src="images/soma-img3.jpg" alt="">

</figure>

</div>

</div>

<div class="col-md-6">

 

<div class="cp-about-text">

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu euismod nibh. Aenean ultrices, neque id vulputate aliquam, libero ante porta velit, vitae pharetra nulla dolor eu orci. Phasellus et nisl ut neque fringilla eleifend.</p>

<figure class="cp-about-img">

<img src="images/soma-img4.jpg" alt="">

</figure>

<div class="clearfix">&nbsp;</div>

<figure class="cp-about-img">

<img src="images/soma-img5.jpg" alt="">

</figure>

<div class="clearfix">&nbsp;</div>

<figure class="cp-about-img">

<img src="images/soma-img6.jpg" alt="">

</figure>

</div>

</div>

</div>

</div>

</section>



<section class="cp-about-section pd-tb60">

<div class="container">

<div class="row">

<div class="col-md-6">

<div class="cp-about-left">

<strong>WORK IN PROGRESS</strong>

<figure class="cp-about-img">

<img src="images/work-pro-img1.jpg" alt="">

</figure>

<div class="clearfix">&nbsp;</div>

<figure class="cp-about-img">

<img src="images/work-pro-img2.jpg" alt="">

</figure>

<div class="clearfix">&nbsp;</div>

<figure class="cp-about-img">

<img src="images/work-pro-img3.jpg" alt="">

</figure>

</div>

</div>

<div class="col-md-6">

 

<div class="cp-about-text">

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu euismod nibh. Aenean ultrices, neque id vulputate aliquam, libero ante porta velit, vitae pharetra nulla dolor eu orci. Phasellus et nisl ut neque fringilla eleifend.</p>

<figure class="cp-about-img">

<img src="images/work-pro-img4.jpg" alt="">

</figure>

<div class="clearfix">&nbsp;</div>

<figure class="cp-about-img">

<img src="images/work-pro-img5.jpg" alt="">

</figure>

<div class="clearfix">&nbsp;</div>

<figure class="cp-about-img">

<img src="images/work-pro-img6.jpg" alt="">

</figure>

</div>

</div>

</div>

</div>

</section> 

 

<section class="cp-creative-section">

<div class="container-fluid">

<div class="row">

<div class="col-md-6 col-sm-12">

 

<div class="cp-creative-box">

<h2>MEET US!</h2><br>

<ul class="cp-creative-listed">

<li>

<div class="cp-text">

<p>If you would like to get in touch, email us hello@sps.io, Like us on Facebook or find us on Instagram and Twitter as @socialps.</p>

</div>

</li>

<li>

<div class="cp-text">

<p>We've been featured in The New York Times, The San Francisco Chronicle, and Fast Company. You can download our press kit here.</p>

</div>

</li>

<li>

<div class="cp-text">

<p>Hugs, and thanks forever,<br>#SPSteam!</p>

</div>

</li>

<li>

</li>

</ul>

<a href="contact.html" class="cp-btn-style2">Contact Now</a>

</div> 

</div>

<div class="col-md-6 col-sm-12">

<figure class="cp-thumb pretty-gallery">

<img src="images/creative-img.jpg" alt="">

<a class="play-btn" href="http://vimeo.com/8245346" data-rel="prettyPhoto" title=""><i class="fa fa-play-circle"></i></a>

</figure>

</div>

</div>

</div>

</section>

 

<section class="cp-team-section pd-tb60">

<div class="container">

<div class="row">

<h2 class="text-center">MEET THE TEAM</h2><br>

<div class="col-md-4 col-sm-6">

 

<div class="cp-team-item cp-team-item2">

<figure class="cp-thumb">

<img src="images/team-img-01.jpg" alt="">

<figcaption class="cp-caption">

<div class="cp-text">

<h3>Lily Anderson</h3>

<span>Chief Executive</span>

</div>

<ul class="cp-social-links">

<li><a href="#"><i class="fa fa-google-plus"></i></a></li>

<li><a href="#"><i class="fa fa-twitter"></i></a></li>

<li><a href="#"><i class="fa fa-linkedin"></i></a></li>

<li><a href="#"><i class="fa fa-facebook"></i></a></li>

</ul>

</figcaption>

</figure>

</div> 

</div>

<div class="col-md-4 col-sm-6">

 

<div class="cp-team-item cp-team-item2">

<figure class="cp-thumb">

<img src="images/team-img-03.jpg" alt="">

<figcaption class="cp-caption">

<div class="cp-text">

<h3>Niky Anderson</h3>

<span>Content Manager</span>

</div>

<ul class="cp-social-links">

<li><a href="#"><i class="fa fa-google-plus"></i></a></li>

<li><a href="#"><i class="fa fa-twitter"></i></a></li>

<li><a href="#"><i class="fa fa-linkedin"></i></a></li>

<li><a href="#"><i class="fa fa-facebook"></i></a></li>

</ul>

</figcaption>

</figure>

</div> 

</div>

<div class="col-md-4 col-sm-6">

 

<div class="cp-team-item cp-team-item2">

<figure class="cp-thumb">

<img src="images/team-img-05.jpg" alt="">

<figcaption class="cp-caption">

<div class="cp-text">

<h3>Lily Anderson</h3>

<span>Assistant Director</span>

</div>

<ul class="cp-social-links">

<li><a href="#"><i class="fa fa-google-plus"></i></a></li>

<li><a href="#"><i class="fa fa-twitter"></i></a></li>

<li><a href="#"><i class="fa fa-linkedin"></i></a></li>

<li><a href="#"><i class="fa fa-facebook"></i></a></li>

</ul>

</figcaption>

</figure>

</div> 

</div>

<div class="col-md-4 col-sm-6">

 

<div class="cp-team-item cp-team-item2">

<figure class="cp-thumb">

<img src="images/team-img-02.jpg" alt="">

<figcaption class="cp-caption">

<div class="cp-text">

<h3>John Bard</h3>

<span>Coordinator</span>

</div>

<ul class="cp-social-links">

<li><a href="#"><i class="fa fa-google-plus"></i></a></li>

<li><a href="#"><i class="fa fa-twitter"></i></a></li>

<li><a href="#"><i class="fa fa-linkedin"></i></a></li>

<li><a href="#"><i class="fa fa-facebook"></i></a></li>

</ul>

</figcaption>

</figure>

</div> 

</div>

<div class="col-md-4 col-sm-6">

 

<div class="cp-team-item cp-team-item2">

<figure class="cp-thumb">

<img src="images/team-img-04.jpg" alt="">

<figcaption class="cp-caption">

<div class="cp-text">

<h3>Nelson</h3>

<span>Team Members</span>

</div>

<ul class="cp-social-links">

<li><a href="#"><i class="fa fa-google-plus"></i></a></li>

<li><a href="#"><i class="fa fa-twitter"></i></a></li>

<li><a href="#"><i class="fa fa-linkedin"></i></a></li>

<li><a href="#"><i class="fa fa-facebook"></i></a></li>

</ul>

</figcaption>

</figure>

</div> 

</div>

<div class="col-md-4 col-sm-6">

 

<div class="cp-team-item cp-team-item2">

<figure class="cp-thumb">

<img src="images/team-img-06.jpg" alt="">

<figcaption class="cp-caption">

<div class="cp-text">

<h3>Lily Anderson</h3>

<span>Chief Executive</span>

</div>

<ul class="cp-social-links">

<li><a href="#"><i class="fa fa-google-plus"></i></a></li>

<li><a href="#"><i class="fa fa-twitter"></i></a></li>

<li><a href="#"><i class="fa fa-linkedin"></i></a></li>

<li><a href="#"><i class="fa fa-facebook"></i></a></li>

</ul>

</figcaption>

</figure>

</div> 

</div>

</div>

</div>

</section> <?php */?>

 

</div>



 <?php

	include('includes/footer.php');

	include('includes/common_js.php');

?>
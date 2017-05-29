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

<title>Printmysnap | Privacy Policy</title>

<?php 

		include('includes/common_css.php');

		include('includes/header.php');

?>

 

 



<div class="cp-inner-banner">

<div class="container">

<div class="cp-inner-banner-outer">

<h2>Privacy Policy</h2>



<?php

$detect = new Mobile_Detect;

$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');



?>

</div>

</div>

</div>

 

 

<div class="cp-main-content">



<section class="cp-process-section pd-tb60">

<div class="container">

<div class="row">

<!--<h2 class="text-center margnbot50">Privacy Policy</h2>

<hr>-->

<div class="col-lg-12">

 

<div class="cp-process-box">

<div class="cp-text">

<p><strong>Printmysnap is committed to protecting and respecting your privacy.</strong> In order to process your order, we will require your identifying details and some relevant information. However, under no circumstances will we disclose any of your information to a third party except as mentioned herein or in Terms of Use.</p>


<hr>

<h3 align="left" style="color:#777777; font-family:sans-serif;">We will only ever use your information to:</h3>





<ul class="listofsh">

<li>Update you on details of your order</li>

<li>Create your account login</li>

<li>Create your invoices</li>

<li>Dispatch your orders</li>

<li>Notify you of changes to our services</li>

<li>Inform you about products and services that you have shown an interest in</li>

<li>Offer you discounts on our products and services</li>

<li>Creating advertisements and offers for you. Such adverts and offers may be shared with you in print or digital medium.</li>

</ul>





<p>Printmysnap will endeavour to take all the necessary steps in protecting your privacy.  However, as the transmission of information over the Internet, is not completely secure, we cannot guarantee the security of the data transmitted to our sites.  Any transmission of data is at your own risk.</p><br>

<p>Our website operates via session cookies to allow for an easy and pleasant ordering experience. This helps you navigate the pages without emptying your shopping cart on each new web page and saves you from having to log in continuously.</p><br>



<p>We do not use cookies to collect information about you. </p>

<p>Links from our website to other sites do not mean that they are under the same privacy policy and each link should be checked accordingly.</p>

<hr>

<h5><span class="pinktxt"><strong>All questions or comments concerning our privacy policy can be emailed to contact@printmysnap.com</strong></span></h5>







</div>

</div> 

</div>







</div>

</div>

</section>



</div>

 

 

<style>

p{

	text-align:justify;

}

ul li{

	text-align:left;

}

</style>

 <?php

	include('includes/footer.php');

	include('includes/common_js.php');

?>

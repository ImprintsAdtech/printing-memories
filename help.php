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

<title>Printmysnap - Free Photos for Lifetime | Help</title>

<?php 

		include('includes/common_css.php');

		include('includes/header.php');

?>

 

<div class="cp-inner-banner-help">

<div class="container">

<div class="cp-inner-banner-outer">

<h2>Help and FAQ</h2>

<!--<p class="white margnbot20">Or email us directily at <a href="mailto:">info@demourl.com</a></p>

<a href="#" class="read-more">Live Chat</a><br><br>

<p class="white">11am-2pm Mon-Fri</p>

<br>

 

<ul class="breadcrumb">

<li><a href="index.html">Home</a></li>

<li class="active">Guarantee</li>

</ul>--> 

</div>

</div>

</div>

 

 

<div class="cp-main-content">



<section class="cp-process-section pd-tb30">

<div class="container">

<div class="row">
<div class="col-sm-12">

<h2 class="text-center">Free Photos</h2><hr class="pinkbdr">

<p><strong>Q. Do I have to pay shipping charges for free prints?</strong><br>

<strong>A.</strong> No, the free prints are absolutely free inclusive of all shipping charges.</p><br>



<p><strong>Q. Can I order free photos again?</strong><br>

<strong>A.</strong> Yes you can order free photos every calendar month.</p><br>



<p><strong>Q. How many free products can I order in a month?</strong></h4><br>

<strong>A.</strong> You can order only 1 category of free prints each calendar month.</p><br>



<p><strong>Q What are the sizes available for free prints?.</strong><br>

<strong>A.</strong> There are 3 sizes available in free prints. You can get any 1 category of prints per month, either 24 passport size photos measuring 45mm*35mm, or 12 square photos measuring 4*4 inches, or 9 standard photos measuring 6*4 inches.</p><br>



<p><strong>Q. Will the quality of free prints be inferior to those of paid prints?</strong><br>

<strong>A.</strong> The quality will be same for both free and paid prints.</p><br>



<p><strong>Q. Why the prints are free?</strong><br>

<strong>A.</strong> We are able to provide you these prints free of cost at your doorsteps, thanks to our sponsors. </p><br>



<hr class="pinkbdr"><h2 class="text-center">Making an Order</h2><hr class="pinkbdr">



<p><strong>Q. What files type can I upload for printing?</strong><br>

<strong>A.</strong> Make sure all your images are JPEGs. We do not accept any other file type.</p><br>



<p><strong>Q. Can I use a tablet or a phone to place orders?</strong><br>

<strong>A.</strong> We have tried our best to make our website compatible with all tablets and mobiles. Still we recommend you to download and use our android mobile application for placing orders from tablets and mobiles.</p><br>



<p><strong>Q. Up to how much time the incomplete order will be saved in my account?</strong><br>

<strong>A.</strong> Our back-end only saves incomplete orders for up to 10 days. After 10 days the photos in your incomplete order shall be deleted.</p><br>



<p><strong>Q. What file size should I use for ordering prints?</strong><br>

<strong>A.</strong> The file size should be appropriate as per the photo print desired. Kindly refrain from using file sizes above 3 MB for prints smaller than poster size prints.</p><br>



<p><strong>Q. Can I cancel my order?</strong><br>

<strong>A.</strong> In order to get you those prints you love as fast as possible, a majority of our system is completely automated and begins right when you submit your order. Because of this we can only accept cancellation requests within one hour of placing your order. Please e-mail us with your order number ASAP at wecare@printmysnap.com.</p><br>



<p><strong>Q. How do I order duplicates?</strong><br>

<strong>A.</strong> You can order duplicate photos to fill orders in the following manner. After uploading or selecting any photo for printing for which you would like duplicates, hover your cursor over the photo in the upload screen and hit the "add" button below the photo. This will add 1 duplicate of the selected photo in your order and will be displayed on the same screen.</p><br>



<p><strong>Q. Can I print from my friend's Instagram or from a public hash tag?</strong><br>

<strong>A.</strong> Sorry to say that we can only print Instagram photos belonging to the owner of the account. If you want to print your friends' Instagram photos or from a hash tag, you will need to manually download the images from a static Instagram viewer and then upload them for printing. Some gifts are worth the effort. ;-)</p><br>



<p><strong>Q. Can I delete my photos from Instagram after I order them?</strong><br>

<strong>A.</strong> Please do not delete any of your Instagram photos within 48 hours of ordering. This will pull the tablecloth out from under your order and we cannot promise that your printed dinner will still be there.</p><br>



<p><strong>Q. Can I print from both Instagram and desktop photos in one order?</strong><br>

<strong>A.</strong> Yes, you can print from Instagram, Facebook and desktop photos in a single order. You can choose such options from the upload pop up on the upload page.</p><br>



<hr class="pinkbdr"><h2 class="text-center">Payment</h2><hr class="pinkbdr">



<p><strong>Q. What currency are your prices in?</strong><br>

<strong>A.</strong> All prices are listed in INR.</p><br>



<p><strong>Q. What forms of payment do you accept?</strong><br>

<strong>A.</strong> We almost accept all forms of payment. We currently accept all kinds of Debit Cards and Credit Cards. You can also use net banking to make payments to us.</p><br>



<p><strong>Q. Do you charge sales tax?</strong><br>

<strong>A.</strong> All our prices are listed inclusive of all taxes for the customer.</p><br>



<p><strong>Q. Do I need a billing address?</strong><br>

<strong>A.</strong> <strong>Q.</strong> No. Our payment system does not require a billing address. Please only enter your shipping address.</p><br>



<hr class="pinkbdr"><h2 class="text-center">Shipping</h2><hr class="pinkbdr">



<p><strong>Q. Can I expedite my order?</strong><br>

<strong>A.</strong> Currently we do not have an option of expediting the delivery of your order. We shall intimate the details to you as soon as this facility is available with us.</p><br>

<p>Please note that production time is still 1-3 business days regardless of your shipping method.</p><br>

<p>The estimated arrival date of expedited shipments is in no way guaranteed. We cannot control the forces that sway shipments around the world.</p><br>



<p><strong>Q. What are the shipping charges?</strong><br>

<strong>A.</strong> We are proud to inform that we do not charge any shipping cost from our customers. We provide free shipping in India.</p><br>



<p><strong>Q. Can I change my address?</strong><br>

<strong>A.</strong> You cannot change the address once you have completed the order process. If you would like to change your address please email us ASAP at wecare@printmysnap.com. We will surely try our best to provide any possible solution if there exists any. Please note that in case of free prints you can change your address only once in 3 months. If your order has already shipped we cannot change your shipping address. Please be careful when entering your information!</p><br>



<p><strong>Q. Do I need to create an account to order?</strong><br>

<strong>A.</strong> No! You can check out without creating an account, but you will be given the opportunity to create an account if you like.</p><br>



<p><strong>Q. How do I create an account?</strong><br>

<strong>A.</strong> To create an account with Printmysnap and save your addresses and payment info you can sign up from the login pop up. </p>


</div>

</div>

</div>

</section>



</div>

 

  <?php

	include('includes/footer.php');

	include('includes/common_js.php');

?>
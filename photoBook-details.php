<?php



include_once("conf/loadconfig.inc.php"); 



$obj_product = new Photomanager();



$currentTimestamp = getCurrentTimestamp();



	session_start();



	extract($_POST);



	extract($_GET);



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



		



		



$resultpro=$obj_product->get_id_all('finalSlug', $productid, 'productManager');



	while($productData = $db->fetchNextObject($resultpro)){



		$productId=$productData->productId;



	}



		



	$productDetail = $obj_product->getProductAllDetail($productId);



	if($db->numRows($productDetail) > 0)

	{

		$productSize;

		$no_of_photos;

		$minResolution;

		$reorderDays;

		

		while($productDetails = $db->fetchNextObject($productDetail)){

			$productTitle = $productDetails->productTitle;

			$productShortDesc = $productDetails->productShortDesc;

			$productDesc = $productDetails->productDesc;

			$productImage = $productDetails->productImage;

			$productType = $productDetails->productType;

			$finalSlug = $productDetails->finalSlug;

			$productStartingPrice = $productDetails->productStartingPrice;

			$productSize .= $productDetails->productSize."&nbsp; &nbsp;";

			

		}

		

	}



?>



 



 



 



<div id="homev2-slider" class="owl-carousel">



<div class="item">



<div class="cp-slider-thumb"> <img src="<?=DEFAULT_URL?>/images/h3-slide1.jpg" alt=""> </div>



</div>



<div class="item">



<div class="cp-slider-thumb"> <img src="<?=DEFAULT_URL?>/images/h3-slide2.jpg" alt=""> </div>



</div>



<div class="item">



<div class="cp-slider-thumb"> <img src="<?=DEFAULT_URL?>/images/h3-slide3.jpg" alt=""> </div>



</div>



<div class="item">


<div class="cp-slider-thumb"> <img src="<?=DEFAULT_URL?>/images/h3-slide4.jpg" alt=""> </div>



</div>



</div>







<div class="container">



<div class="cp-slider-content cp-slider-content-top">



<h2><?=$productTitle?> </h2>



<p><?=$productDesc?></p>



<p><span>Product size  <i class=" glyphicon glyphicon-arrow-right"></i> <?php echo rtrim($productSize,'&nbsp; &nbsp;');?>  </span></p>



<h4>Starting at Rs. <?=$productStartingPrice?></h4>



<a href="<?=DEFAULT_URL?>/snapbook_upload/<?=$finalSlug?>">ORDER NOW <i class="glyphicon glyphicon-check"></i></a>



</div>



</div>



 



<div class="cp-main-content">







<section class="cp-about-section pd-tb60">



<div class="container">



<div class="row">







<h2 class="text-center margnbot50">Our Signature Print, Now in 5X5 !</h2>







    <hr>



<p>We are an Event Planning Agency each event and client is unique and we believe our services should be as well.We are an Event Planning Agency each event and client is unique and we believe our services should be as well.</p>







<p>We are an Event Planning Agency each event and client is unique and we believe our services should be as well.We are an Event Planning Agency each event and client is unique and we believe our services should be as well.</p>







<hr>











<div class="col-md-4">



<div class="cp-about-left">



<figure class="cp-thumb">



<img src="<?=DEFAULT_URL?>/images/square_jellyhand.jpg" alt="">



</figure>



</div>



</div>



<div class="col-md-4">



<div class="cp-about-left">



<figure class="cp-thumb">



<img src="<?=DEFAULT_URL?>/images/squares.jpg" alt="">



</figure>



</div>



</div>



<div class="col-md-4">



<div class="cp-about-left">



<figure class="cp-thumb">



<img src="<?=DEFAULT_URL?>/images/squares_arm.jpg" alt="">



</figure>



</div>



</div>



<div class="clearfix">&nbsp;</div>







<div class="col-md-12">



<div class="cp-about-left">



<figure class="cp-thumb">



<img src="<?=DEFAULT_URL?>/images/Product-squareshelds.jpg" alt="">



</figure>



</div>



</div>



<div class="clearfix">&nbsp;</div>







<div class="col-md-3">



<div class="cp-about-left">



<figure class="cp-thumb">



<img src="<?=DEFAULT_URL?>/images/squares_cold.jpg" alt="">



</figure>



</div>



</div>



<div class="col-md-3">



<div class="cp-about-left">



<figure class="cp-thumb">



<img src="<?=DEFAULT_URL?>/images/squares_5.jpg" alt="">



</figure>



</div>



</div>



<div class="col-md-3">



<div class="cp-about-left">



<figure class="cp-thumb">



<img src="<?=DEFAULT_URL?>/images/square_catwhite.jpg" alt="">



</figure>



</div>



</div>



<div class="col-md-3">



<div class="cp-about-left">



<figure class="cp-thumb">



<img src="<?=DEFAULT_URL?>/images/squares_arm.jpg" alt="">



</figure>



</div>



</div>







</div>



</div>



</section>







<section class="cp-about-section guaranteedbg pd-tb60">



    <div class="container">



        <div class="row">



        



            <div class="col-md-12 text-center">



            	<img src="<?=DEFAULT_URL?>/images/Satisfaction_Seal.png" alt="" width="150" height="150" class="margnbot20">



                <h2 class="text-center margnbot50">100% Satisfaction Guaranteed</h2>



                <p>We take our print quality as seriously as we take our puns. We only want to send you prints that you will love forever.</p>



            </div>



        </div>



    </div>



</section>







</div>















 







 <?php



	include('includes/footer.php');



	include('includes/common_js.php');



?>
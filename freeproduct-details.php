<?php
include_once("conf/loadconfig.inc.php"); 
$obj_product = new Photomanager();
$currentTimestamp = getCurrentTimestamp();

	session_start();
	extract($_POST);
	extract($_GET);
	if(isset($_SERVER["REDIRECT_URL"]) && !empty($_SERVER["REDIRECT_URL"])){

		$_SESSION["redirect_url"] = $_SERVER["REDIRECT_URL"];

	}

?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Printmysnap - Free Photos | Photo Print | Free Product</title>
<style>
.size-link {
	border-color: #fff !important;
	font-size: 15px !important;
	padding: 0 !important;
	line-height: normal !important;
}
.size-link :hover {
	font-size: 20px !important;
	font-weight: bold !important;
	color: #f15a5f !important;
}
</style>
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
			$reorderDays = $productDetails->reorderDays;
			$productSize = $productDetails->productSize;
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
  <div class="cp-slider-content cp-slider-content-top ">
    <h2>
      <?=$productTitle?>
    </h2>
    <p>
      <?=$productDesc?>
    </p>
    <div class="product_details_left col-md-6"> 
    <p><span>Product size (in inches) <i class=" glyphicon glyphicon-arrow-right"></i> <br/><?php echo rtrim($productSize,'&nbsp; &nbsp;').'&nbsp;(free)';
if($_GET['productid']=='squares'){

	echo ' &nbsp;&nbsp; 6*6 (paid)';
	//echo '<a href="'.DEFAULT_URL.'/premium_product/squares-2" class="size-link">6*6 (paid)</a>';

	//echo '<a href="'.DEFAULT_URL.'/premium_product/squares-2" class="size-link">8*8(paid)</a>'; 

	//echo '<a href="'.DEFAULT_URL.'/premium_product/squares-2" class="size-link">(in inches)</a>'; 

} else if($_GET['productid']=='standard-prints'){
	
	echo '<br/>5*3.5 (paid) <br/>';
	echo '7*5  (paid)';
	
}

?> </span></p>
    <?php



if($_SESSION['userId'] != "" && isset($_SESSION['userId']))
{
 $myorders = $obj_product->getMyOrderFreeReorder($_SESSION['userId'],$productId);
 if($db->numRows($myorders) > 0)
		{   
			while($myordersData = $db->fetchNextObject($myorders)){
				$orderDate = $myordersData->orderDate;
			}
		}
     if($orderDate!=''){
         $orderDate_month=date('m', strtotime($orderDate));
     }else {
        $orderDate_month='0';
     }
	 $timestamp1 = date('m');
	if($orderDate_month != $timestamp1)
	{

		?>
    <a href="<?=DEFAULT_URL?>/freeupload-photos/<?=$finalSlug?>" class="read-more">ORDER NOW <i class="glyphicon glyphicon-check"></i></a>
    <?php } else {?>
    <a href="javascript:void(0)" data-toggle="modal" data-target="#reorderDaysPopup" class="read-more">ORDER NOW <i class="glyphicon glyphicon-check"></i></a>
    <?php
	}
}
else
{
	?>
    <a href="<?=DEFAULT_URL?>/login" class="read-more">ORDER NOW <i class="glyphicon glyphicon-check"></i></a>
    <?php	

}

?>
</div>
<div class="product_details_right col-md-6">
<?php include('pincode-check.php'); ?>
</div>
<div class="clear"></div>
  </div>
</div>
<div class="cp-main-content">
  <section class="cp-about-section pd-tb60 margintest">
    <div class="container">
      <div class="">
        <h2 class="text-center"><span class="pinktxt">Details about Free photos</span></h2>
        <hr>
        <p>We offer high quality prints of your loved and cherishable moments absolutely free at your doorstep. You can select and order any 1 of the sizes from the FREE PRINTS section free of charge on monthly basis.</p>
        <div class="clearfix">&nbsp;</div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th class="text-center">Size</th>
                <th class="text-center">Free Prints<br>per month</th>
                <th class="text-center">Finish</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center">Passport Photos</td>
                <td class="text-center"><span class="pinktxt">24</span></td>
                <td class="text-center">Matte</td>
              </tr>
              <tr>
                <td class="text-center">Standard Prints</td>
                <td class="text-center"><span class="pinktxt">9</span></td>
                <td class="text-center">Matte/Gloss</td>
              </tr>
              <tr>
                <td class="text-center">Square</td>
                <td class="text-center"><span class="pinktxt">12</span></td>
                <td class="text-center">Matte/Gloss</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="clearfix">&nbsp;</div>
        <p>Your account shall be renewed in free prints every calendar month.</p>
        <hr>
        
        <!-- <div class="col-md-4">

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





			<div class="col-md-4">

				<div class="cp-about-left">

					<figure class="cp-thumb">

						<img src="<?=DEFAULT_URL?>/images/squares_cold.jpg" alt="">

					</figure>

				</div>

			</div>



			<div class="col-md-4">

				<div class="cp-about-left">

					<figure class="cp-thumb">

						<img src="<?=DEFAULT_URL?>/images/squares_5.jpg" alt="">

					</figure>

				</div>

			</div>



			<div class="col-md-4">

				<div class="cp-about-left">

					<figure class="cp-thumb">

						<img src="<?=DEFAULT_URL?>/images/square_catwhite.jpg" alt="">

					</figure>

				</div>

			</div> --> 
        
      </div>
    </div>
    
    <?php 
	/*Passport print*/
	if($productId=='1'){ ?>
    
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/standard-print1.jpg" alt="" class="img-responsive"> </div>
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/standard-print2.jpg" alt="" class="img-responsive"> </div>
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/standard-print3.jpg" alt="" class="img-responsive"> </div>
        <div class="clearfix">&nbsp;</div>
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/standard-print4.jpg" alt="" class="img-responsive"> </div>
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/standard-print5.jpg" alt="" class="img-responsive"> </div>
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/standard-print6.jpg" alt="" class="img-responsive"> </div>
      </div>
    </div>
    <?php } 
	/*square*/
	else if($productId=='8'){?>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/square-print1.jpg" alt="" class="img-responsive"> </div>
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/square-print2.jpg" alt="" class="img-responsive"> </div>
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/square-print3.jpg" alt="" class="img-responsive"> </div>
        <div class="clearfix">&nbsp;</div>
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/square-print4.jpg" alt="" class="img-responsive"> </div>
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/square-print5.jpg" alt="" class="img-responsive"> </div>
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/square-print6.jpg" alt="" class="img-responsive"> </div>
      </div>
    </div>
    <?php } else {?>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/standard-print1.jpg" alt="" class="img-responsive"> </div>
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/standard-print2.jpg" alt="" class="img-responsive"> </div>
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/standard-print3.jpg" alt="" class="img-responsive"> </div>
        <div class="clearfix">&nbsp;</div>
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/standard-print4.jpg" alt="" class="img-responsive"> </div>
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/standard-print5.jpg" alt="" class="img-responsive"> </div>
        <div class="col-lg-4 col-md-4 col-sm-4"> <img src="<?=DEFAULT_URL?>/images/standard-print6.jpg" alt="" class="img-responsive"> </div>
      </div>
    </div>
    <?php }?>
    
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

<!-- Modal -->

<div class="modal fade" id="reorderDaysPopup" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sorry</h4>
      </div>
      <div class="modal-body">
        <?php

		$createDate = new DateTime($orderDate);

		$strip = $createDate->format('Y-m-d');

		?>
        <?php /*?> <p>You have already ordered this product on  <?=$strip?>. You can now order this after <?=$reorderDays?>.</p><?php */?>
        <p>You have already ordered FREE PRINTS on
          <?=$strip?>
          . You can order free prints on 1st day of the next month.</p>
      </div>
    </div>
  </div>
</div>
<?php
 	include('includes/common_js.php');
	include('includes/footer.php');
?>
<?php include('pincode-check-script.php'); ?>

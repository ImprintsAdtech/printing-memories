<?php
include_once("conf/loadconfig.inc.php"); 
extract($_POST);
extract($_GET);
$currentTimestamp = getCurrentTimestamp();
$obj_product = new Photomanager();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Printmysnap - Free Photos for Lifetime | Photo Print</title>
<?php 
		include('includes/common_css.php');
		include('includes/header.php');
?>
 
 
<div class="cp-inner-banner">
<div class="container">
<div class="cp-inner-banner-outer">
<h2>Products</h2>
<!--<p class="white margnbot20">We're a group of artists, designers, and coders trying to answer the question "What can a company be, and what should it be?" One day the answer will be "Social Print Studio." Working on it since 2010!</p>
 
<ul class="breadcrumb">
<li><a href="<?=DEFAULT_URL?>">Home</a></li>
<li class="active">Paid Product</li>
</ul> -->
</div>
</div>
</div>

 
<div class="cp-main-content">



	<section class="cp-Our-experties pd-tb60">
		<div class="container">
			<div class="cp-ex-slider row">
            
            	
<?php
$paidProducts = $obj_product->getAllActivePaidProduct();
	if($db->numRows($paidProducts)>0){
			$i=1;
			while($paidproductData = $db->fetchNextObject($paidProducts)){
			?>
            <div class="col-md-4 col-sm-6">
                <div class="slide">
                    <div class="cp-thumb"> <img src="<?=DEFAULT_URL?>/userfiles/product_img/<?=$paidproductData->productImage?>" alt="Images">
                    <div class="cp-hover-content">
                    <h3 style="font-size:60px; color:#fff;">Coming Soon</h3> <?php //echo $paidproductData->productShortDesc?>
  <?php /*?>                  <?php
					if($paidproductData->finalSlug == "photobooks")
					{
						?>
                        <a href="<?=DEFAULT_URL?>/photobook_product/<?=$paidproductData->finalSlug?>">Read More</a>
                        <?php
					}
					else
					{
					?>
                    `	<a href="<?=DEFAULT_URL?>/premium_product/<?=$paidproductData->finalSlug?>">Read More</a>
                    <?php
					}
					?><?php */?>
                    </div>
                    </div>
<?php /*?>                    <?php
					if($paidproductData->finalSlug == "photobooks"){
					?>
					<a href="<?=DEFAULT_URL?>/photobook_product/<?=$paidproductData->finalSlug?>">
					<?php
					} else {
					?>
					<a href="<?=DEFAULT_URL?>/premium_product/<?=$paidproductData->finalSlug?>">
					<?php	
					}<?php */?>
				
                    <div class="cp-ex-title">
                    <h3><?=$paidproductData->productTitle?></h3>
                    </div>
                   <?php /*?> </a><?php */?>
                </div> 
            </div>
				
			<?php	
			}
	}
?>

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
 
 

 <?php
	include('includes/footer.php');
	include('includes/common_js.php');
?>
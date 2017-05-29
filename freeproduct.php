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

<title>Printmysnap - Free Photos | Free Product</title>

<?php 

        include('includes/common_css.php');

        include('includes/header.php');

?>

 

 

<div class="cp-inner-banner">

<div class="container">

<div class="cp-inner-banner-outer">

<h2>Free Prints</h2>

<p class="white margnbot20">Priceless moments deserve price-less prints. Yes, the word is PRICE-LESS. These free prints are delivered absolutely free to your doorstep.<br>Each user can order maximum one category from this section each month.</p>

 

<!--<ul class="breadcrumb">

<li><a href="<?=DEFAULT_URL?>">Home</a></li>

<li class="active">Free Prints</li>

</ul> -->

</div>

</div>

</div>



 

<div class="cp-main-content">







    <section class="cp-Our-experties pd-tb60">

        <div class="container">

            <div class="cp-ex-slider row">

                <?php

                $freeProducts = $obj_product->getAllActiveFreeProduct();

                    if($db->numRows($freeProducts)>0){

                            $i=1;

                            while($freeproductData = $db->fetchNextObject($freeProducts)){

                            ?>

                            <div class="col-md-4 col-sm-6">

                                <div class="slide">

                                <div class="cp-thumb"> <img src="<?=DEFAULT_URL?>/userfiles/product_img/<?=$freeproductData->productImage?>" alt="Images">

                                <div class="cp-hover-content">

                                <p> <?=$freeproductData->productShortDesc?> </p>

                                <a href="<?=DEFAULT_URL?>/product/<?=$freeproductData->finalSlug?>">Read More</a> </div>

                                </div>

                                <a href="<?=DEFAULT_URL?>/product/<?=$freeproductData->finalSlug?>">

                                    <div class="cp-ex-title">

                                    <h3><?=$freeproductData->productTitle?></h3>

                                </a>    

                                </div>

                                </div> 

                            </div>                  

                            <?php   

                            }

                    }

                ?>

            </div>

        </div>

    </section>



<section class="cp-about-section  pd-tb60">

<div class="container">
      <div class="">
        <h2 class="text-center"><span class="pinktxt">Details about Free photos</span></h2>
        <hr>
        <p>We offer high quality prints of your loved and cherishable moments absolutely free at your doorstep. You can select and order any 1 of the sizes from the FREE PRINTS section free of charge on monthly basis.</p>
        <div class="clearfix">&nbsp;</div>
        <div class="table-responsive">
          <table class="table text-center">
            <thead>
              <tr>
                <th class="text-center">Size</th>
                <th class="text-center">Free Prints<br>per month</th>
                <th class="text-center">Finish</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Passport Photos</td>
                <td class="text-center"><span class="pinktxt">24</span></td>
                <td>Matte</td>
              </tr>
              <tr>
                <td>Standard Prints</td>
                <td class="text-center"><span class="pinktxt">9</span></td>
                <td>Matte/Gloss</td>
              </tr>
              <tr>
                <td>Square</td>
                <td class="text-center"><span class="pinktxt">12</span></td>
                <td>Matte/Gloss</td>
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
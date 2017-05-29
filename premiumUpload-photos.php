<?php



include_once("conf/loadconfig.inc.php"); 

session_start();



extract($_POST);



extract($_GET);

//$_SESSION["lastPageUrl"] = $_SERVER["REQUEST_URI"];

$obj_product = new Photomanager();



$currentTimestamp = getCurrentTimestamp();



$userId = $_SESSION['userId'];



$guestUserId = $_SESSION['guestUserId'];



if($userId == "")



{



$userId = $_SESSION['guestUserId'];	



}



$productSlug = $productId;



$getProductId = $obj_product->getProductId($productId);	



$proId = $getProductId->productId;



	



	$premiumorder=$obj_product->getPremiumPhotoOrder($proId,$userId);



	//Fetching records from photoManager 



	$productDetail = $obj_product->getProductAllDetail($proId);



	if(!empty($productDetail) && $db->numRows($productDetail) >= 1){



		$productSizes;



		$no_of_photos;



		while($productDetails = $db->fetchNextObject($productDetail)){



			$productSizes .= $productDetails->productSize.",";



			$no_of_photos .= $productDetails->no_of_photos.",";



			$printPrice1 .= $productDetails->printPrice.",";



			$productName = $productDetails->productTitle;



			



		} 



		$productSizes = rtrim($productSizes,',');



		$no_of_photos= rtrim($no_of_photos,',');



		$printPrice1= rtrim($printPrice1,',');







		$productSize_arr = array_unique(explode(',',$productSizes));



		$no_of_photo_arr = explode(',',$no_of_photos);



		$printPrice_arr = explode(',',$printPrice1);







		$productSizeCount = count($productSize_arr);



		$no_of_photo_Count = count($no_of_photo_arr);



		



		if(!empty($premiumorder) && $db->numRows($premiumorder)>0){



			while($premiumorderData = $db->fetchNextObject($premiumorder)) {



				$premiumPhotoOrderId = $premiumorderData->premiumPhotoOrderId;



				$productSize = $premiumorderData->productSize;



				$no_of_photo = $premiumorderData->no_of_photos;



				$printPrice = $premiumorderData->printPrice;



				$proFinishing = $premiumorderData->proFinishing;



			} 



		} else {



			$dataArr = array('productId'=>$proId,

								'userId'=>$userId,

								'guestUserId'=>$guestUserId,

								'no_of_photos'=>'',

								'productSize'=>'',

								'buyStatus'=>'0',

								'onetimeStatus'=>'0',

								'createdDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))



			);	



			$premiumPhotoOrderId = $obj_product->insertPremiumphotoOrder($dataArr,$obj_product->tblpremiumorder); 



		}



	}



?>



	<!DOCTYPE html>



	<html lang="en">



	<head>



	<meta charset="utf-8">



	<meta http-equiv="X-UA-Compatible" content="IE=edge">



	<meta name="viewport" content="width=device-width, initial-scale=1">



	<title>Printmysnap - Free Photos for Lifetime | Paid Photo Upload</title>



	<link rel="stylesheet" href="<?php echo DEFAULT_URL; ?>/css/csphotoselector.css">

	<link rel="stylesheet" type="text/css" href="<?=DEFAULT_URL?>/css/component.css" />

	<?php 

			include('includes/common_css.php');

			include('includes/header.php');

	?>



	<div class="cp-inner-banner">

	<div class="container">

	<div class="cp-inner-banner-outer">

	</div>

	</div>

	</div>

    <div class="clearfix"></div>

    <div class="bgred" id="sticker">

	    <div class="container">

		    <div class="row toppricestrip">

				<input type="hidden" value="<?=$premiumPhotoOrderId?>" id="premiumOrderIdss" />

				<input type="hidden" value="<?=$proId?>" id="productId1" />

				<input type="hidden" value="<?=$guestUserId?>" id="guestUserId" />

				<input type="hidden" value="<?=$userId?>" id="UserId" />

				<div class="col-md-3 text-center">

		        	<label>Size</label><br>

		        	<select name="proSize" id="proSize">

		        		<option value="">Select Size</option>

			        <?php

					for($i=0;$i<$productSizeCount;$i++)

						{

						?>

					   		<option value="<?=$productSize_arr[$i]?>" <?php if($productSize_arr[$i]==$productSize) echo "selected"; ?>><?=$productSize_arr[$i]?></option>

						<?php 

						}

					?>

			        </select>

			    </div>



			    <div class="col-md-3 text-center">

					<label>Finish</label><br>

					<select name="proFinishing" id="proFinishing">

						<option <?php if($proFinishing == "smooth_matte"){echo "selected";} ?> value="smooth_matte">Matte</option>

						<option <?php if($proFinishing == "glossy"){echo "selected";} ?> value="glossy">Gloss</option>

					</select>

		        </div>

		        <div class="col-md-2 text-center">

		         	<label>Price per print</label><br>

		         	<span id="printPriceval"><?php if($printPrice == ""){echo "&#8377; ".$printPrice_arr[0];} else{ echo "&#8377; ".$printPrice;}?></span>

		        </div>

		        <div class="col-md-2 text-center">

		         	<label>Set of photos</label><br>

		            <span id="nophotoval">

			            <?php 

			            if($no_of_photo == "" || $no_of_photo == '0'){

			            	echo $no_of_photo_arr[0];

			            } else { 

			            	echo $no_of_photo;

			            }

			            ?>

		            </span>

		        </div>

                <div class="col-md-2 text-center">

                	<?php



					$photosUploaded = $obj_product->getAllPremiumPrintPhoto($premiumPhotoOrderId, $_SESSION['userId']);

					$count = $db->numRows($photosUploaded);

						if($count > 0){

							if($printPrice == "" || $printPrice=='0'){

								$printPrice =  $printPrice_arr[0];	

							}

							$totalPrice = $count*$printPrice;

						?>

							<label>Total Price</label><br>

								<span id="totalPriceval"><?="&#8377; ".$totalPrice;?></span>	

					        

					   <?php

					   	} 

					?>

                </div>

		    </div>

	    </div>

    </div>

		<section class="cp-about-section pd-tb30">

			<div class="container">

				<div class="row">

					<div class="col-md-8 picsize">

						<h2>

						<?php 

						echo $productName;

						echo " Size : ";

						echo $productSize;

						?>

						</h2>

					</div>

					<div class="col-md-4 text-right">

						<div class="picsize">

							<?php

							

							$photosUploaded = $obj_product->getAllPremiumPrintPhoto($premiumPhotoOrderId, $_SESSION['userId']);

							$count = $db->numRows($photosUploaded);

							if($no_of_photo == "" || $no_of_photo == '0'){

				            	$no_of_photo =  $no_of_photo_arr[0];

				            }

							if($count > 0){

								$totalPrice = $printPrice * $count;

								if($productSlug!="passports-2"){

								?>

						    	    <h2><?=$count?>/<span id="totalnophotoval"><?=$no_of_photo?></span></h2>

								<?php 

								} else {

									$note = "(Each Photo will be print on a full sheet)";

								} 

						   	echo $note;

							} else {

								if($productSlug!="passports-2"){

							?>

						        <h2><?=$count?>/<span id="totalnophotoval"><?php if($no_of_photo == "" || $no_of_photo == '0'){echo $no_of_photo_arr[0];} else{ echo $no_of_photo;} ?></span></h2>

								<?php 

								}

							}

							?>

						</div>

					</div>

					<div class="clearfix"></div>

					<hr>

					<div class="clearfix"></div>

					<div class="col-md-12 text-center">

						<?php 

						if($productSize != ""){

						?>

							<a href="javascript:void(0)" class="read-more"  data-toggle="modal" data-target="#uploadphoto" title="Kindly upload photos of adequate resolution for better print quality">UPLOAD PHOTOS <i class="fa fa-upload"></i></a>

						<?php 

						} else {

						?>

							<a href="javascript:void(0)" class="read-more" style="pointer-events:none;" data-toggle="modal" data-target="#uploadphoto" title="Kindly upload photos of adequate resolution for better print quality">UPLOAD PHOTOS <i class="fa fa-upload"></i></a>

						<?php 

						}

						?>

					</div>

					<div class="clearfix">&nbsp;</div>

					<div class="four_sixphotos">

						<?php

					 	if($db->numRows($photosUploaded)>0){

							$i=1;

							$premiumPhotoOrderId = !empty($premiumPhotoOrderId) ? $premiumPhotoOrderId : "";

							while($photosUploadedData = $db->fetchNextObject($photosUploaded)) {

							?>

								<div class="col-md-4 text-center showoption">

									<img src="<?=DEFAULT_URL?>/uploads/<?=$photosUploadedData->premiumPhotoName?>" alt="" class="img-thumbnail printingPhoto">

									<div class="img-count"><?=$i?></div>

									<div class="showoptiondiv">

										<ul>

										    <li><a href="javascript:void(0)" data-photoid="<?=$photosUploadedData->PremiumPhotoId?>" class="autofill_photo">ADD</a></li>

											<li><a href="<?=DEFAULT_URL?>/cropPhoto.php?photo=<?php echo base64_encode($photosUploadedData->PremiumPhotoId); ?>&order=<?php echo base64_encode($premiumPhotoOrderId); ?>&type=paid" class="croppingBtn" data-img="<?=DEFAULT_URL?>/uploads/<?=$photosUploadedData->premiumPhotoName?>"><i class="fa fa-crop"></i> CROP</a></li>

                                            <li><a href="<?=DEFAULT_URL?>/editPhoto.php?photo=<?php echo base64_encode($photosUploadedData->PremiumPhotoId); ?>&order=<?php echo base64_encode($premiumPhotoOrderId); ?>" target="_blank" class="editor"><i class="fa fa-crop"></i> EDIT</a></li>

											<li class="last"><a href="javascript:void(0)" class="deletePhotos" data-id="<?=$photosUploadedData->PremiumPhotoId?>"><i class="fa fa-close"></i> DELETE</a></li>

								          	<input type="hidden" id="no_of_photo_new" value="<?=$no_of_photo?>" name="no_of_photo_new" />

								        	<input type="hidden" id="printPrice_new" value="<?=$printPrice?>" name="printPrice_new" />

										</ul>

									</div>

								</div>

							<?php 

								if($i == 3) {

									echo '<div class="clearfix">&nbsp;</div>';	

								}

								$i++;

							}

					 	}

						if($count > 0 )

						{

						?>

							<div class="clearfix">&nbsp;</div>

						    <div class="clearfix">&nbsp;</div>

							<center><a href="javascript:void(0)" data-proid="<?=$premiumPhotoOrderId?>" id="premiumcartAddBtn" class="read-more" >CONTINUE <i class="fa fa-arrow-right" aria-hidden="true"></i></a></center>

						<?php

						}

						?>

					</div>

					<div class="clearfix">&nbsp;</div>

				</div>

			</div>

		</section>

	<!-- Upload Photo Modal -->

	<div class="modal fade" id="uploadphoto" role="dialog">

		<div class="modal-dialog">

		  <!-- Modal content-->

		  <div class="modal-content">

			<div class="modal-header">

			  <button type="button" class="close" data-dismiss="modal">&times;</button>

				<h4>Choose Photos</h4>

			</div>

			<div class="modal-body">

				<div class="cp-tab-box">

	<ul class="nav nav-tabs" role="tablist">

	<li class="active"><a href="#cp_tab1" role="tab" data-toggle="tab">Instagram</a></li>

	<li><a href="#cp_tab2" role="tab" data-toggle="tab">Facebook</a></li>

	<li><a href="#cp_tab3" role="tab" data-toggle="tab">My Computer</a></li>

	</ul>

	<div class="tab-content">

	<div class="tab-pane active fade in" id="cp_tab1">

		<div class="cp-tab-info-box">

			<div class="cp-tab-text">

				<span style="width: 100%;" class="btn-submit">Coming Soon</span> 

			</div>

		</div>

	</div>

	<div class="tab-pane fade" id="cp_tab2">

		<div class="cp-tab-info-box">
		<?php /*
			<div class="cp-tab-text">

				<span style="width: 100%;" class="btn-submit">Coming Soon</span> 

			</div>

			*/
			?>

			<span id="loginStatus" style="display:none;" class="fblogin_message">You'll need to log in first</span><br>

			<div class="cp-tab-text text-center">

				<li class=""><!--Status: <span id="login-status">Not logged in</span> | --><a href="javascript:void(0)" id="btnLogin" class="fbbtn"><i class="fa fa-facebook" style="margin-right:10px"></i>Login with facebook</a><!-- | <a href="#" id="btnLogout">Log out</a>--></li>

		        <li style="padding-top:20px;"><a href="javascript:void(0)" class="read-more photoSelect" style="pointer-events:none; border:none">Select Your Facebook Photos</a><!-- (You'll need to log in first)--></li>

			</div>
	

		</div>

	</div>

	<div class="tab-pane fade" id="cp_tab3">

	<div class="cp-tab-info-box">

	<div class="cp-tab-text text-center">

	<form action="" method="post" enctype="multipart/form-data" id="PhotoPrintupload">

		<table width="100%">

			<tr>

				<td>

					<div class="box">

					<input name="ImageFile[]" id="file-1" type="file" multiple/></td>

					<label for="file-1" style="margin: 0 auto; cursor:pointer">

						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> 

						<span>Choose a file&hellip;</span>

					</label>

				</div>

				</td>

			</tr>

			<tr>

				<td>&nbsp;</td>

				<td>

					<br><input type="button"  id="SubmitButton" value="Upload" class="btn-submit" disabled/>

				</td>

				<input type="hidden" id="premiumPhotoOrderId" value="<?=$premiumPhotoOrderId?>" name="premiumPhotoOrderId" />

				<input type="hidden" id="productId" value="<?=$proId?>" name="productId" />

				<input type="hidden" id="productSlug" value="<?=$productSlug?>" name="productSlug" />

				<input type="hidden" id="productName" value="<?=$productName?>" name="productName" />

		        <input type="hidden" id="no_of_photo" value="<?=$no_of_photo?>" name="no_of_photo" />

		        <input type="hidden" id="printPrice" value="<?=$printPrice?>" name="printPrice" />

			</tr>

			<tr>

			  	<td></td>

				<td><img src="/images/uploading.gif" id="uploading" style="display: none"></td>

			</tr>

		</table>

	</form>

	</div>

	</div>

	</div>

	</div>

	</div>

				<div class="clearfix"></div>

			</div>

		  </div>

		</div>

	  </div> 



	<!-- <div class="modal fade" id="crop_photo" role="dialog">

		<div class="modal-dialog">

			<div class="modal-content">

				<div class="modal-header">

					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<h4 class="modal-title">Crop Photo</h4>

				</div>

			    <div class="modal-body">

					

			    </div>

			</div>

		</div>

	</div>	 -->

		

    <div class="modal-delete-photo modal-effect-blur" id="modal-1">

		<div class="modal-content">

			<h3>Are you sure you want to delete?</h3>

			<div>

				<button data-id="" class="modal-delete">Delete</button>

				<button class="modal-delete-cancel">Cancel</button>

			</div>

		</div>

	</div>

	<div class="modal-delete-photo modal-effect-blur" id="modal-2">

		<div class="modal-content">

			<h3 id="alert-message"></h3>

			<div>

				<button class="reload">OK, Thanks</button>

			</div>

		</div>

	</div>

	<?php include("includes/facebook_imagebox.php"); ?>



<div class="modal-overlay"></div>

<?php

	include('includes/footer.php');

	include('includes/common_js.php');

	include('premiumUpload-photos-script.php');

?>

<style type="text/css">

	.fblogin_message{

		padding:10px;

		border:2px solid #FFF;

		border-radius:2px ;

		color: #000;

		background-color: #f15a5f;

	}

	#btnLogin{

		margin: 0 auto;

	}

</style>

<script>

$(document).ready(function() {

    var s = $("#sticker");

    var pos = s.position();                    

    $(window).scroll(function() {

        var windowpos = $(window).scrollTop();

        if (windowpos >= pos.top) {

            s.addClass("stick");

        } else {

            s.removeClass("stick"); 

        }

    });

});



/*

jQuery(window).resize(function() {



	var width = screen.width,



        height = screen.height;



    if(width <= 768 && height <= 1024){



    	jQuery(".editor").css("display", "none");



    	jQuery(".cropper").css("display", "block");



	} else {



		jQuery(".cropper").css("display", "none");



		jQuery(".editor").css("display", "block");



    }   



});

*/

</script>
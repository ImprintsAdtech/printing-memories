<?php
include_once("conf/loadconfig.inc.php"); 
session_start();
extract($_POST);
extract($_GET);
$obj_product = new Photomanager();
$currentTimestamp = getCurrentTimestamp();
$userId = $_SESSION['userId'];
$guestUserId = $_SESSION['guestUserId'];
if($userId == "")
{
$userId = $_SESSION['guestUserId'];	
}
	
$resultpro=$obj_product->get_id_all('finalSlug', $productid, 'productManager');
	while($productData = $db->fetchNextObject($resultpro)){
		$productId=$productData->productId;
	}
	
	$cart_delete="DELETE FROM cart WHERE productId='".$productId."' AND userId='".$_SESSION['userId']."' AND cartBuyStatus='0'";
	mysql_query($cart_delete);
	
	
	$premiumorder=$obj_product->getPremiumPhotoOrder($productId,$userId);

	$productDetail = $obj_product->getProductAllDetail($productId);

	
	if($db->numRows($productDetail) > 0)
	{
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
		
		if($db->numRows($premiumorder)>0){
				 while($premiumorderData = $db->fetchNextObject($premiumorder)) {
					$premiumPhotoOrderId = $premiumorderData->premiumPhotoOrderId;
					$productSize = $premiumorderData->productSize;
					$no_of_photo = $premiumorderData->no_of_photos;
					$printPrice = $premiumorderData->printPrice;
					$proFinishing = $premiumorderData->proFinishing;
				 }
			 }
			 else
			 {
				 $dataArr = array('productId'=>$productId,
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
	<title>Printmysnap - Free Photos for Lifetime | Upload Photostrip Photos</title>
	<link href="<?=DEFAULT_URL?>/css/photoedit/cropper.css" rel="stylesheet">
	<link href="<?=DEFAULT_URL?>/css/photoedit/docs.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo DEFAULT_URL; ?>/css/csphotoselector.css">
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
	 
	<div class="cp-main-content">
	 
	<div class="clearfix"></div>
    <div class="bgred" id="sticker">
		<div class="container">
			<div class="col-md-12">
		 		<input type="hidden" value="<?=$premiumPhotoOrderId?>" id="premiumOrderIdss" />
				<input type="hidden" value="<?=$productId?>" id="productId1" />
				<div class="col-md-3">
					<label>Size: </label>
					<select name="proSize" id="proSize" style="width:75%;">
						<option value="">Select Size</option>
						<?php
						for($i=0;$i<$productSizeCount;$i++){
						?>
							<option <?php if($productSize == $productSize_arr[$i]){ echo "selected"; } ?> value="<?=$productSize_arr[$i]?>"><?=$productSize_arr[$i]?></option>
						<?php 
						}
						?>
					</select>
				</div>
				<div class="col-md-3">
					<label>Finish : </label>
					<select name="proFinishing" id="proFinishing">
						<option <?php if($proFinishing == "smooth_matte"){echo "selected";} ?> value="smooth_matte">Smooth matte</option>
						<option <?php if($proFinishing == "glossy"){echo "selected";} ?> value="glossy">Glossy</option>
					</select>
				</div>
				<div class="col-md-3">
					<label>Price per print: </label>
					<span id="printPriceval">
						<?php if($printPrice == ""){
							echo $printPrice_arr[0]; 
						} else { 
							echo $printPrice;
							}
						?>
					</span>
				</div>
				<div class="col-md-3">
					<label>Set of photos: </label>
					<span id="nophotoval">
					<?php if($no_of_photo == "" || $no_of_photo == '0'){
							echo $no_of_photo_arr[0];
						} else { 
							echo $no_of_photo;
						}
					?>
					</span>
				</div>
		    </div>
	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">&nbsp;</div>
	<div class="picsize">
		<h2>
			<?php 
			echo $productName;
			echo "<br> Size : ";
			echo $productSize;
			?>
		</h2>
	</div>
	<div class="col-md-4 text-right">

		<div class="picsize">
		<?php
        $photosUploaded = $obj_product->getAllPremiumPrintPhoto($premiumPhotoOrderId, $_SESSION['userId']);
        $count = $db->numRows($photosUploaded);
        ?>
       
            <?php
			if($count > 0)
			{
			$divideVal = $count/$no_of_photo;
			$noOfSheet = ceil($divideVal);
			
			
			?>
            
          <h2><?=$count?>/<?=$no_of_photo * $noOfSheet?></h2>
        	<div class="clearfix">&nbsp;</div>
   			<div class="clearfix">&nbsp;</div>
        <h2>Total Price: <?=$printPrice * $noOfSheet;?></h2>
        <?php
			}
			else
			{
				if($no_of_photo == "")
				{
				$no_of_photo = 0;	
				}
			?>
             <h2><?=$count?>/<span id="totalnophotoval"><?php if($no_of_photo == "" || $no_of_photo == '0'){echo $no_of_photo_arr[0];} else{ echo $no_of_photo;} ?></span></h2>
        	<div class="clearfix">&nbsp;</div>
   			<div class="clearfix">&nbsp;</div>
            <h2>Total Price: <span id="totalPriceval"><?php if($printPrice == ""){echo $printPrice_arr[0];} else{ echo $printPrice;}?></span></h2>
            <?php	
			}
			?>
		</div>
	</div>
	
	<div class="clearfix"></div>
	<hr>
	<div class="clearfix"></div>
	<div class="col-md-12 text-center">
	
	<?php if($productSize != "")
	{
		?>
		<a href="javascript:void(0)" class="read-more"  data-toggle="modal" data-target="#uploadphoto">UPLOAD PHOTOS <i class="fa fa-upload"></i></a>
        <?php } else
		{
			?>
		<a href="javascript:void(0)" class="read-more" style="pointer-events:none;" data-toggle="modal" data-target="#uploadphoto">UPLOAD PHOTOS <i class="fa fa-upload"></i></a>
        <?php 
		}?>
		
	</div>
	
	<div class="clearfix">&nbsp;</div>
	
	
	<div class="four_sixphotos">
	<?php
	 if($db->numRows($photosUploaded)>0){
		while($photosUploadedData = $db->fetchNextObject($photosUploaded)) {
			$photoes[] = $photosUploadedData;
		}
		for($i=1; $i<=count($photoes);$i++){
			for($j=1;$j<=3;$j++){
		?>
			<div class="col-md-4 text-center showoption">
				<img src="<?=DEFAULT_URL?>/uploads/<?=$photoes[$j]->premiumPhotoName?>" alt="" class="img-thumbnail printingPhoto">
				<div class="img-count"><?=$i?></div>
				<div class="showoptiondiv">
					<ul>
					    <li><a href="javascript:void(0)" data-photoid="<?=$photoes[$j]->PremiumPhotoId?>" class="autofill_photo">ADD</a></li>
					    <li><a href="<?=DEFAULT_URL?>/cropPhoto.php?photo=<?php echo base64_encode($photoes[$j]->PremiumPhotoId); ?>&order=<?php echo base64_encode($premiumPhotoOrderId); ?>&type=paid" class="croppingBtn" data-img="<?=DEFAULT_URL?>/uploads/<?=$photoes[$j]->premiumPhotoName?>"><i class="fa fa-crop"></i> CROP</a></li>
					    <li><a href="<?=DEFAULT_URL?>/editPhoto.php?photo=<?php echo base64_encode($photoes[$j]->PremiumPhotoId); ?>" target="_blank" class="croppingBtn"><i class="fa fa-crop"></i> EDIT</a></li>
						<li class="last"><a href="javascript:void(0)" class="deletePhotos" data-id="<?=$photoes[$j]->PremiumPhotoId?>"><i class="fa fa-close"></i> DELETE</a></li>
                        <input type="hidden" id="no_of_photo_new" value="<?=$no_of_photo?>" name="no_of_photo_new" />
				        <input type="hidden" id="printPrice_new" value="<?=$printPrice?>" name="printPrice_new" />
				    </ul>
				</div>
			</div>
		<?php		
			}
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
	
	</div>
	
	<!-- Upload Photo Modal -->
	<div class="modal fade" id="uploadphoto" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4>Choose file</h4>
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
			<div class="cp-tab-text">
				<span style="width: 100%;" class="btn-submit">Coming Soon</span> 
			</div>
			<?php 
			/*
			<span id="loginStatus" style="display:none;" class="fblogin_message">You'll need to log in first</span>
			<div class="cp-tab-text text-center">
				<li class=""><!--Status: <span id="login-status">Not logged in</span> | --><a href="javascript:void(0)" id="btnLogin" class="fbbtn"><i class="fa fa-facebook" style="margin-right:10px"></i>Login with facebook</a><!-- | <a href="#" id="btnLogout">Log out</a>--></li>
      <li style="padding-top:20px;"><a href="javascript:void(0)" class="read-more photoSelect" style="pointer-events:none;">Select Your Facebook Photos</a><!-- (You'll need to log in first)--></li>
			</div>
			*/
			?>
		</div>
	</div>
	<div class="tab-pane fade" id="cp_tab3">
	<div class="cp-tab-info-box">
	<div class="cp-tab-text">
	
	<form action="" method="post" enctype="multipart/form-data" id="photostripupload">
	<input type="hidden" id="imageUrl" value="" name="image_url">
	<table width="500" border="0">
	  <tr>
		<td>&nbsp; </td>
                        <td class="text-center"><div class="clearfix">&nbsp;</div>
                          <div class="box">
					<?php 
					if($productid=="passports"){
						$multiple = "";
					} else {
						$multiple = "multiple";
					}
					?>
					<input name="ImageFile[]" id="file-1" class="inputfile inputfile-2" type="file" data-multiple-caption="{count} files selected" <?php echo $multiple; ?>/>
				
				<label for="file-1" style="margin: 0 auto">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> 
					<span>Choose a file&hellip;</span>
				</label>
			</div>
		</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td class="text-center"><input type="button"  id="SubmitButton" value="Upload" disabled/></td>
        
		<input type="hidden" id="premiumPhotoOrderId" value="<?=$premiumPhotoOrderId?>" name="premiumPhotoOrderId" />
		<input type="hidden" id="productId" value="<?=$productId?>" name="productId" />
		<input type="hidden" id="productName" value="<?=$productName?>" name="productName" />
        <input type="hidden" id="no_of_photo" value="<?=$no_of_photo?>" name="no_of_photo" />
        <input type="hidden" id="printPrice" value="<?=$printPrice?>" name="printPrice" />
        <td><img src="<?=DEFAULT_URL?>/images/loader.gif" id="uploading" style="display: none"></td>
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
	  
	<div class="modal fade" id="crop_photo" role="dialog">
		<div class="modal-dialog">
		  <div class="modal-content">
		   
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Crop Photo</h4>
			</div>
			<div class="modal-body">
	
	
		 <form class="uploadform">
	<div class="eg-wrapper">
	
			  <img class="cropper" alt="Picture" id="cropper_image">
			  <input type="hidden" value="" id="premiumprintPhotoId" />
			</div>
	<div class="eg-preview clearfix" style="display:none;">
			  <div class="preview preview-lg"></div>
			  <div class="preview preview-md"></div>
			  <div class="preview preview-sm"></div>
			  <div class="preview preview-xs"></div>
			</div>
	<div class="zoom_img">
			<button class="btn btn-info" id="zoomIn" type="button">+</button>
			<button class="btn btn-info" id="zoomOut" type="button" style="float:right;">-</button>
			<button class="btn btn-info" id="rotateLeft" type="button"><span class="fa fa-rotate-left"></span></button>
			<button class="btn btn-info" id="rotateRight" type="button"><span class="fa fa-rotate-right"></span></button></div>
	<!--<div class="input-group">
				<span class="input-group-addon">Width</span>
				<input class="form-control" id="dataWidth" type="text" placeholder="width" readonly>
				<span class="input-group-addon">px</span>
			  </div>
	<div class="input-group">
				<span class="input-group-addon">Height</span>
				<input class="form-control" id="dataHeight" type="text" placeholder="height" readonly>
				<span class="input-group-addon">px</span>
			  </div> -->
	
		   
		   <label><span id="photosubmitbtn"><a class="photosubmit" href="javascript:void(0)" >Continue</a> </span></label>
		 
			<!-- <button class="btn btn-primary" id="getDataURL" data-toggle="tooltip" type="button" >Get Data URL (JPG)</button>-->
	
	
	</form>
	   <img src="" id="preview" />         
	
				
			</div>
		  </div>
		</div>
	</div>  
    
<div class="modal-delete-photo modal-effect-blur" id="modal-1">
		<div class="modal-content">
			<h3>Are you sure you want to delete?</h3>
			<div>
				<button data-id="" class="modal-delete">Delete</button>
				<button class="modal-delete-cancel">Cancel</button>
			</div>
		</div>
	</div>
	<?php include('includes/facebook_imagebox.php'); ?>

<div class="modal-overlay"></div>
	  
	 
	<?php
	 	
		include('includes/footer.php');
		include('includes/common_js.php');
	?>
		
	  <script src="<?=DEFAULT_URL?>/js/photoedit/cropper.js"></script>
	  <script src="<?=DEFAULT_URL?>/js/photoedit/docs.js"></script>
		<?php
		include('photostrip-upload-script.php');
		



?>




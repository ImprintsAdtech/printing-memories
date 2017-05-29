<?php
include_once("conf/loadconfig.inc.php"); 

session_start();
extract($_POST);
extract($_GET);


if(isset($_SERVER["REDIRECT_URL"]) && !empty($_SERVER["REDIRECT_URL"])){
	$_SESSION["redirect_url"] = $_SERVER["REDIRECT_URL"];
}
$obj_product = new Photomanager();
$currentTimestamp = getCurrentTimestamp();
$userId = $_SESSION['userId'];
if(isset($_SESSION['userId']) && $_SESSION['userId'] != ""){
	
	$resultpro=$obj_product->get_id_all('finalSlug', $productid, 'productManager');
	while($productData = $db->fetchNextObject($resultpro)){
		$productId=$productData->productId;
	}
	
	$productId;
	
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
	if($orderDate_month == $timestamp1)
	{
		header('Location: '.DEFAULT_URL.'/login');		
		
	}
	$cart_delete="DELETE FROM cart WHERE productId='".$productId."' AND userId='".$_SESSION['userId']."' AND cartBuyStatus='0'";
	mysql_query($cart_delete);
	
	$freeorder=$obj_product->getFreePhotoOrder($productId,$userId);
	$productDetail = $obj_product->getProductAllDetail($productId);
	if($db->numRows($productDetail) == 1){
			while($productDetails = $db->fetchNextObject($productDetail)){
				$no_of_photo = $productDetails->no_of_photos;
				$productSize = $productDetails->productSize;
				$productSizeId = $productDetails->productSizeId;
				$productName = $productDetails->productTitle;
			}
			 if($db->numRows($freeorder)>0){
				 while($freeorderData = $db->fetchNextObject($freeorder)) {
					$freePhotoOrderId = $freeorderData->freePhotoOrderId;
				 }
			 } else {
				 $dataArr = array('productId'=>$productId,
										'userId'=>$userId,
										'no_of_photos'=>$no_of_photo,
										'productSize'=>$productSize,
										'buyStatus'=>'0',
										'productSizeId'=>$productSizeId,
										'freeFinishing'=>"glossy",
										'onetimeStatus'=>'0',
										'createdDatetime'=>date("Y-m-d H:i",strtotime('330 min',strtotime(gmdate("Y/m/d h:i:s A"))))

						);	
				$freePhotoOrderId = $obj_product->insertFreephotoOrder($dataArr,$obj_product->tblfreeorder); 

			 }

	}

if(!empty($freePhotoOrderId)){
	if($_SERVER['HTTP_REFERER']==DEFAULT_URL."/cart"){
		mysql_query("DELETE FROM `cart` WHERE `cart`.`userId` = ".$userId." AND `cart`.`freePhotoOrderId` = ".$freePhotoOrderId);
	}	
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Printmysnap - Free Photos for Lifetime | Upload Free Photos</title>
<link rel="stylesheet" href="<?php echo DEFAULT_URL; ?>/css/csphotoselector.css">

<style>
/*Passport*/
.passportsize .img-thumbnail{
	height:auto !important;
	max-width:65mm !important;
	
}
.passportsize .col-md-4{
	width:65mm !important;
	height:65mm !important;
	
}
.passportsize .printingPhoto{
	width:55mm !important;
	height:65mm !important;
}
.passportsize .img-count{
	font-size:13px !important;
	right:25px !important;
	
}

/*4*4 size*/
.fourby4size .img-thumbnail{
	height:auto !important;
	max-width:95.6mm !important;
	
}
.fourby4size .col-md-4:last-child{
	margin-right:0px;
}
.fourby4size .col-md-4{
	width:390px !important;
	height:110mm !important;
	margin-bottom:20px;
	
}
.fourby4size .printingPhoto{
	width:360px !important;
	height:360px !important;
}
.fourby4size .img-count{
	font-size:13px !important;
	right:25px !important;
	
}

/*6*4 size*/
.sixby4size .img-thumbnail{
	height:auto !important;
	max-width:95.6mm !important;
	
}
.sixby4size .col-md-4:last-child{
	margin-right:0px;
}
.sixby4size .col-md-4{
	width:390px !important;
	height:565px !important;
	margin-bottom:20px;
	
}
.sixby4size .printingPhoto{
	width:360px !important;
	height:145mm !important;
}
.sixby4size .img-count{
	font-size:13px !important;
	right:25px !important;
	
}
</style>
<script type="text/javascript" src="//api.filestackapi.com/filestack.js"></script>
<script>
filepicker.setKey("Av6fNZcGDTSeOvrGQD0TEz")
</script>

<?php 

			include('includes/common_css.php');

			include('includes/header.php');

			$pageTitle = ucFirst(str_replace("-", " ", $productid));

	?>

<div class="cp-inner-banner">
  <div class="container">
    <div class="cp-inner-banner-outer">
      <h2><?php echo !empty($pageTitle) ? $pageTitle : ""; ?></h2>
    </div>
  </div>
</div>
<?php if($productid!="passports"){ ?>
<div class="clearfix"></div>
<div class="bgred" id="sticker">
  <div class="container">
    <div class="row toppricestrip">
      <input type="hidden" value="<?=$premiumPhotoOrderId?>" id="premiumOrderIdss" />
      <input type="hidden" value="<?=$productId?>" id="productId1" />
      <input type="hidden" value="<?=$guestUserId?>" id="guestUserId" />
      <input type="hidden" value="<?=$userId?>" id="UserId" />
      <div class="col-md-2 text-center">
        <label>Size</label>
        <br>
        <span id="printSize"><?php echo $productSize; ?></span> </div>
      <div class="col-md-2 text-center">
        <label>Finish</label>
        <br>
        <?php 
					$resourceId = mysql_query("select * from freePhotoOrder where freePhotoOrderId = ".$freePhotoOrderId);
					$proFinishing="";
					if(!empty($resourceId)){
						$freePhotoOrderData = mysql_fetch_assoc($resourceId);
						$proFinishing = !empty($freePhotoOrderData["freeFinishing"]) ? $freePhotoOrderData["freeFinishing"] : "";
					}
					?>
        <select name="proFinishing" id="proFinishing">
          <option <?php if($proFinishing == "gloss"){echo "selected";} ?> value="glossy">Gloss</option>
          <option <?php if($proFinishing == "matte"){echo "selected";} ?> value="matte">Matte</option>
        </select>
      </div>
      <div class="col-md-2 text-center">
        <label>Price per print</label>
        <br>
        <span id="printPriceval">0</span> </div>
      <div class="col-md-2 text-center">
        <label>Set of photos</label>
        <br>
        <span id="nophotoval">
        <?php if($no_of_photo == "" || $no_of_photo == '0'){echo $no_of_photo_arr[0];} else{ echo $no_of_photo; }?>
        </span> </div>
      <div class="col-md-2 text-center">
        <label>Total Price</label>
        <br>
        <span id="price">FREE</span> </div>
        
        <div class="col-md-2 text-center">
        <div class="picsize">
            <?php
						$photosUploaded = $obj_product->getAllFreePrintPhoto($freePhotoOrderId);
						$count = $db->numRows($photosUploaded);
						if($no_of_photo == ""){
							$no_of_photo = 0;	
						}
						if($productid=="passports"){
							$no_of_photo = 1;
							//$aspectRatio = 
						}
						?>
            <h2 style="margin-top:20px"><!--<a href="#" class="read-more">autofill</a>-->
              <?=$count?>
              /
              <?=$no_of_photo?>
            </h2>
          </div>
        </div>
        
    </div>
  </div>
</div>
<?php } else { ?>
<div class="clearfix"></div>
<div class="bgred" id="sticker">
  <div class="container">
    <div class="row toppricestrip">
      <input type="hidden" value="<?=$premiumPhotoOrderId?>" id="premiumOrderIdss" />
      <input type="hidden" value="<?=$productId?>" id="productId1" />
      <input type="hidden" value="<?=$guestUserId?>" id="guestUserId" />
      <input type="hidden" value="<?=$userId?>" id="UserId" />
      <div class="col-md-2 text-center">
        <label>Size</label>
        <br>
        <span id="printSize"><?php echo $productSize; ?></span> </div>
      <div class="col-md-2 text-center">
        <label>Finish</label>
        <br>
        <span id="finishmatte">Matte</span>
        <?php 
					$resourceId = mysql_query("select * from freePhotoOrder where freePhotoOrderId = ".$freePhotoOrderId);
					$proFinishing="";
					if(!empty($resourceId)){
						$freePhotoOrderData = mysql_fetch_assoc($resourceId);
						$proFinishing = !empty($freePhotoOrderData["freeFinishing"]) ? $freePhotoOrderData["freeFinishing"] : "";
					}
					?>
        <?php /*?><select name="proFinishing" id="proFinishing">
          <option <?php if($proFinishing == "matte"){echo "selected";} ?> value="matte">Matte</option>
        </select><?php */?>
      </div>
      <div class="col-md-2 text-center">
        <label>Price per print</label>
        <br>
        <span id="printPriceval">0</span> </div>
      <div class="col-md-2 text-center">
        <label>Set of photos</label>
        <br>
        <span id="nophotoval">
        <?php if($no_of_photo == "" || $no_of_photo == '0'){echo $no_of_photo_arr[0];} else{ echo $no_of_photo; }?>
        </span> </div>
      <div class="col-md-2 text-center">
        <label>Total Price</label>
        <br>
        <span id="price">FREE</span> </div>
        <div class="col-md-2 text-center">
        <div class="picsize">
            <?php
						$photosUploaded = $obj_product->getAllFreePrintPhoto($freePhotoOrderId);
						$count = $db->numRows($photosUploaded);
						if($no_of_photo == ""){
							$no_of_photo = 0;	
						}
						if($productid=="passports"){
							$no_of_photo = 1;
							//$aspectRatio = 
						}
						?>
            <h2 style="margin-top:20px"><!--<a href="#" class="read-more">autofill</a>-->
              <?=$count?>
              /
              <?=$no_of_photo?>
            </h2>
          </div>
        </div>
    </div>
  </div>
</div>

<?php }?>
<div class="cp-main-content">
  <section class="cp-about-section pd-tb30">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="picsize">
            <h2 style="text-align:center;">
              <?php 
							echo $productName;
							echo " : ";
							echo $productSize;
							?>
            </h2>
          </div>
        </div>
        <div class="col-md-4 text-right">
          <div class="picsize">
            <?php
						$photosUploaded = $obj_product->getAllFreePrintPhoto($freePhotoOrderId);
						$count = $db->numRows($photosUploaded);
						if($no_of_photo == ""){
							$no_of_photo = 0;	
						}
						if($productid=="passports"){
							$no_of_photo = 1;
							//$aspectRatio = 
						}
						?>
            <h2><!--<a href="#" class="read-more">autofill</a>-->
              <?php //echo $count?>
        		
              <?php //echo $no_of_photo?>
            </h2>
          </div>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="clearfix"></div>
        <div class="col-md-12 text-center">
          <?php
						if($count == $no_of_photo){
						?>
          <?php /*?><a href="javascript:void(0)" class="read-more" style="pointer-events:none;" title="Kindly upload photos of adequate resolution for better print quality">UPLOAD PHOTOS <i class="fa fa-upload"></i></a><?php */?>
          <?php	
						} else {
						?>
          <?php /*?><a href="javascript:void(0)" class="read-more"  data-toggle="modal" data-target="#uploadphoto" title="Kindly upload photos of adequate resolution for better print quality">UPLOAD PHOTOS <i class="fa fa-upload"></i></a><?php */?>
          <?php
						}
						?>
                        
                        <?php if($productid=="passports" && $count=='1'){
						}else { 
							
							if($productid=="standard-prints"){
								
								$no_of_photo2=(9-$count);
								$crop_ratio='4/6';
								
							}else if($productid=="squares"){
								$no_of_photo2=(12-$count);
								$crop_ratio='4/4';
							}else{
								$no_of_photo2=$no_of_photo;
								$crop_ratio='3/4';
							}
							
						?>
                        <input type="filepicker" data-fp-extensions='.png,.jpeg,.jpg,.JPG,.JPEG,.PNG,.bmp,.BMP,.TIFF,.GIF,.tief,.gif' data-fp-crop-force='true' onchange="filesUploaded(event)" data-fp-multiple="true" data-fp-crop-ratio="<?php echo $crop_ratio; ?>" data-fp-crop-min="400, 300"  data-fp-store-location="S3" data-fp-store-access="public" data-fp-conversions="crop,rotate,filter"  data-fp-apikey="Av6fNZcGDTSeOvrGQD0TEz" data-fp-maxFiles='<?php echo $no_of_photo2; ?>'>
                        <?php }?>

        </div>
        <div class="clearfix">&nbsp;</div>
        
        <?php
		
		if($productSize=='6*4 (inches)'){
			$size_clas="sixby4size";
		}else if($productSize=='4*4 (inches)'){
			$size_clas="fourby4size";
		}else if($productSize=='45 mm * 35 mm'){
			$size_clas="passportsize";
		}
		
		?>
        <div class="four_sixphotos <?php echo $size_clas; ?>">
          <?php
						$uploadedPhotoes = 0;
						if($db->numRows($photosUploaded)>0){
							$i=1;
							$uploadedPhotoes = mysql_num_rows($photosUploaded);
							while($photosUploadedData = $db->fetchNextObject($photosUploaded)) {
								$orderID = $photosUploadedData->freePhotoOrderId;
								$orderDetail = mysql_query("Select * from `freePhotoOrder` where `freePhotoOrder`.`freePhotoOrderId` = ".$orderID);
								if(!empty($orderDetail)){
									$sizeData = mysql_fetch_assoc($orderDetail);
									$sizes = $sizeData["productSize"];
									if($productid=="passports"){
										$ratio = str_replace("mm", "", $sizes);
										$heightWidth = explode("*", $ratio); 
										$height = $heightWidth[0]*10;
										$width = $heightWidth[1]*10;
									} else {
										$ratio1 = explode(" ", $sizes);
										$ratio = $ratio1[0];
										$heightWidth = explode("*", $ratio); 
										$height = $heightWidth[0]*100;
										$width = $heightWidth[1]*100;
									}
								}
								
							$freePhotoName=$photosUploadedData->freePhotoName;
							$upload_server=$photosUploadedData->upload_server;
							
							if ($upload_server=='our') {
								$freePhotoName = DEFAULT_URL.'/uploads/'.$freePhotoName;
							}else if($upload_server=='s3'){
								$freePhotoName =S3_URL.$freePhotoName;
							}else{
								$freePhotoName =$freePhotoName;
							}
								
						?>
          <div class="col-md-4 text-center showoption"> <img src="<?=$freePhotoName?>" alt="" class="img-thumbnail printingPhoto" height='<?php echo $height."px"; ?>' width='<?php echo $width."px"; ?>'>
            <div class="img-count">
              <?=$i?>
            </div>
            <div class="showoptiondiv">
              <ul>
                <?php 
										    if($productid!="passports"){
										    ?>
                <li><a href="javascript:void(0)" data-photoid="<?=$photosUploadedData->freePhotoId?>" class="autofill_photo">ADD</a></li>
                <?php 
										    } 
										    ?>
                <!-- <li><a href="<?=DEFAULT_URL?>/cropPhoto.php?photo=<?php echo base64_encode($photosUploadedData->freePhotoId); ?>&order=<?php echo base64_encode($freePhotoOrderId); ?>&type=free" class="croppingBtn" data-img="<?=DEFAULT_URL?>/uploads/<?=$photosUploadedData->freePhotoName?>"><i class="fa fa-crop"></i> ROTATE & CROP</a></li>
                
                <li><a href="<?=DEFAULT_URL?>/editPhoto.php?photo=<?php echo base64_encode($photosUploadedData->freePhotoId); ?>"  class="croppingBtn" target="_blank" ><i class="fa fa-pancil"></i> Edit</a></li> -->
                
                <li class="last"><a href="javascript:void(0)" class="deletePhotos" data-id="<?=$photosUploadedData->freePhotoId?>"><i class="fa fa-close"></i> DELETE</a> </li>
              </ul>
            </div>
          </div>
          <?php 
								if($i%3 == 0){
									echo '<div class="clearfix">&nbsp;</div>';	
								}
							$i++;
							}
						}
						?>
          <input type="hidden" id="uploadedPhotos" value="<?php echo $uploadedPhotoes; ?>">
          <div class="clearfix">&nbsp;</div>
          <div class="clearfix">&nbsp;</div>
          <?php
						if(isset($count) && $count == $no_of_photo) {
						?>
          <center>
            <a href="javascript:void(0)" data-proid="<?=$freePhotoOrderId?>" id="freecartAddBtn" class="read-more" title="">CONTINUE <i class="fa fa-arrow-right" aria-hidden="true"></i></a>

          </center>
          <?php 
						} else if($count > 0){
						?>
          <center>
            <span data-proid="<?=$freePhotoOrderId?>"  class="read-more" title="Please upload required number of photos to continue">CONTINUE <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
            <p style="padding-top:5px;">Kindly upload <?php echo $no_of_photo ?> photos to continue</p>
          </center>
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
        <h4>Choose Photos</h4>
      </div>
      <div class="modal-body">
        <div class="cp-tab-box">
          <ul class="nav nav-tabs" role="tablist">
            <li class="active"> <a href="#cp_tab1" role="tab" data-toggle="tab">
              <?php 

			$detect = new Mobile_Detect;

			$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

			if($deviceType=='phone'){

				echo "My Device";

			}else{

				echo "My Computer";

			}

		?>
              </a> </li>
            <li><a href="#cp_tab2" role="tab" data-toggle="tab">Instagram</a></li>
            <li><a href="#cp_tab3" role="tab" data-toggle="tab">Facebook</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active fade in" id="cp_tab1">
              <div class="cp-tab-info-box">
                <div class="cp-tab-text">
                  <form action="" method="post" enctype="multipart/form-data" id="freePhotoPrintupload">
                    <table width="100%" border="0">
                      <tr>
                        <td>&nbsp;</td>
                        <td class="text-center"><div class="clearfix">&nbsp;</div>
                          <div class="box">
                            <?php 
										if($productid=="passports"){
											$multiple = "";
										} else {
											$multiple = "multiple";
										}
			?>
                            <input name="ImageFile[]" id="file-1" class="inputfile inputfile-2" type="file" data-multiple-caption="{count} files selected" <?php echo $multiple; ?> accept="image/*"/>
                            <input type="hidden" value="" id="puraniFile">
                            <label for="file-1" class="btn-submit" style="margin: 0 auto; cursor:pointer;" class="text-center"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                              <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                              </svg> <span id="numOfPhotsSelected">Choose a file&hellip;</span> </label>
                          </div>
                          <div class="clearfix">&nbsp;</div></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td class="text-center"><input type="button"  id="SubmitButton" value="Upload" class="btn-submit" title="Kindly uplaod photos of adequate resolution for better print quality" disabled/></td>
                        <input type="hidden" id="freePhotoOrderId" value="<?=$freePhotoOrderId?>" name="freePhotoOrderId" />
                        <input type="hidden" id="productId" value="<?=$productId?>" name="productId" />
                        <input type="hidden" id="productName" value="<?=$productName?>" name="productName" />
                        <input type="hidden" id="no_of_photo" value="<?=$no_of_photo?>" name="no_of_photo" />
                        <input type="hidden" id="uploaded_no_photos" value="<?=$count?>" name="uploaded_no_photos" />
                      </tr>
                      <tr>
                        <td><img src="<?=DEFAULT_URL?>/images/loader.gif" id="uploading" style="display: none"></td>
                      </tr>
                    </table>
                  </form>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="cp_tab2">
              <div class="cp-tab-info-box">
                <div class="cp-tab-text"> <span style="width: 100%;" class="btn-submit">Coming Soon</span> </div>
              </div>
            </div>
            <div class="tab-pane fade" id="cp_tab3">
              <div class="cp-tab-info-box">
                <?php 

				/*

				<div class="cp-tab-text">



					<span style="width: 100%;" class="btn-submit">Coming Soon</span> 



				</div>

				*/

				?>
                <span id="loginStatus" style="display:none;" class="fblogin_message">You'll need to log in first</span>
                <div class="cp-tab-text text-center">
                  <li style="padding-top:40px;" class=""><a href="javascript:void(0)" id="btnLogin" class="fbbtn"><i class="fa fa-facebook" style="margin-right:10px"></i>Login with facebook</a></li>
                  <li style="padding-top:40px;"><a href="javascript:void(0)" class="read-more photoSelect" style="pointer-events:none; border: none;">Select Your Facebook Photos</a><!-- (You'll need to log in first)--></li>
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
          <div class="eg-wrapper"> <img class="cropper" alt="Picture" id="cropper_image">
            <input type="hidden" value="" id="freeprintPhotoId" />
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
            <button class="btn btn-info" id="rotateRight" type="button"><span class="fa fa-rotate-right"></span></button>
          </div>
          
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
        <img src="" id="preview" /> </div>
    </div>
  </div>
</div>
<div class="modal-delete-photo modal-effect-blur" id="modal-1">
  <div class="modal-content">
    <h3>Are you sure you want to delete?</h3>
    <div>
      <button data-id="" class="modal-delete btn-submit" style="margin-bottom:5px;">Delete</button>
      <button class="modal-delete-cancel btn-submit" style="margin-bottom:5px;">Cancel</button>
    </div>
  </div>
</div>
<?php 

	/*

	<div class="modal fade" id="message_box" role="dialog">

		<div class="modal-dialog">

			<div class="modal-content">

				<?php 

				if(isset($_SESSION["success_message"])){

				?>

					<h3><?php echo !empty($_SESSION["success_message"]) ? $_SESSION["success_message"] : "";?></h3>

				<?php 

				}  

				?>

				<div>

					<button class="modal-delete-cancel btn-submit">OK</button>

				</div>

			</div>

		</div>

	</div>

	*/

	?>
<script>
window.filesUploaded = function (event) {
  event.fpfiles.forEach(function (blob) {
    var test_url=blob.key;
	
	var productId = $(this).attr('data-proid');

	var proSize = $('#proSize').val();

	var proNoPhoto = $('#proNoPhoto').val();

	var freeOrderIdss = $('#freeOrderIdss').val()
	  	$.ajax({

         			type: "POST",

         			url: "<?php echo DEFAULT_URL ?>/freeupload-photo-ajax.php",

         			data: {test_url:test_url,productId:<?=$productId?>,freeOrderIdss:<?=$freePhotoOrderId?>,productName:'<?=$productName?>',action:"filestack_image_upload"}, 

					success: function(responseText) {
						if(responseText !='' && responseText == 1){
							 location.reload();
							 $('.preloader').css('display','none');

						}

					}
        
         		});
	
  })
}
</script>

<?php include("includes/facebook_imagebox.php"); ?>
<div class="modal-overlay"></div>
<?php

		include('includes/footer.php');

		include('includes/common_js.php');

	?>
<script src="<?=DEFAULT_URL?>/js/photoedit/cropper.js"></script> 
<script src="<?=DEFAULT_URL?>/js/photoedit/docs.js"></script> 
<script>

/*$(document).ready(function() {
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
});*/

	  	jQuery(window).resize(function() {
			var width = screen.width,
				height = screen.height;
			if(width <= 768 && height <= 1024){
				jQuery(".editor").css("display", "none");
				jQuery(".cropper").css("display", "block");
			}    
		});
		jQuery(document).ready(function(){
			setTimeout(function(){ 
				<?php unset($_SESSION["success_message"]);?>
			}, 5000);
		})
	</script>
<?php

	include('freeupload-photos-script.php');

} else {

	header('Location: '.DEFAULT_URL.'/login');		

}
?>


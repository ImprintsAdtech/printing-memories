<?php

include_once("conf/loadconfig.inc.php"); 

session_start();

extract($_POST);

extract($_GET);

$obj_product = new Photomanager();

if(isset($_SESSION["lastPageUrl"]) && empty($_SESSION["lastPageUrl"])){

  $lastPageUrl = $_SESSION["lastPageUrl"];

  session_destroy($_SESSION["lastPageUrl"]);

}

$currentTimestamp = getCurrentTimestamp();

$userId = $_SESSION['userId'];

$guestUserId = $_SESSION['guestUserId'];

if($userId == ""){

  $userId = $_SESSION['guestUserId']; 

}

$photoId = base64_decode($photo);

$orderId = base64_decode($order);

if($type=="paid"){

  $photoDetail = $obj_product->getPremiumPhotoDetails($photoId);

  $imageName = $photoDetail->premiumPhotoName;

  $productId = $photoDetail->productId; 

  $premiumPhotoOrderId = $photoDetail->premiumPhotoOrderId; 

  $productSize = "";

  $productRatio = "";

  $photoOrderDetail = mysql_query("Select `premiumPhotoOrder`.`productSize` from `premiumPhotoOrder` where `premiumPhotoOrder`.`premiumPhotoOrderId` = ".$premiumPhotoOrderId." And `premiumPhotoOrder`.`productId` = ".$productId);

  if(!empty($photoOrderDetail)){

    $photoSizeDetail = mysql_fetch_assoc($photoOrderDetail);

    $productSize = !empty($photoSizeDetail["productSize"]) ? $photoSizeDetail["productSize"] : "";

  }

  if(!empty($productSize)){

    $productRatio = explode("*", $productSize);

    $ratio = $productRatio[0]/$productRatio[1]; 

  }

} else if($type="free"){

  $freePhoto = mysql_query("Select * From `freePrintPhotos` left join `productManager` on `freePrintPhotos`.`productId` = `productManager`.`productId` where `freePrintPhotos`.`freePhotoId` = ".$photoId);

  $freePhotoDetail = mysql_fetch_assoc($freePhoto);

  $productSlug = $freePhotoDetail["productSlug"];

  $imageName = $freePhotoDetail["freePhotoName"];

  $productId = $freePhotoDetail["productId"]; 

  $freePhotoOrderId = $freePhotoDetail["freePhotoOrderId"]; 

  $productSize = "";

  $productRatio = "";

  $photoOrderDetail = mysql_query("Select `freePhotoOrder`.`productSize` from `freePhotoOrder` where `freePhotoOrder`.`freePhotoOrderId` = ".$freePhotoOrderId." And `freePhotoOrder`.`productId` = ".$productId);

  if(!empty($photoOrderDetail)){

    $photoSizeDetail = mysql_fetch_assoc($photoOrderDetail);

    $productSize = !empty($photoSizeDetail["productSize"]) ? $photoSizeDetail["productSize"] : "";

  }

  if(!empty($productSize)){

    $productRatio = explode("*", $productSize);

      $ratio = $productRatio[1]/$productRatio[0]; 
    

  }

}

?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Printmysnap - Free Photos for Lifetime | Crop Photos</title>
<?php 

      include('includes/common_css.php');

      include('includes/header.php');

  ?>

<div class="cp-inner-banner">
  <div class="container">
    <div class="cp-inner-banner-outer"> </div>
  </div>
</div>
<div class="clearfix"></div>
<div class="bgred" id="sticker">
  <div class="container">
    <div class="img-container"> <img id="image" src="<?php echo DEFAULT_URL."/uploads/".$imageName; ?>" alt="Picture"> </div>
    <div class="docs-buttons">
      <div class="btn-group">
        <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)"> <span class="fa fa-search-plus"></span> </span> </button>
        <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)"> <span class="fa fa-search-minus"></span> </span> </button>
      </div>
      <div class="btn-group">
        <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, -45)"> <span class="fa fa-rotate-left"></span> </span> </button>
        <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, 45)"> <span class="fa fa-rotate-right"></span> </span> </button>
      </div>
      <input id="defaultRatio" type="hidden" value="<?php echo !empty($ratio) ? $ratio : '' ;?>">
      <div class="btn-group btn-group-crop">
        <button type="button" class="btn btn-primary" data-method="getCroppedCanvas"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)"> Crop Photo </span> </button>
      </div>
      <div class="btn-group btn-group-crop"> <a href = "<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-primary">Cancel</a> </div>
      
      <!-- Show the cropped image in modal -->
      
      <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="getCroppedCanvasTitle">Cropped</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
              <form id="hiddenCroppedImageForm">
                <input id="PhotoId" type="hidden" name="PhotoId" value="<?php echo !empty($photoId) ? $photoId : "" ;?>">
                <input id="imageDataUrl" type="hidden" name="imageDataUrl" value="">
                <input id="imageName" type="hidden" name="imageName" value="<?php echo !empty($imageName) ? $imageName : '';?>">
                <input id="productType" type="hidden" name="productType" value="<?php echo !empty($type) ? $type : '' ;?>">
                <input id="uploadAjaxUrl" type="hidden" value="<?php echo DEFAULT_URL; ?>/uploadajaximage.php">
                <input id="lastPageUrl" type="hidden" value="<?php echo !empty($lastPageUrl) ? $lastPageUrl : "" ;?>">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="Replace">OK</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /.modal --> 
      
    </div>
    <!-- /.docs-buttons --> 
    
  </div>
</div>
<?php

    include('includes/footer.php');

    include('includes/common_js.php');

    include('premiumUpload-photos-script.php');

  ?>
<link href="<?=DEFAULT_URL?>/css/cropper.css" rel="stylesheet">
<link href="<?=DEFAULT_URL?>/css/main.css" rel="stylesheet">
<script src="<?=DEFAULT_URL?>/js/photoedit/cropper.js"></script> 
<script src="<?=DEFAULT_URL?>/js/photoedit/main.js"></script>
</body></html>

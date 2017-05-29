<?php
include_once("conf/loadconfig.inc.php"); 
if(!isset($_SESSION['userId']) && $_SESSION['userId'] == "")
{
header('Location: '.DEFAULT_URL);	
}
else
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Photo Print Studio | Photo Print</title>
 <link href="<?=DEFAULT_URL?>/css/photoedit/cropper.css" rel="stylesheet">
  <link href="<?=DEFAULT_URL?>/css/photoedit/docs.css" rel="stylesheet">

<?php 
		include('includes/common_css.php');
		include('includes/header.php');
?>
 
 
<div id="homev2-slider" class="owl-carousel">
<div class="item">
<div class="cp-slider-thumb"> <img src="images/h3-slide1.jpg" alt=""> </div>
<div class="container">
<div class="cp-slider-content">
<h2>Square <span>Prints</span></h2>
<p>We are an Event Planning Agency each event and client is unique and we believe our services should be as well.</p>
<a href="quote.html">Get Quick Quote</a> <a href="#">Learn More</a>
</div>
</div>
</div>
<div class="item">
<div class="cp-slider-thumb"> <img src="images/h3-slide2.jpg" alt=""> </div>
</div>
<div class="item">
<div class="cp-slider-thumb"> <img src="images/h3-slide3.jpg" alt=""> </div>
</div>
<div class="item">
<div class="cp-slider-thumb"> <img src="images/h3-slide4.jpg" alt=""> </div>
</div>
</div>

 
<div class="cp-main-content">

<section class="cp-about-section pd-tb60">
<div class="container">
<div class="row">
<h2 class="text-center margnbot50">Our Signature Print, Now in 5X5 !</h2>
<div class="col-md-12">

<div class="col-md-4 text-center showoption">
	<img src="images/blog-listing-02.jpg" alt="" class="img-thumbnail">
    <div class="img-count">6</div>
    <div class="showoptiondiv">
    	<ul>
        	<li><input name="" type="text" value="1" class="text-center" style="width:50px !important"></li>
            <li><a href="#"  class="croppingBtn" data-img="http://www.print.keshamrit.com/images/blog-listing-02.jpg" data-toggle="modal" data-target="#crop_photo"><i class="fa fa-crop"></i> CROP</a></li>
            <li class="last"><a href="#"><i class="fa fa-close"></i> DELETE</a></li>
        </ul>
    </div>
</div>
     
<div class="modal fade" id="crop_photo1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
       
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Choose Plan for Print Snap</h4>
        </div>
        <div class="modal-body">
     
        <!-- <h3 class="page-header">Demo:</h3> -->
        <form class="uploadform">
        <div class="img-container eg-wrapper">
        <?php
		$path = 'http://www.print.keshamrit.com/cropper-master/assets/img/picture.jpg';
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
		?>
          <img class="cropper" src="<?=$base64?>" alt="Picture">
        </div>
       
       				<div class="input-group">
                        <span class="input-group-addon">Height</span>
                        <input class="form-control" id="dataHeight" type="text" placeholder="height" readonly>
                        <span class="input-group-addon">px</span>
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
                    <div class="input-group">
                        <span class="input-group-addon">Width</span>
                        <input class="form-control" id="dataWidth" type="text" placeholder="width" readonly>
                        <span class="input-group-addon">px</span>
                    </div>
                    
                    <button class="btn btn-primary" id="getDataURL2" data-toggle="tooltip" type="button" >Get Data URL (JPG)</button>
           <label><span id="photosubmitbtn"><a class="photosubmit" href="javascript:void(0)" >Continue</a> </span></label>          
   </form>
          </div>
      </div>
    </div>
</div>   
     
<div class="modal fade" id="crop_photo" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
       
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Choose Plan for Print Snap</h4>
        </div>
        <div class="modal-body">


     <form class="uploadform">

<div class="eg-wrapper">
<?php
		/*$path = 'http://www.print.keshamrit.com/cropper-master/assets/img/picture.jpg';
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);*/
		?>
       
          <img class="cropper" alt="Picture" id="cropper_image">
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
<div class="input-group">
            <span class="input-group-addon">Width</span>
            <input class="form-control" id="dataWidth" type="text" placeholder="width" readonly>
            <span class="input-group-addon">px</span>
          </div>
<div class="input-group">
            <span class="input-group-addon">Height</span>
            <input class="form-control" id="dataHeight" type="text" placeholder="height" readonly>
            <span class="input-group-addon">px</span>
          </div> 

       
       <label><span id="photosubmitbtn"><a class="photosubmit" href="javascript:void(0)" >Continue</a> </span></label>
     
         <button class="btn btn-primary" id="getDataURL" data-toggle="tooltip" type="button" >Get Data URL (JPG)</button>


</form>
   <img src="" id="preview" />         

            
        </div>
      </div>
    </div>
</div>  
     



</div>








<div class="clearfix">&nbsp;</div>


</div>
</div>
</section>

<section class="cp-about-section guaranteedbg pd-tb60">
    <div class="container">
        <div class="row">
        
            <div class="col-md-12 text-center">
            	<img src="images/Satisfaction_Seal.png" alt="" width="150" height="150" class="margnbot20">
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

  <script src="<?=DEFAULT_URL?>/js/photoedit/cropper.js"></script>
  <script src="<?=DEFAULT_URL?>/js/photoedit/docs.js"></script>
    <!--<script src="<?=DEFAULT_URL?>/js/photoedit/main.js"></script>-->
<script>
      

  var $image = jQuery(".cropper");
$(document).on('click','.croppingBtn',function(){
	var imageUrl = $(this).data('img');
	$image.cropper("reset", true).cropper("replace",imageUrl);
});



              
$(document).on('click','.photosubmit',function(){

                     $image = jQuery(".cropper");
                     var blockimg_large = $image.cropper("getDataURL", "image/jpeg");
					
					  //var blockimg_large = $image.cropper("getCroppedCanvas");

										 $('#preview').attr('src',blockimg_large);
								alert(blockimg_large);	
						if(blockimg_large != "")
						{			 
 							jQuery.ajax({
			          type:"POST",
			          cache:false,
			          url:"<?=DEFAULT_URL?>/ajaximage.php",
			          data : {blockimg_large:blockimg_large},
			          success: function (html) {

			        }
			      });
						}
			     
										 
										 
										 
				});
			
										 
    </script>
    <?php
    }
    ?>
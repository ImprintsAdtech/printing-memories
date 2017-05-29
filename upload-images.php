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
<!--<form action="processupload.php" method="post" enctype="multipart/form-data" id="UploadForm">
<table width="500" border="0">
  <tr>
    <td>File : </td>
    <td><input name="ImageFile" type="file" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit"  id="SubmitButton" value="Upload" /></td>
  </tr>
</table>
</form>
-->


 <form method="post"  enctype="multipart/form-data" id="first_step" action="<?=DEFAULT_URL?>/ajaximage.php">
      <div class="imageupload">
       <input type="file" name="file_to_upload" id="inputImage" value="Browse">

<div id="loading"></div>

      </div>
     </form>
     
     
     
     
     <form class="uploadform">

<div class="eg-wrapper">
          <img class="cropper" src="" alt="Picture" id="cropper_image">
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


</div>



<img src="" id="preview" />




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
 
 <style>
#progressbox {
border: 1px solid #0099CC;
padding: 1px; 
position:relative;
width:400px;
border-radius: 3px;
margin: 10px;
display:none;
text-align:left;
}
#progressbar {
height:20px;
border-radius: 3px;
background-color: #003333;
width:1%;
}
#statustxt {
top:3px;
left:50%;
position:absolute;
display:inline-block;
color: #000000;
}
</style>


 <?php
	include('includes/footer.php');
	include('includes/common_js.php');
?>
<script type="text/javascript" src="<?=DEFAULT_URL?>/js/jquery.form.js"></script>
  <script src="<?=DEFAULT_URL?>/js/photoedit/cropper.js"></script>
  <script src="<?=DEFAULT_URL?>/js/photoedit/docs.js"></script>
<script>
        $(document).ready(function() {
        //elements
        var progressbox     = $('#progressbox');
        var progressbar     = $('#progressbar');
        var statustxt       = $('#statustxt');
        var submitbutton    = $("#SubmitButton");
        var myform          = $("#UploadForm");
        var output          = $("#output");
        var completed       = '0%';
                $(myform).ajaxForm({
                    beforeSend: function() { //brfore sending form
                        submitbutton.attr('disabled', ''); // disable upload button
                        statustxt.empty();
                        progressbox.slideDown(); //show progressbar
                        progressbar.width(completed); //initial value 0% of progressbar
                        statustxt.html(completed); //set status text
                        statustxt.css('color','#000'); //initial color of status text
                    },
                    uploadProgress: function(event, position, total, percentComplete) { //on progress
                        progressbar.width(percentComplete + '%') //update progressbar percent complete
                        statustxt.html(percentComplete + '%'); //update status text
                        if(percentComplete>50)
                            {
                                statustxt.css('color','#fff'); //change status text to white after 50%
                            }
                        },
                    complete: function(response) { // on complete
                        output.html(response.responseText); //update element with received data
                        myform.resetForm();  // reset form
                        submitbutton.removeAttr('disabled'); //enable submit button
                        progressbox.slideUp(); // hide progressbar
                    }
            });
        });




               jQuery(document).ready(function(){

                jQuery('.photosubmit').click(function(){
                     $image = jQuery(".cropper");
                     var blockimg_large = $image.cropper("getDataURL");

										 $('#preview').attr('src',blockimg_large);
										 
 				jQuery.ajax({
			          type:"POST",
			          cache:false,
			          url:"<?=DEFAULT_URL?>/ajaximage.php",
			          data : {blockimg_large:blockimg_large},
			          success: function (html) {

			        }
			      });
			     
										 
										 
										 
				});
				});
										 
    </script>
    <?php
    }
    ?>
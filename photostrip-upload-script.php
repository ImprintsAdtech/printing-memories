<script src="<?=DEFAULT_URL?>/js/csphotoselector.js"></script>
<script>
var _URL = window.URL;
var width;
var height;

$("#file-1").change(function (e) {
    var file, img;
    if ((file = this.files[0])) {
        img = new Image();
        img.onload = function () {
           width = this.width;
			height =  this.height;	
        };
        img.src = _URL.createObjectURL(file);
    }
});

$(document).on('click','#SubmitButton',function(){
	//alert('hello');
	
	$('.preloader').css('display','block');
	var ImageFile = "";
	$.map($('#file-1').get(0).files, function(file) {
		var ImageFile = file.name;
	  	var extension = ImageFile.split('.').pop().toUpperCase();
	  	if(ImageFile == "") {
			alert('please select image.');
			return false;
		} else if(ImageFile.length < 1) {
			alert('please select image.');
	        return false;
	    } else if (extension!="PNG" && extension!="JPG" && extension!="jpeg" && extension!="png" && extension!="jpg" && extension!="JPEG"){
	        alert("invalid extension "+extension);
			return false;
	    } else  if(width < 500 && height < 500) {
    		alert("Image dimension should be greater than 500x500");
			return false;	 
		} 
	});
			var formData = new FormData($('form#photostripupload')[0]);

			$.ajax({
				url: "<?=DEFAULT_URL?>/photostrip-upload-ajax.php?action=printingPhoto",
				type: "POST",
				data:  formData,
				contentType: false,
				cache: false,
				processData:false,
			
				success: function(responseText){
					//alert(responseText);
					/*var arr = responseText.split('@@@');
							
							responseText=arr[1];
							imageName=arr[0];*/

					if(responseText != '' && responseText ==1){
					
						 location.reload();
					
					}else{
						alert(responseText);
						location.reload();
					}
				}
			});
	
	
});


$(document).on('click','.deletePhotos',function(){
            var printPhotoId = $(this).attr('data-id');
			$('.modal-delete').attr('data-id',printPhotoId);
                $('#modal-1').addClass('modal-show');
                return false;
        });
		$(document).on('click','.modal-delete',function(){

			$('.preloader').css('display','block');
			var printPhotoId = $(this).attr('data-id');
			var no_of_photo =$('#no_of_photo_new').val();
			var printPrice =$('#printPrice_new').val();
			var premiumPhotoOrderId = $('#premiumOrderIdss').val();
	
				$.ajax({
						type: "POST",
						url: "<?=DEFAULT_URL?>/photostrip-upload-ajax.php",
						data:  {action:'printingPhotoDelete',printPhotoId:printPhotoId,no_of_photo:no_of_photo,printPrice:printPrice,premiumPhotoOrderId:premiumPhotoOrderId},
						success: function(responseText) {
							
							if(responseText !='' && responseText == 1){
								 location.reload();
							}
						}
					});

        });
		$(document).on('click','.modal-delete-cancel',function(){
            $(this).closest('.modal-delete-photo').removeClass('modal-show');
        });



$(document).on('click','.autofill_photo',function(){
	$('.preloader').css('display','block');
	var PremiumPhotoId = $(this).attr('data-photoid');
		var no_of_photo =$('#no_of_photo_new').val();
	var printPrice =$('#printPrice_new').val();
	//alert(PremiumPhotoId);
	$.ajax({
						type: "POST",
						url: "<?=DEFAULT_URL?>/photostrip-upload-ajax.php",
						data:  {action:'autofillPhoto',PremiumPhotoId:PremiumPhotoId,no_of_photo:no_of_photo,printPrice:printPrice},
						success: function(responseText) {
							//alert(responseText);
							if(responseText !='' && responseText == 1){
								 location.reload();
							}
						}
					});
});


var $image = jQuery(".cropper");
$(document).on('click','.croppingBtn',function(){
	var imageUrl = $(this).data('img');
	var dataId = $(this).data('id');
	$image.cropper("reset", true).cropper("replace",imageUrl);
	$('#premiumprintPhotoId').val(dataId)
});
           
$(document).on('click','.photosubmit',function(){
	$('.preloader').css('display','block');

                     $image = jQuery(".cropper");
                     var blockimg_large = $image.cropper("getDataURL", "image/jpeg");
					 var printPhotoId = $('#premiumprintPhotoId').val();
					 //alert(printPhotoId);
					// $('#preview').attr('src',blockimg_large);
					 //alert(blockimg_large);	
						if(blockimg_large != "")
						{			 
 							  jQuery.ajax({
							  type:"POST",
							  cache:false,
							  url:"<?=DEFAULT_URL?>/uploadajaximage.php",
							  data : {blockimg_large:blockimg_large,printPhotoId:printPhotoId,productType:"photostrip"},
							  success: function (html) {
								  //alert(html);
										if(html != "" && html == 1)
										{
											location.reload();
										}
			       					 }
								});
						}
});
	
	
$(document).on('click','#premiumcartAddBtn',function(){ 
$('.preloader').css('display','block');
var premiumPhotoOrderId = $(this).attr('data-proid');
$.ajax({

				url: "<?=DEFAULT_URL?>/photostrip-upload-ajax.php",
				type: "POST",
				data:  {action:"printingContinue",premiumPhotoOrderId:premiumPhotoOrderId},
				success: function(responseText){
					//alert(responseText);
					if(responseText != '' && responseText ==1){
						 window.location.href="<?=DEFAULT_URL?>/cart";
					}else if(responseText != '' && responseText ==0){
						window.location.href="<?=DEFAULT_URL?>/cart";
					}
				}
			});
});	



$(document).on('change','#proSize',function(){
	$('.preloader').css('display','block');
	
	var proFinishing = $('#proFinishing').val();
	var proSizeValue = $('#proSize').val();
	var productId = $('#productId1').val();
	var premiumOrderIdss = $('#premiumOrderIdss').val();
	//alert(proSizeValue);
	//alert(productId);
	$.ajax({
				url: "<?=DEFAULT_URL?>/photostrip-upload-ajax.php",
				type: "POST",
				data:  {action:"changeAllelements",proSizeValue:proSizeValue,productId:productId,premiumOrderIdss:premiumOrderIdss,proFinishing:proFinishing},
				success: function(responseText){
					//alert(responseText);
					location.reload();
					
				}
			});
});

$(document).on('change','#proSize',function(){
	$('.preloader').css('display','block');
	var proSizeValue = $(this).val();
	var productId = $('#productId1').val();
	//alert(productId);
	//alert(proSizeValue);
		$.ajax({
				url: "<?=DEFAULT_URL?>/photostrip-upload-ajax.php",
				type: "POST",
				data:  {action:"changePrice",proSizeValue:proSizeValue,productId:productId},
				success: function(responseText){
					var arr = responseText.split('@@@');
							
							price=arr[0];
							noPhoto=arr[1];
							//alert(price);
					$('.preloader').css('display','none');
				$('#printPriceval').html(price);
				$('#nophotoval').html(noPhoto);
				$('#totalPriceval').html(price);
				$('#totalnophotoval').html(noPhoto);
					
				}
			});
});
					
window.fbAsyncInit = function() {
	FB.init({
	  appId      : '1001056836647562',
	  xfbml      : true,
	  version    : 'v2.6'
	});

	FB.getLoginStatus(function(response) {
	  if (response.authResponse) {
	    jQuery("#btnLogin").hide();
	    jQuery("#fetchPhotosFromFB").show();
	  } else {
	    jQuery("#fetchPhotosFromFB").hide();
	    jQuery("#btnLogin").show();
	  }
	});
};

	(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

$(document).ready(function () {

	/*
	jQuery('#file-1').change(
        function(){
            if (jQuery(this).val()) {
                jQuery('#SubmitButton').attr('disabled',false);
            } 
        }
    );
	*/
	var selector, logActivity, callbackAlbumSelected, callbackPhotoUnselected, callbackSubmit;
	var buttonOK = $('#CSPhotoSelector_buttonOK');
	var o = this;


	/* --------------------------------------------------------------------
	 * Photo selector functions
	 * ----------------------------------------------------------------- */

	fbphotoSelect = function(id) {
		// if no user/friend id is sent, default to current user
		if (!id) id = 'me';
		callbackAlbumSelected = function(albumId) {
			var album, name;
			album = CSPhotoSelector.getAlbumById(albumId);
			// show album photos
			selector.showPhotoSelector(null, album.id);
		};

		callbackAlbumUnselected = function(albumId) {
			var album, name;
			album = CSPhotoSelector.getAlbumById(albumId);
		};

		callbackPhotoSelected = function(photoId) {
			var photo;
			photo = CSPhotoSelector.getPhotoById(photoId);
			buttonOK.show();
			logActivity('Selected ID: ' + photo.id);
		};

		callbackPhotoUnselected = function(photoId) {
			var photo;
			album = CSPhotoSelector.getPhotoById(photoId);
			buttonOK.hide();
		};

		callbackSubmit = function(photoId) {
			$('.preloader').css('display','block');
			photo = CSPhotoSelector.getPhotoById(photoId);
			jQuery("#imageUrl").val(photo.source);
			//var formData = new FormData($('form#PhotoPrintupload')[0]);
			var printOrderId = jQuery("#premiumOrderIdss").val();
			var productId = jQuery("#productId1").val();
			var guestUserId = jQuery("#guestUserId").val();
			var UserId = jQuery("#UserId").val();
			var productName = jQuery("#productName").val();
			var formData = {"photo_url":photo.source, 'premiumPhotoOrderId':printOrderId, 'productId':productId, 'userId':UserId, 'guestUserId':guestUserId, 'productName':productName};
			jQuery.ajax({
				url: "<?=DEFAULT_URL?>/premiumUpload-photo-ajax.php?action=imageFromFacebook",
				type: "POST",
				data:  formData,
				success: function(response){
					var arr = response.split('@@@');
					responseText=arr[1];
					imageName=arr[0];
					if(responseText != '' && responseText ==1){
						location.reload();
					}else{
						$('.preloader').css('display','none');
						jQuery('#modal-2').addClass('modal-show');
						jQuery("#alert-message").html(response);
					}
				}
			});
			//logActivity('<br><strong>Submitted</strong><br> Photo ID: ' + photo.id + '<br>Photo URL: ' + photo.source + '<br>');
		};


		// Initialise the Photo Selector with options that will apply to all instances
		CSPhotoSelector.init({debug: true});

		// Create Photo Selector instances
		selector = CSPhotoSelector.newInstance({
			callbackAlbumSelected	: callbackAlbumSelected,
			callbackAlbumUnselected	: callbackAlbumUnselected,
			callbackPhotoSelected	: callbackPhotoSelected,
			callbackPhotoUnselected	: callbackPhotoUnselected,
			callbackSubmit			: callbackSubmit,
			maxSelection			: 1,
			albumsPerPage			: 6,
			photosPerPage			: 200,
			autoDeselection			: true
		});

		// reset and show album selector
		selector.reset();
		selector.showAlbumSelector(id);
	}


	/* --------------------------------------------------------------------
	 * Click events
	 * ----------------------------------------------------------------- */

	$("#btnLogin").click(function (e) {
		e.preventDefault()//;
		//$('.preloader').css('display','block');
		FB.login(function (response) {
			if (response.authResponse) {
				var userId = response.authResponse.userID;
				var accessTokan = response.authResponse.accessToken;
				var fields = [
				          'id',
				          'first_name',
				          'last_name',
				          'gender',
				          'birthday',
				          'email'
				        ].join(',');

				FB.api("/me", {fields : fields}, function(response){
					var data = {'userFname':response.first_name, 'userLname':response.last_name, 'userGender':response.gender,'facebook_id':userId, 'userEmail':response.email, 'action':"user_registration", 'from':"facebook"};
					$.ajax({
						url: "<?php echo DEFAULT_URL; ?>/home_ajax.php",
						type: "POST",
						data:  data,
						success: function(response){
							var arr = response.split('@@@');
							responseText = arr[1];
							insertedUserId = arr[0];
							if((responseText != '' && responseText =="send") || responseText=="already"){
								var printOrderId = jQuery("#premiumOrderIdss").val();
								var productId = jQuery("#productId1").val();
								var guestUserId = jQuery("#guestUserId").val();
								var records = {
									'productId': productId,
									'premiumPhotoOrderId': printOrderId,
									'user_id': insertedUserId,
									'guestUserId': guestUserId
								};
								$.ajax({
									url: "<?=DEFAULT_URL?>/premiumUpload-photo-ajax.php?action=updatePrintOrder",
									type: "POST",
									data:  records,
									success: function(resData){
										var arrData = resData.split('@@@');
										text = arrData[1];
										resText = arrData[0];
										if(resText != '' && resText == "updated"){
											$('.preloader').css('display','none');
											jQuery("#guestUserId").val(insertedUserId);
											jQuery("#UserId").val(insertedUserId);
											jQuery("#btnLogin").hide();
											jQuery(".photoSelect").attr("style", "");
										} else {
											$('.preloader').css('display','none');
											jQuery('#modal-2').addClass('modal-show');
											jQuery("#alert-message").html(response);
										}
									}
								});
							} else {
								$('.preloader').css('display','none');
								jQuery('#modal-2').addClass('modal-show');
								jQuery("#alert-message").html(response);
							}
						}
					});
				});

			} else {
				$("#login-status").html("Not logged in");
			}
		}, {scope:'email,user_photos'});
	});

	$("#btnLogout").click(function (e) {
		e.preventDefault();
		FB.logout();
		$("#login-status").html("Not logged in");
	});

	$(".photoSelect").click(function (e) {
		e.preventDefault();
		fbphotoSelect();
	});

	logActivity = function (message) {
		$("#results").append('<div>' + message + '</div>');
	};
});


</script>
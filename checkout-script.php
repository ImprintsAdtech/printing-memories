<script>

$(document).on('click','#updateCheckout',function(){



	$('#checkout-form').validate({

		ignore: [],

		errorElement: 'span',

		errorClass: 'help-block',

		focusInvalid: false,

		rules: {

			house_no: {

				required: true

			},

			area: {

				required: true

			},

			pincode: {

				required: true

			},

			checkoutOccupation: {

				required: true

			},

			checkoutStream: {

				required: true,

			},

			checkoutHouseNo: {

				required: true

			},

			checkoutPincode: {

				required: true,

				number: true,

				minlength: 6,

				maxlength: 6

			},

			checkoutStreet: {

				required: true,

			},

			checkoutArea: {

				required: true,

			},

			checkoutCity:{

				required: true,

			},

			checkoutphone:{

				required: true,

			},

			checkoutName:{

				required: true,

			},

			checkoutEmail:{

				required: true,

			},

			userStateId:{

				required: true,

			},

			userCityId:{

				required: true,

			},

			zCityId:{

				required: true,

			},

			freeShippingCityId:{

				required: true,

			},

			shippingStateId:{

				required: true,

			},

			shippingCityId:{

				required: true,

			},





		},

	}); 	



	if(!$('#checkout-form').valid()){

	} else {
		jQuery(".preloader").css("display", "block");
		
			$.ajax({

				type: "POST",

				url: "checkout_ajax.php",

				data: $('form#checkout-form').serialize(), 

				success: function(response_add) {
					jQuery(".preloader").css("display", "none");
					if(response_add != '' && response_add == 1){

						window.location.href="<?=DEFAULT_URL?>/my-orders";	

					} else if(response_add != '' && response_add == "paid 1") {

						window.location.href="<?=DEFAULT_URL?>/payment";		

					}



				}

			});

		//}

	} 

});

/*$(document).on('click','#guestUserData',function(){

	var classname = $(this).attr('class');

	if(classname == "true")

	{

		$(this).removeClass('true');

		$(this).addClass('false');

		$('.guestUserData').css('display','block');

	}

	else

	{

		$(this).removeClass('false');

		$(this).addClass('true');

		$('.guestUserData').css('display','none');

	}

	

});*/



jQuery(document).ready(function(){

	jQuery("#permanentStateId").on("change", function(){

		var stateId = jQuery("#permanentStateId").val();

		jQuery.ajax({

			type: "POST",

 			url: "checkout_ajax.php",

  			data: {"state_id":stateId, "action":"getPermanentCity"}, 

 			success: function(response) {

				if(response != ''){

					jQuery("#permanentCityId").html(response);

 				} else {

					jQuery("#permanentCityId").html("<option value=''>No cities available of this State</option>")

				}

 			}

		});

	});

	jQuery("#permanentCityId").on("change", function(){

		var cityId = jQuery("#permanentCityId").val();

		jQuery.ajax({

			type: "POST",

 			url: "checkout_ajax.php",

  			data: {"cityId":cityId, "action":"getPermanentPincode"}, 

 			success: function(response) {

				if(response != ''){

					jQuery("#pincode").html(response);

 				} else {

					jQuery("#pincode").html("<option value=''>No Pincode available of this city</option>")

				}

 			}

		});

	});

	jQuery("#shippingStateId").on("change", function(){

		var stateId = jQuery("#shippingStateId").val();

		jQuery.ajax({

			type: "POST",

 			url: "checkout_ajax.php",

  			data: {"state_id":stateId, "action":"getShippingCity"}, 

 			success: function(response) {

				if(response != ''){

					jQuery("#shippingCityId").html(response);

 				} else {

					jQuery("#shippingCityId").html("<option>No cities available of this State</option>")

				}

 			}

		});

	});



	jQuery(".copyAddress").on("click", function(){

		jQuery('.preloader').css('display','block');

		var homeNo = jQuery("#userHouseNo").val();

		var street = jQuery("#userStreet").val();

		var area = jQuery("#userArea").val();

		var stateId = jQuery("#permanentStateId").val();

		var cityId = jQuery("#permanentCityId").val();

		var stateIdText = $('#permanentStateId').find(":selected").text();

		var cityIdText = $('#permanentCityId').find(":selected").text();

		var pincode = jQuery("#pincode").val();



		jQuery("#checkoutHouseNo").val(homeNo);

		jQuery("#checkoutStreet").val(street);

		jQuery("#checkoutArea").val(area);

		if(jQuery("#productType").val() == "free"){

			jQuery("#freeShippingCityId").append(new Option(cityIdText, cityId, true, true));

		} else {	

			jQuery("#shippingCityId").append(new Option(cityIdText, cityId, true, true));

			jQuery("#shippingStateId").append(new Option(stateIdText, stateId, true, true));

		}

		jQuery("#checkoutPincode").val(pincode);

		jQuery('.preloader').css('display','none');

	});



	jQuery("#addedAddress").on("change", function(){

		var addedAddress = jQuery("#addedAddress").val();

		var addressText = jQuery("#addedAddress").find(":selected").text();

		var addressArray = addressText.split(","); 

		var houseNo = addressArray[0];

		var street = addressArray[1];

		var area = addressArray[2];

		var city = addressArray[3];

		var state = addressArray[4];

		var pincode = addressArray[5];

		jQuery("#checkoutHouseNo").val(houseNo);

		jQuery("#checkoutStreet").val(street);

		jQuery("#checkoutArea").val(area);

		if(jQuery("#productType").val() == "free"){

			$("#freeShippingCityId option").filter(function() {

    			//may want to use $.trim in here

			    return jQuery(this).text() == city; 

			}).prop('selected', true);

		} else {

			$("#shippingCityId option").filter(function() {

    			//may want to use $.trim in here

			    return jQuery(this).text() == city; 

			}).prop('selected', true);

			$("#shippingStateId option").filter(function() {

    			//may want to use $.trim in here

			    return jQuery(this).text() == state; 

			}).prop('selected', true);

		} 

		jQuery("#checkoutPincode").val(pincode);



	});



	jQuery(".AddNewAddres").on("click", function(){

		jQuery("#checkoutHouseNo").removeAttr("readonly");

		jQuery("#checkoutStreet").removeAttr("readonly");

		jQuery("#checkoutArea").removeAttr("readonly");

		jQuery("#freeShippingCityId").removeAttr("disabled");

		jQuery("#checkoutPincode").removeAttr("readonly");

	});





});

</script>
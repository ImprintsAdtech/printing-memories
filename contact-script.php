<script>


$(document).on('click', '#contact-form-submit', function(e){
	
	
			 
         	$('#contact-form').validate({
         		ignore: [],
         		errorElement: 'div',
         		errorClass: 'help-block',
         		focusInvalid: false,
         		
         		rules: {
         			
         			contactName: {
         				required: true
         			},
         			contactSubject: {
         				required: true
         			},
         			contactEmail: {
         				required: true,
         				email:true
         			},
         			contactMessage: {
         				required: true
         			},
         			contactCity: {
         				required: true
         			},
         			contactNumber: {
						required: true,
						number: true,
						minlength: 10,
						maxlength: 10
         			},
					

         			
         		},
         		messages: {
         
         		
         			contactEmail: {
         				required: "Email is required",
         				email:"Invalid Email"
         
         			},
         			contactName: {
         				required: "Name is required"
         
         			},
					contactSubject: {
         				required: "Subject is required"
         			},
					
					contactMessage: {
         				required: "Message is required"
         			},
         			contactCity: {
         				required: "City is required"
         			},
					
					
         		
					contactNumber: {
         				required: "Phone no. is required",
						number: "Please enter valid phone no.",
         			},
					
         		
         		},
         	
         	}); 	
         	
         	if(!$('#contact-form').valid()){
         			
         	}else{
				$('.preloader').css('display','block');
	
	var contactName = $('#contactName').val();
	var contactEmail = $('#contactEmail').val();
	var contactSubject = $('#contactSubject').val();
	var contactNumber = $('#contactNumber').val();
	var contactMessage = $('#contactMessage').val();

			$('#contact-form-submit').css('pointer-events','none');

				$.ajax({

					type: "POST",
					url: "<?=DEFAULT_URL?>/contact-ajax.php",
					data: {action:'contact_form', contactName:contactName,contactEmail:contactEmail,contactSubject:contactSubject,contactNumber:contactNumber,contactMessage:contactMessage},
					success: function(responseText) {


						if(responseText !='' && responseText == 1){
							$('.preloader').css('display','none');
							
							$('#contactName').val('');
							$('#contactEmail').val('');
							$('#contactSubject').val('');
							$('#contactNumber').val('');
							$('#contactMessage').val('');
							$('#contact-form-submit').css('pointer-events','visible');					
							$('.success-msg-contact').css('display','block');
							setTimeout(function(){
							$('.success-msg-contact').css('display','none');
							},5000);

						}else{

						}
					}

				});

		} 
         });



/*$(document).on('click', '#contact-form-submit', function(e){
	
	var contactName = $('#contactName').val();
	var contactEmail = $('#contactEmail').val();
	var contactSubject = $('#contactSubject').val();
	var contactNumber = $('#contactNumber').val();
	var contactMessage = $('#contactMessage').val();

			$('#contact-form-submit').css('pointer-events','none');

				$.ajax({

					type: "POST",
					url: "<?=DEFAULT_URL?>/contact-ajax.php",
					data: {action:'contact_form', contactName:contactName,contactEmail:contactEmail,contactSubject:contactSubject,contactNumber:contactNumber,contactMessage:contactMessage},
					success: function(responseText) {


						if(responseText !='' && responseText == 1){
							
							$('#contactName').val('');
							$('#contactEmail').val('');
							$('#contactSubject').val('');
							$('#contactNumber').val('');
							$('#contactMessage').val('');
							$('#contact-form-submit').css('pointer-events','visible');					
							$('.success-msg-contact').css('display','block');
							setTimeout(function(){
							$('.success-msg-contact').css('display','none');
							},5000);

						}else{

						}
					}

				});

		});*/
</script>
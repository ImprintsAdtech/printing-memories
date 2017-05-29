<script>

$(document).on('click','#pincode_submit',function(){

	
	var pincode = $(".shiping_box").val()
	$.ajax({
		type: "POST",
		url: "<?=DEFAULT_URL?>/pincode-check-ajax.php",
		data:  {action:'check_pincode',pincode:pincode},
		success: function(responseText) {
			if(responseText !='' && responseText == 'shipping yes'){
				
				$(".shipping_yes").removeClass("displaynone").addClass("displayblock")
				$(".shipping_no").removeClass("displayblock").addClass("displaynone")
				
			} else if(responseText == 'shipping no'){
				
				$(".shipping_yes").removeClass("displayblock").addClass("displaynone")
				$(".shipping_no").removeClass("displaynone").addClass("displayblock")
				
			}
		}
	});

});
</script>
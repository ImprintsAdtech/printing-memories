<script>
$(document).on('click','#choosePlanbtn',function(){
	var printPlan = $(".printPlan:checked").val();
	var productId =  $("#productId").val();
	var productcatId =  $("#productcatId").val();
	var userId = $('#userId').val();
	if(userId == "")
	{
		window.location.href="<?=DEFAULT_URL?>/login";
	}
	else
	{
		if(printPlan == "" )
		{
				$('#blnk_error_msg').css('display','block');
				setTimeout(function(){
					$('#blnk_error_msg').css('display','none');
				}, 2000);
				return false;
		}
		
		else
		{
		
		$.ajax({
	
						type: "POST",
						url: "<?=DEFAULT_URL?>/product-detail-ajax.php",
						data: {action:'productPlan', printPlan:printPlan,productId:productId,productcatId:productcatId},
						success: function(responseText) {
	
	
							if(responseText !='' && responseText != "blank" && responseText != "already"){
								
								window.location.href="<?=DEFAULT_URL?>/select-size?id="+responseText;
								
							}else if(responseText !='' && responseText == "already"){
								alert("already added in cart");
							}
						}
	
					});
		}
	}
	
});


</script>
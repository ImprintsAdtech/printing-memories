<script>
$(document).on('click','.deleteCart',function(){
            var cartId = $(this).attr('data-id');
			var orderId = $(this).attr('data-probuyid');
			var productType = $(this).attr('data-protype');

			$('.modal-delete').attr('data-id',cartId);
			$('.modal-delete').attr('data-probuyid',orderId);
			$('.modal-delete').attr('data-protype',productType);
			
                $('#modal-cart').addClass('modal-show');
                return false;
        });
		$(document).on('click','.modal-delete',function(){

			$('.preloader').css('display','block');
			var cartId = $(this).attr('data-id');
			var orderId = $(this).attr('data-probuyid');
			var productType = $(this).attr('data-protype');
	
				$.ajax({
					url: "<?=DEFAULT_URL?>/cart-ajax.php",
					type: "POST",
					data: {cartId:cartId,action:"deletecart",orderId:orderId,productType:productType},
					success: function(responseText){
								if(responseText != '' && responseText ==1){
									 window.location.href="<?=DEFAULT_URL?>/cart";
								}else{
									
								}
							}
				});

        });
		$(document).on('click','.modal-delete-cancel',function(){
            $(this).closest('.modal-delete-photo').removeClass('modal-show');
        });



</script>
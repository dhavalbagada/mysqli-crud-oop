jQuery(document).ready(function(){
	
	//jQuery('#usercreate')
	//	.on('blur', 'input[required], input.optional, select.required', validator.checkField)
		//.on('change', 'select.required', validator.checkField)
		//.on('keypress', 'input[required][pattern]', validator.keypress);
		
		jQuery('#usercreate').submit(function(e){
			//alert('hii');
			
		e.preventDefault();
		var submit = true;

		// Validate the form using generic validaing
		//if( !validator.checkAll( $(this) ) ){
			//submit = false;
		//}

		if( submit ){
			
			var send_data={ 'email':jQuery('input[name="Useremail"]').val(),
							'Username':jQuery('input[name="Username"]').val(),
							'password':jQuery('input[name="Userpassword"]').val(),
							'country':jQuery('input[name="sel_country"]').val(),
							'phone':jQuery('input[name="phone"]').val,
							'userstatus':jQuery('input[name="userstatus"]').val(),
							'loggedinid':jQuery('input[name="loggedinid"]').val()
							};
						//console.log(send_data);
			
			//ajax call for loagin.
			$.ajax({
				type: "POST",
				url: 'includes/user-manage.php',
				dataType: "json",
				data:{type:'create_user',data:send_data},
				encode : true,
				 beforeSend:function(data){
				   jQuery('.adduser').addClass('m-progress');
				}, 
				success: function(response){
					jQuery('.adduser').removeClass('m-progress');
					if(response.status == 0){
						 $.gritter.add({
							title: '',
							text: response.message,
							class_name: 'color danger'
						  });
					}else if(response.status == 1){
				$("#adminadduserForm")[0].reset();							
						$.gritter.add({
							title: '',
							text: response.message,
							class_name: 'color success'
						  });
					}else{
						 $.gritter.add({
							title: '',
							text: response.message,
							class_name: 'color danger'
						  });
					}
				}
			});  
			e.preventDefault();
		}
		return false;
	});
});
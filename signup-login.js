jQuery(document).ready(function(){
	
         

	//login proccess {012}{start}
	jQuery("#signup").submit(function(e) {
		//alert('hiii');
		
		var send_data={
						'loginusername':jQuery('input[name="loginusername"]').val(),
						'loginEmail':jQuery('input[name="loginEmail"]').val(),				
						'loginPass':jQuery('input[name="loginPass"]').val(),				
						'firstname':jQuery('input[name="firstname"]').val(),				
						'lastname':jQuery('input[name="lastname"]').val(),
                        'gender':jQuery('input[name="gender"]:checked').val(),
                        'phone':jQuery('input[name="phone"]').val(),
                        'address':jQuery('textarea[name="address"]').val(),				
						'city':jQuery('input[name="city"]').val()								
						};
		console.log(send_data);
		//ajax call for loagin.
		$.ajax({
			type: "POST",
			url: 'includes/manage-users.php',
			dataType: "json",
			data:{type:'user_signup',data:send_data},
			encode          : true,
			success: function(response){
				console.log(response);
				if(response.status == 0){
					
				 	new PNotify({
						title: "error",
						text: response.message,
						type: 'error',						
					});		
				}else if(response.status == 1){
					
				 new PNotify({
						title: "success",
						text: response.message,
						type: 'success',				
					});
					//window.setTimeout(function(){ window.location.href = response.redirectURL ; }, 2000);
				}
			}
		});
		e.preventDefault();
	});
	
	
	jQuery(document).on('click', '.trash',function(e){
		alert("");
        var id = jQuery(this).attr('data-id');
        var send_data = {'data_id':id};  
       console.log(id);
            $.confirm({
             title: 'Warning!',
             content: 'Are you sure to delete selected user??',
             buttons: {
                  confirm: function () {
       
                    
                             $.ajax({
                                    type: "POST",
                                    url:'includes/manage-users.php',
                                    dataType: "json",
                                    data:{type:'delete_data', data:send_data},
                                    encode          : true,
                                    success: function(response){
                                        console.log(response);         
                                       
                                     if(response.status == 0){
					
										$.notify({
											message: response.message
										},{
											type: 'danger'
										});
										
									}else if(response.status == 1){
										
										$.notify({
											message: response.message
										},{
											type: 'success'
										});
									
                                     $('#row_id'+id).animate({'line-height':0},1000).hide(1);
                                    $('#row_id'+id).remove();
                                    }  
                                    }
                                   
                            });
                        e.preventDefault();    
                  },
                  cancel: function () {
                         return;
                  }
             }
        });
       
               
	});
	
	
	//edit data popup model
jQuery('.edit_popup').click(function(){
   
          var id = jQuery(this).attr('data-id');
          var send_data = {'id':id};  
          console.log(id);
        $.ajax({
            type:"POST",
            url:'includes/manage-users.php',
            dataType: "json",
            data:{type:'sel_edit_data',data:send_data},
            encode          : true,
            success: function(response){
                 console.log(response);
                
                jQuery('#loginusername').val(response[0].user_name);
                jQuery('#loginEmail').val(response[0].user_email);
                jQuery('#firstname').val(response[0].user_first_name);
                jQuery('#lastname').val(response[0].user_last_name);
                jQuery('#gender').val(response[0].user_gender);
                jQuery('#phone').val(response[0].user_phone);
                jQuery('#address').val(response[0].user_address);
                jQuery('#city').val(response[0].user_city);
                // jQuery('#country').val(response[0].user_country);
                jQuery('#hid_user_id').val(id);
                
                
            }
    });    
});
       
	//save button popup edit data
jQuery('.save_data_popup').click(function(){
   
   var id = jQuery("#hid_user_id").val();
   var send_data = {'id':id,
                    'loginEmail':jQuery('#loginEmail').val(),
                    'loginusername':jQuery('#loginusername').val(),                    
					'firstname':jQuery('#firstname').val(),				
					'lastname':jQuery('#lastname').val(),
                    'gender':jQuery('#gender').val(),
                    'phone':jQuery('#phone').val(),
                    'address':jQuery('#address').val(),				
					'city':jQuery('#city').val(),				
					'country':jQuery('#country').val()};
                    
   console.log(id);
    console.log(send_data);
   
  
   $.ajax({
        type:"POST",
            url:'includes/manage-users.php',
            dataType: "json",
            data:{type:'edit_data_popup',data:send_data},
            encode          : true,
            success: function(response){
                     console.log(response);
                     if(response.status == 0){
        				
    				 	$.notify({
    						message: response.message
    					},{
    						type: 'danger'
    					});
    				
    				}else if(response.status == 1){
    					$('#myModal').modal('hide');
    				 	$.notify({
    						message: response.message
    					},{
    						type: 'success'
    					});
    					// window.setTimeout(function(){ window.location.href = response.redirectURL ; }, 2000);
    				}else if(response.status == 2){
                            $('#error_msg').show();
                            $('#error_msg').text(response.message);
                              
    				}
    			}
			
   });
   
   
});
   
	   
	   
	   
});
          

		
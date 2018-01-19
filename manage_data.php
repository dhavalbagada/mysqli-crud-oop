<?php
require_once("config.php"); 
require_once("header.php");

// $DB = new DB;
$userObj = new user;
$userdata = $userObj->selectuser();
// $countries = $DB->countryList();
// $user_data = $admin->select_user_data();
// $user_edit_data = $admin->edit_user_data(); 
$sel_edit_data = $userObj->sel_edit_data();
// $edit_data_popup1 = $admin->edit_data_popup(); 
// $get_unblock_user = $admin->getunblockUsers();
// $count_unblocked_user=count($get_unblock_user);                     
?>
<style>
.editbox
{
	display:none;
}
#multi_delete_btn{
	display:none;
}
#multi_trash_btn{
	display:none;
}


</style>

    <div class="row">
		<div class="col-sm-12">
			<div style="float:right;">
			 <?php
			 if($count_unblocked_user == 0 ) 
			{
				$a_multi_class="block-multi-users";
				$a_multi_caption="Block User";
				
			}else{
				$a_multi_class="unblock-multi-users";
				$a_multi_caption="Unblock User";
				
			}
			?>	
			
				<a class="btn btn-danger <?php echo $a_multi_class; ?>" id="main_block_button" style="display:none;"><span id="span_id"><?php echo $a_multi_caption; ?></span></a>
				<input type="button" id="multi_trash_btn" class="btn btn-danger" value="Trash">
			</div>	
		</div>
		<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table" id="tabledit">
				<thead>
					<tr>
						<th>
						 <div class="be-checkbox be-checkbox-sm">
						<div class="checkbox">
						  <input id="check_all" type="checkbox" name="check_all">
							<label for="check_all"></label>
							</div>
							</div>
						</th>
						<th>NAME</th>
						<th>USERNAME</th>
						
						<th>FIRST NAME</th>
						<th>LAST NAME</th>
						<th>GENDER</th>
						<th>PHONE</th>
						<th>ADDRESS</th>
						<th>CITY</th>
						<th>COUNTRY</th>
						<th>BLOCK/ UNBLOCK</th>		
						<th>INLINE EDIT</th>						
						<th>EDIT</th>
						
						<th>TRASH</th>
					</tr>
				</thead>
			   
				<tbody>
					<form method="post" name="edit_user_data" id="edit_user_data">
					<?php
						foreach($userdata as $row){
						$id=$row['user_id'];
						
						
					?>
					<?php
						if($row['user_status'] == 3){
							$trash_show="display:none;";
						}else{
							$trash_show="";
						}
					?>		
					<tr id="row_id<?php echo $id;?>" style="<?php echo $trash_show; ?>">

						<td>
						<div class="be-checkbox be-checkbox-sm">
						<div class="checkbox">
						<input id="check<?php echo $row['user_id']; ?>" type="checkbox" name="delete-record[]" value="<?php echo $row['user_id'] ?>"  class="check">
						<label for="check<?php echo $row['user_id']; ?>"></label>
						 </div>
						 </div>
						 </td>
						
						<td class="edit_td">
						<span class="text_<?php echo $id;?>"><?php echo $row['user_name'];?></span>
						<input type="text" name="loginusername" value="<?php echo $row['user_name'];?>" class="form-control editbox" id="unm_input_<?php echo $id; ?>" style="width:200px;">
						</td>
						
						<td class="edit_td">
						<span class="text_<?php echo $id;?>"><?php echo $row['user_email'];?></span>
						<input type="text" name="user_email" value="<?php echo $row['user_email'];?>" class="form-control editbox" id="uemail_input_<?php echo $id; ?>" style="width:200px;">
						</td>
						
						<td class="edit_td">
						<span class="text_<?php echo $id;?>"><?php echo $row['user_first_name'];?></span>
						<input type="text" name="firstname" value="<?php echo $row['user_first_name'];?>" class="form-control editbox" id="fnm_input_<?php echo $id; ?>" style="width:200px;">
						</td>
						
						<td class="edit_td">
						<span class="text_<?php echo $id;?>"><?php echo $row['user_last_name'];?></span>
						<input type="text" name="lastname" value="<?php echo $row['user_last_name'];?>" class="form-control editbox" id="lnm_input_<?php echo $id; ?>" style="width:200px;">
						</td>
						
						<td class="edit_td">
						<span class="text_<?php echo $id;?>">
						
						<?php
						if($row['user_gender']==0)
						{
							echo "Male";	
						}else{
							echo "Female";	
						}
						
						?>
						
						</span>
						<select name="gender" class="form-control editbox" id="gen_input_<?php echo $id; ?>" style="width:100px;">
							<?php
								if($row['user_gender']==0)
								{
							?>
							<option value="<?php echo $row['user_gender'];?>">Male</option>
						<option value="1">Female</option>
						<?php
								}else{
									
						?>
						<option value="0">Male</option>
						<option value="<?php echo $row['user_gender'];?>">Female</option>
						<?php
								}
						?>
						</select>
						
						</td>
						
						
						
						<td class="edit_td">
						<span class="text_<?php echo $id;?>"><?php echo $row['user_phone'];?></span>
						<input type="text" name="phone" value="<?php echo $row['user_phone'];?>" class="form-control editbox" id="phone_input_<?php echo $id; ?>" style="width:200px;">
						</td>
						
						<td class="edit_td">
						<span class="text_<?php echo $id;?>"><?php echo $row['user_address'];?></span>
						<input type="text" name="address" value="<?php echo $row['user_address'];?>" class="form-control editbox" id="add_input_<?php echo $id; ?>" style="width:200px;">
						</td>
						
						<td class="edit_td">
						<span class="text_<?php echo $id;?>"><?php echo $row['user_city'];?></span>
						<input type="text" name="city" value="<?php echo $row['user_city'];?>" class="form-control editbox" id="city_input_<?php echo $id; ?>" style="width:200px;">
						</td>
						
						
						<td class="edit_td">
						<?php 
						
						foreach($countries as $code=>$country){ 
						if($code == $row['user_country']){
						?>
						
						<span class="text_<?php echo $id;?>"><?php echo $country; ?> </span>
						
						<?php 
						} 
						}
						?>
						 <select class="form-control editbox" name="country" id="country_input_<?php echo $id; ?>" tabindex="10" style="width:200px;">
                        <?php 
						
						foreach($countries as $code=>$country){ 
						
						?>
						
							<option value="<?php echo $code; ?>" <?php echo ($code == $row['user_country']) ? 'selected' : ''; ?>><?php echo $country; ?></option>
						
						<?php 
						} 	
						?>
                        </select>
                        
						</td>
						
						<td>
							
							<?php 
								if($row['user_status'] == 0 || $row['user_status'] == 1){
									$a_class="user_block";
									$i_class="fa-unlock";
									
									
									$a_btn="btn-success";
									
								}else{
									$a_class="user_unblock";
									$i_class="fa-lock";
									
									
									$a_btn="btn-danger";
								}
							?>
							<a id="a_btn_<?php echo $row['user_id']; ?>" class="btn <?php echo $a_btn; ?>  <?php echo $a_class; ?>" data-id="<?php echo $row['user_id'];?>"> <i class="fa <?php echo $i_class; ?>" aria-hidden="true" ></i></a> 
							
							
						</td>
						
						<td>
						
						
						
						<input type="button" name="edit_data" id="<?php echo $id; ?>" class="btn_edit_<?php echo $id; ?> text btn btn-primary" data-id="<?php echo $row['user_id'];?>" value="Inline Edit">
						
						<input type="button" name="save_data" id="<?php echo $id; ?>" class="save_data btn_save_<?php echo $id; ?> editbox btn btn-primary" data-id="<?php echo $row['user_id'];?>" value="Save"></td>
						
						<td>
						<input type="button" name="edit" id="<?php echo $id; ?>" class="edit_popup btn btn-info" data-id="<?php echo $row['user_id'];?>" data-toggle="modal" data-target="#myModal" value="Edit">
						</td>
						
												
						<td><input type="button" class="trash btn btn-danger" data-id="<?php echo $row['user_id'];?>" value="Trash"></td>
						
					</tr>
                   				
									
					<?php
						
						}
					?>
					 </form>	
				</tbody>
			</table>
			</div>
		</div>	
	</div>
 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit UserData</h4>
        </div>
		 <form method="post" id="edit_data_popup">
        <div class="modal-body">
		
         
			
				<div class="input-group">
				
				  <span class="input-group-addon" id="basic-addon1">
					<i class="fa fa-user" aria-hidden="true"></i></span>
					
				  <input type="text" class="form-control" id="loginusername" name="loginusername" placeholder="Username" aria-describedby="basic-addon1">
				</div>
				
				
				<div class="input-group">
				
				  <span class="input-group-addon" id="basic-addon1">
					<i class="fa fa-user" aria-hidden="true"></i></span>
					
				  <input type="email" class="form-control" id="loginEmail" name="loginEmail" placeholder="Email Address" aria-describedby="basic-addon1">
				</div>
				
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">
					<i class="fa fa-user" aria-hidden="true"></i></span>
				  <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" aria-describedby="basic-addon1">
				</div>
				
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">
					<i class="fa fa-user" aria-hidden="true"></i></span>
				  <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" aria-describedby="basic-addon1">
				</div>
				
				 <div class="input-group">

				   <span class="input-group-addon" id="basic-addon1">

					<i class="fa fa-user" aria-hidden="true"></i></span>

                                     

				     <input type="radio" class="radio-inline" id="gender" name="gender"  aria-describedby="basic-addon1" value="0" checked="checked">Male

                     <input type="radio" class="radio-inline" id="gender" name="gender"  aria-describedby="basic-addon1" value="1">Female

                                    

				</div>



                 <div class="input-group">

				   <span class="input-group-addon" id="basic-addon1">

					<i class="fa fa-user" aria-hidden="true"></i></span>

				     <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" aria-describedby="basic-addon1">

				</div>
				
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">
					<i class="fa fa-user" aria-hidden="true"></i></span>
				  <textarea placeholder="Address" id="address" class="form-control" name="address"></textarea>
				</div>
				
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1">
					<i class="fa fa-user" aria-hidden="true"></i></span>
				  <input type="text" class="form-control" id="city" name="city" placeholder="City" aria-describedby="basic-addon1">
				</div>
				
				
				
				
				
				
				<input type="hidden" id="hid_user_id" name="user_id" value="">
				<div id="error_msg" style="color:red;"></div>
			
        </div>
        <div class="modal-footer">
			<input type="button" name="user_id1" class="save_data_popup btn btn-success btn-submit" id="user_id" value="Update" >
          <button type="button" id="close_btn" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
		</form>	
      </div>
      
    </div>
  </div>	


  


<?php require_once("footer.php"); ?>

 			
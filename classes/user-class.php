<?php
class user extends DB{


    public function insert_userss($data){
			$dataa = array('user_owner_id'=>1,
							'user_type'=>1,
							'user_email'=>$data['loginEmail'],
							'user_password'=>md5($data['loginPass']),
							'user_name'=>$data['loginusername'],
							'user_first_name'=>$data['firstname'],
							'user_last_name'=>$data['lastname'],
							'user_gender'=>$data['gender'],
							'user_phone'=>$data['phone'],
							'user_address'=>$data['address'],
							'user_city'=>$data['city'],
							'user_country'=>15,
							'user_create_date'=>date("Y-m-d H:i:s"),
							'user_status'=>0);
							
			//------insert----------				
			$add_query = parent::insert( 'users', $dataa );
			
			//------update----------
			// $update_where = array( 'user_id' => 57);
			// $add_query = parent::update( 'users', $dataa, $update_where, 1 );
			
			
			//-------delete---------
			// $where = array( 'user_id' => 57);
			// $add_query = parent::delete( 'users_table', $where, 1 );
			
			
			if($add_query > 0){			
				
				return  array('status'=>1,'message'=>'Success! Signup Successful.,');
				
			}else{
				return  array('status'=>0,'message'=>'Generate Database error');
			}
	}

	public function selectuser(){
		// $query = "SELECT user_meta.*,users.* FROM users LEFT JOIN user_meta ON users.user_id = user_meta.user_id";
		$query = "SELECT * FROM users";
		$add_query = parent::get_results($query);
		
		return $add_query;
		// echo '<pre>';
		// print_r( $add_query );
		// echo '</pre>';
		// exit;
	}
	
	public function delete_data($data){
		$where = array( 'user_id' => $data['data_id'] );
		$delte = parent::delete("users",$where, 1);
		
		$msg = "Delete Successfull";
		return array('status'=>1,'message'=>$msg);
	}
	
	
	public function sel_edit_data($data){
		// print_r($data);die;

		$id = $data['id'];
		$query = "SELECT * FROM users where user_id=$id";
		// $query = "SELECT * FROM `users` WHERE user_id=".$data['id']." ";
		$sels_query = parent::get_results($query);
		if($sels_query > 0){
			return $sels_query;
		}else{
			return false;
		}
		
	}
	
	public function edit_data_popup($data){
		$dataa = array('user_owner_id'=>1,
							'user_type'=>1,
							'user_email'=>$data['loginEmail'],						
							'user_name'=>$data['loginusername'],
							'user_first_name'=>$data['firstname'],
							'user_last_name'=>$data['lastname'],
							'user_gender'=>$data['gender'],
							'user_phone'=>$data['phone'],
							'user_address'=>$data['address'],
							'user_city'=>$data['city'],
							'user_country'=>15,
							'user_create_date'=>date("Y-m-d H:i:s"),
							'user_status'=>0);
							
			$update_where = array( 'user_id' => $data['id']);
			$add_query = parent::update( 'users', $dataa, $update_where, 1 );
			if($add_query > 0){			
				
				return  array('status'=>1,'message'=>'Success! update Successful.,');
				
			}else{
				return  array('status'=>0,'message'=>'Generate Database error');
			}
	}
}
?>
<?php
require_once("../config.php");

if(isset($_POST['type'])){
	$type = $_POST['type'];
	if(isset($_POST['data'])){
		$data = $_POST['data'];
	}
}

$user = new user;

if(isset($type) && !empty($type)){
	switch($type)
	{
		case "user_signup":
			insert_users($user,$data);
			break;
		case "delete_data":
			user_delete($user,$data);	
			break;	
		case "sel_edit_data":
			sel_edit_data1($user,$data);
			break;
		case "edit_data_popup":
			edit_data_popup1($user,$data);
			break;					
		default:

			echo '';
	}
}

function insert_users($user,$data){
	
	$error_message = "";
	
	//email validation
	if(empty($data['loginEmail'])){
		 $error_message .= "Please enter your email<br/>";
	}elseif(!filter_var($data['loginEmail'], FILTER_VALIDATE_EMAIL)){
	    $error_message .= "Invalid email format <br/>"; 
	}
	
	
	if($error_message != ""){ 
		print  json_encode(array('status'=>0,'message'=>$error_message));
	}else{
		$res = $user->insert_userss($data);
		print  json_encode($res); 
	}
}

function user_delete($user,$data){

	$error_message="";
	if($error_message != "")
	{
		print  json_encode(array('status'=>0,'message'=>$error_message));
	}else{				
		$res = $user->delete_data($data);		
		print  json_encode($res); 
	}
}

function sel_edit_data1($user,$data){
	// print_r($data);die;
	$res =	$user->sel_edit_data($data);
	print json_encode($res);
}

function edit_data_popup1($user,$data){
	$error_message="";
	
	if($error_message != ""){ 		
		
		print  json_encode(array('status'=>0,'message'=>$error_message));	
	
	}else{	
		
		$res = $user->edit_data_popup($data);
		print json_encode($res);
	}
}

?>
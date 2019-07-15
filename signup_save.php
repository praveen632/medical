<?php
include('include/includes.php');  
		$ch= new User();
		$username=$_POST['username'];			
		$data['name']=$_POST['name'];
		$data['username']=$_POST['username'];
		$data['email']=$_POST['email'];
		$data['password']=md5($_POST['password']);
		$data['phone']=$_POST['phone'];
       	$user=$ch->signup($username, $data);
		if($user){
			$_SESSION['user_data']=$user[0];
               echo '1';
			}else{
               echo '0';
			}
	?>
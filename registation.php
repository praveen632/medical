<?php
include('include/includes.php');
$reg = new Registation();
$errors = [];
if(isset($_POST['action'])){
	$name=$_POST['name'];
	$uname=$_POST['uname'];
	$email=$_POST['email'];
	$pass=$_POST['password'];
	$con_pass=$_POST['con_pass'];
	$ph=$_POST['ph'];
	if($name=="")
	{
		$errors['el_name'] = 'Name requierd!';
	}	
	
	else
	{
		if(!preg_match("/^[a-zA-Z ]*$/",$name))
		{
			$errors['el_name_error'] = 'Name Must be In Alphbate requierd!';
		}
	}
	if($uname=="")
	{
		$errors['el_uname'] = 'UserName requierd!';
	}
	if($email=="")
	{
		$errors['el_email'] = 'Email requierd!';
	}
	else
	{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$errors['el_email_error'] = 'Please Enter Valid Email ID!';
		}
	}
	if($pass=="")
	{
		$errors['el_pass'] = 'Password requierd!';
	}
	if($con_pass=="")
	{
		$errors['el_con_pass'] = 'Confirm Password requierd!';
	}
	else
	{
		if($pass!=$con_pass)
		{
			$errors['el_match'] = 'Password and Confirm Password requierd!';
		}
	}
	if($ph=="")
	{
		$errors['el_ph'] = 'Phone Number requierd!';	
	}
	else
	{		
		if(!preg_match("/^[0-9]{10}+$/",$ph))
		{
			$errors['el_ph_error'] = 'Phone No Must be digit OR length shoud be 10!';
		}
	}
	if(empty($errors))
	{
		$data['first_name']=$name;
		$data['user_name']=$uname;
		$data['email']=$email;
		$data['user_password']=$pass;
		$data['mobile']=$ph;		
		$reg->insert($data, $condition);
		Utlityi::setMessage('success', $ln_successMsg);
		header('Location:login.php');
		exit;
	}
	//$reg->cheak($name,'nam');
}
else
{
	$name="";
	$uname="";
	$email="";
	$con_pass="";
	$ph="";
}
Utlityi::setMessage('error', $errors);
include(DIR_TEMPLATE_PATH.'registation.php');
?>
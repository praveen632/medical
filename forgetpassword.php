<?php
include('include/includes.php');
$for = new forget();
$errors = [];
if(isset($_POST['action'])){
	$email=$_POST['email'];
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
	if(empty($errors))
	{
		$result = $for->get($email);
		$username = $result['first_name'];
		if(!empty($result))
		{
			  $sendmail = $for->sendmail($email, $username);
				if (!$sendmail=="true") {
				  echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Your email address is not registered in our server.')
			window.location.href='forgetpassword.php';
			</SCRIPT>");
				  //header("location:http://localhost/order-management/login/index.php");
				  
			  } else {
				echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Please check the email for reset the password.')
			window.location.href='forgetpassword.php';
			</SCRIPT>");
				  // Registration Failed
				  
			  }
		}
		else
		{
			$errors['el_email_error'] = 'Please Enter Valid Email ID!';
		}
	}
}
Utlityi::setMessage('error', $errors);
include(DIR_TEMPLATE_PATH.'forgetpassword.php');
?>
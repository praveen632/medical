<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');
$user = new user();
if(isset($_POST['submit']))
{
	$id=$_SESSION['user_data']['id'];
	$password = $_POST['pass'];
	$con_pass = $_POST['con_pass'];
	$email=$_POST['email_con'];
	if($password !='' || $con_pass != '')
	{
			if($password==$con_pass)
			{
				$userdata=$user->cheakemail_profile($id, $email);
				if($userdata==TRUE)
					{
						$data['password']=md5($password); 
						$user_data= $user->update_user_table($id, $data);
						$message = "Your Password is updated";
					}
				else
				{
					$userdata=$user->cheakemail($email);
					if($userdata==TRUE)
					{				
						$message = "email id already exist";
					}
					else
					{
						$data['password']=md5($password);
						$data['email']=$email;
						$user_data= $user->update_user_table($id, $data);
						$_SESSION['user_data']['email']=$email;
						$message = "Password and Email is updated"; 
					}
				}
			}
			else
			{
				$message = "Password and Confirm Password should be same";
			}
	}
	else
	{
		$userdata=$user->cheakemail_profile($id, $email);
		if(!$userdata==TRUE)
		{
			$userdata=$user->cheakemail($email);
			if($userdata==TRUE)
			{
				$message = "Email id already exist";
			}
			else
			{
				$data['email']=$email;
				$user_data= $user->update_user_table($id, $data);
				$_SESSION['user_data']['email']=$email;
				$message = "Your Email is updated";
			}
		}
		else
		{
			$message = 0;
		}
	}
}
else
{
	$message = 0;
}
include(DIR_TEMPLATE_PATH.'user_profile.php');
include(DIR_COMMON_PATH.'footer.php');
?>
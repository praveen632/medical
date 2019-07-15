<?php
include('include/includes.php');
	if(isset($_POST['action']))
	{
		if($_POST['password']==$_POST['con_password'])
		{
			$user = new User();
			$ut = new Utlityi();
			$email=$_GET['key'];
			$email=$ut->secureDecode($email);
			$email_conf=$user->cheakemail($email);
			//print_r($email_conf);
			if($email_conf==TRUE)
			{
				
					$data['password']=md5($_POST['password']);
					$a = $user->update_user_rest_table($email, $data);
					//echo $a;
					if($a==true)
					{
							$result = $user->email($email);			  
							$sendmail = $user->sendmail_profile($email, $result);
							if (!$sendmail=="true") {
								//$type='reset';
								$message = "Your email ID is not Valid";				  
						  } else {							  
								header("location: index.php?msg='Your Password is Updated'");
								exit;								
						  }
						
					}
			}
			else
			{
				$message = "this is not Valid ID";
			}
		}
		else
		{
			$message = "Password and Confirm Password should be same";
		}
	}
	else
	{
		$message = 0;
	}
include(DIR_TEMPLATE_PATH.'resetpassword.php');
?>
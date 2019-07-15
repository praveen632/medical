<?php
include('include/includes.php');
//print_r($_REQUEST);
	if (!empty($_POST['username']) && !empty($_POST['password'])) {
		$user = new User();
        $username = $_POST['username'];
        $pass = $_POST['password'];
        //echo $_POST['remember'];
	    $login = $user->login($pass,$username);
		if($login) 
		{			
		    if(isset($_POST['remember']))
			{
				$hour = time() + 3600;
				setcookie('user', $pass, $hour);
			}
			else{

				if(isset($_COOKIE['user']))
				{
					setcookie('user', '', time()-300);
				}
				
			}	 
			$_SESSION['user_data']=$login[0];
		    echo '1';
		}
	    else 
		{
			echo '0';			
		}
	}
	else
	{
		 $type="";
		 $message = "";
	}
	?>
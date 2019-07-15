<!DOCTYPE html>
<html lang="en"> 
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
 <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0"/> 
 <title>Order Management</title> 
 <link href="<?php echo PUBLIC_PATH; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="<?php echo PUBLIC_PATH; ?>assets/css/main.css" rel="stylesheet" type="text/css"/> 
  <link href="<?php echo PUBLIC_PATH; ?>assets/css/plugins.css" rel="stylesheet" type="text/css"/> 
  <link href="<?php echo PUBLIC_PATH; ?>assets/css/responsive.css" rel="stylesheet" type="text/css"/> 
  <link href="<?php echo PUBLIC_PATH; ?>assets/css/icons.css" rel="stylesheet" type="text/css"/> 
  <link href="<?php echo PUBLIC_PATH; ?>assets/css/login.css" rel="stylesheet" type="text/css"/>
   <link rel="stylesheet" href="<?php echo PUBLIC_PATH; ?>assets/css/fontawesome/font-awesome.min.css"> 
   <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'> 
   <script type="text/javascript" src="<?php echo PUBLIC_PATH; ?>assets/js/libs/jquery-1.10.2.min.js"></script> 
   <script type="text/javascript" src="<?php echo PUBLIC_PATH; ?>bootstrap/js/bootstrap.min.js"></script> 
   <script type="text/javascript" src="<?php echo PUBLIC_PATH; ?>assets/js/libs/lodash.compat.min.js"></script> 
   <script type="text/javascript" src="<?php echo PUBLIC_PATH; ?>plugins/uniform/jquery.uniform.min.js"></script> 
   <script type="text/javascript" src="<?php echo PUBLIC_PATH; ?>plugins/validation/jquery.validate.min.js"></script> 
   <script type="text/javascript" src="<?php echo PUBLIC_PATH; ?>plugins/nprogress/nprogress.js"></script> 
   <script type="text/javascript" src="<?php echo PUBLIC_PATH; ?>assets/js/login.js"></script>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script>$(document).ready(function(){Login.init()});</script> 
   </head> 
   <body class="login"> 
   		<div class="logo"> <img src="<?php echo PUBLIC_PATH; ?>assets/img/logo.png" alt="logo"/> 
        <strong>E-</strong>POS </div> 
        <div class="box"> 
        	<div class="content"> 
            	<form class="form-vertical login-form" action="" method="post"> 
                	<h3 class="form-title">Reset your Password</h3> 
                    <div class="alert fade in alert-danger" style="display: none;">
                    	 <i class="icon-remove close" data-dismiss="alert"></i> Enter any username and password. 
                    </div> 
                    <div class="form-group"> 
                        <div class="input-icon"> <i class="icon-user"></i> 
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" autofocus required /> 
                        </div> 
                    </div> 
                    <div class="form-group"> 
                    	<div class="input-icon"> <i class="icon-lock"></i> 
                        <input type="password" name="con_password" id="con_password" class="form-control" placeholder = "Confirm Password" required /> 
                        </div> 
                     </div>
					<?php
						if(!$message==0)
						{
					 ?>
					 <div class="container" style="background:#F44346; color:#fff; border-radius:25px; width:290px; margin-bottom:2px;">
					 <label class="checkbox pull-left">
						<?php echo $message ; ?>
					 </label>
					 </div>
					<?php } ?>
                     <div class="form-actions"> <label class="checkbox pull-left">
                     <label></label> 
                     <button type="submit" name="action" class="submit btn btn-primary pull-right">Change Your Password </button> 
                     </div> 
                </form>  
                   </body> 

				</html>
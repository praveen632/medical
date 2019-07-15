<?php
include('include/includes.php');

if(isset($_REQUEST['client_id']) && $_REQUEST['client_id']>0 && isset($_SESSION['user_data']) && $_SESSION['user_data']['role_id']==1) {
    $user = new User();
    $clintDetails = $user->getClient($_REQUEST['client_id']);
    if($clintDetails) {
        $_SESSION['user_data']['client_id'] = $_REQUEST['client_id'];
        $_SESSION['user_data']['client_name'] = $clintDetails['client_name'];
		if(isset($_REQUEST['client_permission']) && $_REQUEST['client_permission'] ==1) {
			header('location:permission.php');
		} else {
			header('location:index.php');
		}
        
        exit;
    }
}
?>
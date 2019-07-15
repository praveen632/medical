<?php
include('include/includes.php');
$change = new User();
$dat = $_SESSION['user_data'];
$id= $_SESSION['user_data']['id'];
if(isset($_POST['submit']))
{
	if($_POST['newpassword'] != ''){
	$dat = $_SESSION['user_data'];
	$data['password'] = md5($_POST['newpassword']);
	$data['name'] = $_POST['name'];
	$data['phone'] = $_POST['phone'];
	$data['company_name'] = $_POST['c_name'];
	$data['address'] = $_POST['address'];
	$data['tin_no'] = $_POST['tin_no'];
	$condition = ['id'=> $id];
	$update_users = $change->addUser($data, $condition);
}else{
    $data['name'] = $_POST['name'];
	$data['phone'] = $_POST['phone'];
	$data['company_name'] = $_POST['c_name'];
	$data['address'] = $_POST['address'];
	$data['tin_no'] = $_POST['tin_no'];
	$condition = ['id'=> $id];
	$update_users = $change->addUser($data, $condition);
}

	unset($_SERVER['user_data']);
    session_destroy();
    echo "<script>alert('Record successfully updated');</script>";
    echo "<script>window.location.href='login.php';</script>";	
}
?>
<?php
include('include/includes.php');
$user = new company();
$data['name'] = $_POST['name'];
$data['description'] = $_POST['description'];
$data['created_at'] = date('y/m/d');
$data['updated_at'] = date('y/m/d');
$comp_name = $user->getcheak($data['name']);
if(!$comp_name)
{
	$result = $user->addcompany($data);
	 if ($result) {
	 	    echo '1';		                            
		} else {
			echo '0';		    	    
		} 
}
else
{
	echo '2';
}
?>
<?php
include('include/includes.php');
$user = new productuniform();
$data['name'] = $_POST['name'];
//$data['created_at'] = date('y/m/d');
//$data['updated_at'] = date('y/m/d');
$result = $user->addproductuniform($data);
 if ($result) {
 	    echo '1';		                            
	} else {
		echo '0';		    	    
	} 

?>
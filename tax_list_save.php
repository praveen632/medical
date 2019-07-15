<?php
include('include/includes.php');

$taxlist = new Taxlist();

$data['name'] = $_POST['name'];
$data['tax_rate'] = $_POST['tax_rate'];
$data['created_at'] = date('y/m/d');
$data['updated_at'] = date('y/m/d');

$result = $taxlist->save($data);
 if ($result) {
 	    echo '1';		                            
	} else {
		echo '0';		    	    
	} 


?>
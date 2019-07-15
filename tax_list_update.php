<?php
include('include/includes.php');
           $taxlist = new Taxlist();
           $id=$_POST['id'];     		       
	       $data['name']=$_POST['name'];
		   $data['tax_rate']=$_POST['tax_rate']; 
		   $data['created_at'] = date('y/m/d');
			$data['updated_at'] = date('y/m/d');		   
		   $result=$taxlist->taxlistupdate($id, $data);
		   //print_r($result);
		   
		   if ($result) {
		   	echo '1';
		     	//$data = 'yes';	                        
		    } else {
		    	echo '0';
		    	//$data = 'no';	      
		    }
?>
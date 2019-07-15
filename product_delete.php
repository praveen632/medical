<?php
include('include/includes.php');
           $user = new Product();             		       
	       $id=$_POST['id'];	       		 		   
		   $result=$user->product_delete($id);
		   if ($result) {
		     	echo '1';		                            
		    } else {
		    	echo '0';		    	    
		    }   
		
	
//include(DIR_TEMPLATE_PATH.'company_edit.php');
?>
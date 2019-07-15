<?php
include('include/includes.php');
           $user = new Sales();             		       
	       $id=$_POST['id'];		 		   
		   $result=$user->sales_delete($id);
		   if ($result) {
		     	echo '1';		                            
		    } else {
		    	echo '0';		    	    
		    }   
		
	
//include(DIR_TEMPLATE_PATH.'company_edit.php');
?>
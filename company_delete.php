<?php
include('include/includes.php');
           $user = new company();             		       
	       $id=$_POST['id'];		 		   
		   $result=$user->company_delete($id);
		   if ($result) {
		     	echo '1';		                            
		    } else {
		    	echo '0';		    	    
		    }   
		
	
//include(DIR_TEMPLATE_PATH.'company_edit.php');
?>
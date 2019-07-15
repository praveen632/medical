<?php
include('include/includes.php');

  
   $taxlist = new Taxlist();             		       
	$id=$_POST['id'];		 		   
	 $result=$taxlist->delete($id);
		 if ($result) {
		     	echo '1';		                            
		    } else {
		    	echo '0';		    	    
		    }   
		
?>
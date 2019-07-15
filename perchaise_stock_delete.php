<?php
include('include/includes.php');

  
   $stock = new Perchaisestock(); 

	$id=$_POST['id'];	
		 		   
	 $result=$stock->delete($id);
		 if ($result) {
		     	echo '1';		                            
		    } else {
		    	echo '0';		    	    
		    }   
		
?>
<?php
include('include/includes.php');

  
   $productname = new Perchaisestock();             		       
	 $page_id=$_GET['page_id'];		 		   
	 $result=$productname->get($page_id);
		 if ($result) {
		     	echo '1';		                            
		    } else {
		    	echo '0';		    	    
		    }   
		
?>
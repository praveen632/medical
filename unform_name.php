<?php
include('include/includes.php');
           $user = new Product();             		       
	       $id=$_POST['id'];	      		   
		   $result=$user->get_uniform($id);
		  if($result){
    	       echo $datas = json_encode($result);
		    }else{
		    	echo $datas = '0';
		    } 
		
?>
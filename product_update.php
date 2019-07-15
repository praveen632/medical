<?php
include('include/includes.php');
           $user = new Product();
          $id=$_POST['id'];     		       
	      $data['name']=$_POST['name'];
		  $data['description']=$_POST['description'];
		  $data['company_id']=$_POST['ids'];
		  $data['product_id']=$_POST['idss'];
		  $data['product_uniform']=$_POST['id1'];
		  $data['tax_id']=implode(",",$_POST['idT']);
		  $data['created_at'] = date('y/m/d');
		  $data['updated_at'] = date('y/m/d');		  		 
		  $result=$user->product_update($id, $data);		   
		   if ($result) {
		   	    echo '1';		     	                        
		    } else {
		    	echo '0';		    	
		    }
	   
?>
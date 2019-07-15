<?php
include('include/includes.php');
           $user = new productuniform();
           $id=$_POST['id'];     		       
	       $data['name']=$_POST['name'];
	       $data['created_at'] = date('y/m/d');
			$data['updated_at'] = date('y/m/d');
		  // $data['description']=$_POST['description']; 		   
		   $result=$user->productuniform_update($id, $data);
		   
		   if ($result) {
		   	echo '1';
		     	//$data = 'yes';	                        
		    } else {
		    	echo '0';
		    	//$data = 'no';	      
		    }
	   //echo $datas = json_encode($data);
		
	
//include(DIR_TEMPLATE_PATH.'company_edit.php');
?>
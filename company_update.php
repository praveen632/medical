<?php
include('include/includes.php');
           $user = new company();
           $id=$_POST['id'];     		       
	       $data['name']=$_POST['name'];
		   $data['description']=$_POST['description'];
		   $data['created_at'] = date('y/m/d');
		   $data['updated_at'] = date('y/m/d');
		   $cheak_id = $user->getcheak_id($id, $data['name']);
		   //print_r($cheak_id[0]['name']);
		   if($cheak_id[0]['name']==$_POST['name'])
		   {
			   $result=$user->company_update($id, $data);		   
			   if ($result) {
			   		echo '1';	                        
			    } else {
			    	echo '0';      
			    }
			}
			else
			{
				$comp_name = $user->getcheak($data['name']);
				if(!$comp_name)
				{
						$result=$user->company_update($id, $data);		   
					   	if ($result) {
					   		echo '1';	                        
					    } else {
					    	echo '0';      
					    }
				}
				else
				{
						echo '2';
				}
			}
?>
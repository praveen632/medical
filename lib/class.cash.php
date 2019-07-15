<?php
	class User{
	
            public $db ;
            
                public  function __construct() {
                $this->db = new Mysql();
				$this->table = CMS_USERS;
            }        
            public function getClients($select = '*'){
                $results = $this->db->order_by('client_id', 'ASC')->get(CMS_CLIENTS, $select);
                if($results)
                    return $results;

                return false;
            }
            public function getClient($id){
                $results = $this->db->where(['role_id' => $id])->get(CMS_USERS);
                if($results)
                    return $results['0'];
                return false;
            }
			public function authorize($userName,$password) {
                //$this->db->where(array('user_name'=>$userName,'user_password'=>$password,'status'=>1));
				$this->db->where(array('username'=>$userName,'password'=>$password));
                $userData = $this->db->get(CMS_USERS);
				print_r($userData);
                if($userData) {
                    return $userData;
                } else {
                    return false;
                }
            }
			public function login($pass, $username){
				$this->db->where(array('username'=>$username,'password'=>md5($pass)));
                $userData = $this->db->get(CMS_USERS);
            if ($userData)   
            {
				//$_SESSION['user_data'] = $userData[0];
				
                //$_SESSION['login'] = true;  
                //$_SESSION['uid'] = $userData[0]['id'];  
                //$_SESSION['username'] = $userData[0]['username'];  
                //$_SESSION['email'] = $userData[0]['email'];  
                return $userData;  
            }  
            else  
            {  
                return FALSE;  
            }   
		} 
		public function cheakusername($username){
			$this->db->where(array('username'=>$username));
			$userData = $this->db->get(CMS_USERS);
			//print_r($userData);
            if ($userData)   
            {  
				return TRUE;
            }  
            else  
            {   
                return FALSE;  
            }   
		}	
		public function cheakemail($email){
			$this->db->where(array('email'=>$email));
			$userData = $this->db->get(CMS_USERS);
            if ($userData)   
            {  
				return TRUE;
            }  
            else  
            {   
                return FALSE;  
            }   
		}			
		public function email($email){
				$this->db->where(array('email'=>$email));
				$userData = $this->db->get(CMS_USERS);
            if ($userData)   
            {  
				return $userData[0]['name'];
            }  
            else  
            {  
               return FALSE;
            }   
		}
		public function sendmail($email, $name){
			include('mail/class.phpmailer.php');
			$mail = new PHPMailer(true);            
			$mail->IsSMTP();   
			try {
			$mail->SMTPAuth   = true;
			$mail->SMTPSecure  = 'ssl';
			$link = "Dear ".$name." <a href='http://172.104.60.103/order_management/resetpassword.php?key=".$email."'>click here</a> reset password"; 

			$mail->Host       = "smtp.gmail.com";           
			$mail->Port       = "465";   
			$mail->SMTPDebug = 1;                
			$mail->Username   = "unnatitechsolution@gmail.com";  
			$mail->Password   = "unnatitech@322411!1";
			$mail->SetFrom("unnatitechsolution@gmail.com", "Reset Password");
			$mail->AddAddress($email, "dshahi");
			$mail->Subject = "Reset Password" ;
			$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; 
			$mail->MsgHTML($link);
			$mail->Send();
			return true;
		  } catch (phpmailerException $e) {
			//echo $e->errorMessage();
		  return false;
		  } catch (Exception $e) {
		  return false;        
		  }        
		}
	
	}
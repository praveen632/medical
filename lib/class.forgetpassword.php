<?php
class forget{
	public $db ;
    private $table;
	public  function __construct() {
        $this->db = new Mysql();
        $this->table = CMS_USERS;
    }

    public function get($select = '*'){
        $results = $this->db->where(['email' => $select])->get($this->table);
		//print_r($results);
        if($results)
            return $results;
        return false;
    }
	public function sendmail($email, $name){
		include('mail/class.phpmailer.php');
		$mail = new PHPMailer(true);  
		$mail->IsSMTP();    
		try {
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure  = 'ssl';
		$link = "Dear ".$name." <a href='http://localhost/cms/resetpassword.php?key=".$email."'>click here</a> reset password"; 
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
<?php
	class Utlityi{
	
    public $db = '';
    
    public  function __constructor() {
        $this->db = new Mysql();
    }
    
   /**
    * Function to encode the password
    * @param type $text (raw password)
    * @return type encoded string
    */
   public static function secureEncode($text) {

       return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(PASS_KEY), rtrim($text), MCRYPT_MODE_CBC, md5(md5(PASS_KEY))));
   }

   /**
    * Function to decode the encoded password
    * @param type $text (encoded password)
    * @return type decoded password
    */
   public static function secureDecode($text) {

       return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(PASS_KEY), base64_decode($text), MCRYPT_MODE_CBC, md5(md5(PASS_KEY))), "\0");
   }

  public static function setMessage($type='error', $message){
    if(empty($message))
      return false;

    $_SESSION['message'] = [
      'alert_type' => $type,
      'alert_message' => $message,
    ];
  }

  public static function getMessage(){
    $html = '';
    if(isset($_SESSION['message'])){
      if($_SESSION['message']['alert_type'] == 'success'){
        $class = 'green';
      }else{
        $class = 'red';
      }

      $alertMessage = $_SESSION['message']['alert_message'];
      if(is_array($alertMessage)){
        $message = '<p>ERROR: Following error(s) occured.</p>';
        foreach ($alertMessage as $value) {
          $message .= '<p>'.$value.'</p>';
        }
        $message .= '';
      }else{
        $message = '<p>'.$alertMessage.'</p>';
      }
      

      $html = '<div id="card-alert" class="card '.$class.' lighten-5">
                <div class="card-content '.$class.'-text">
                  '.$message.'
                </div>
                <button type="button" class="close '.$class.'-text" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>';
    }
    return $html;
  }

	public static function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = ''){

    //folder path setup
    $target_path = $target_folder;
    $thumb_path = $thumb_folder;
    
    //file name setup
    $filename_err = explode(".",$_FILES[$field_name]['name']);
    $filename_err_count = count($filename_err);
    $file_ext = $filename_err[$filename_err_count-1];
    if($file_name != ''){
        $fileName = $file_name.'.'.$file_ext;
    }else{
        $fileName = $_FILES[$field_name]['name'];
    }
    
    //upload image path
    $upload_image = $target_path.basename($fileName);
    
    //upload image
    if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))
    {
        //thumbnail creation
        if($thumb == TRUE)
        {
            $thumbnail = $thumb_path.$fileName;
            list($width,$height) = getimagesize($upload_image);
            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch($file_ext){
                case 'jpg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;

                case 'png':
                    $source = imagecreatefrompng($upload_image);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($upload_image);
                    break;
                default:
                    $source = imagecreatefromjpeg($upload_image);
            }

            imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
            switch($file_ext){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail,100);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail,100);
                    break;

                case 'gif':
                    imagegif($thumb_create,$thumbnail,100);
                    break;
                default:
                    imagejpeg($thumb_create,$thumbnail,100);
            }

        }

        return $fileName;
    }
    else
    {
        return false;
    }
}
	
}
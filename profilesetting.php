<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');


$user = new User();
$id= $_SESSION['user_data']['id'];
$result = $user->getUser($id);


include(DIR_COMMON_PATH.'nav.php');
include(DIR_TEMPLATE_PATH.'profilesetting.php');
include(DIR_COMMON_PATH.'footer.php');
?>
<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');
include(DIR_COMMON_PATH.'nav.php');
$user = new productuniform();
$id = $_GET['id'];
$result = $user->getedit($id);
include(DIR_TEMPLATE_PATH.'productuniform_edit.php');
include(DIR_COMMON_PATH.'footer.php');
?>
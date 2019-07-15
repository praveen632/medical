<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');
include(DIR_COMMON_PATH.'nav.php');
$user = new productuniform();
$result = $user->getProductuniform();
include(DIR_TEMPLATE_PATH.'productuniform_list.php');
include(DIR_COMMON_PATH.'footer.php');

?>
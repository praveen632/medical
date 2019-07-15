<?php
include('include/includes.php');
include(DIR_COMMON_PATH.'header.php');
include(DIR_COMMON_PATH.'nav.php');
$user = new User();
$user->update_expiremedicine();
include(DIR_TEMPLATE_PATH.'index.php');
include(DIR_COMMON_PATH.'footer.php');
?>
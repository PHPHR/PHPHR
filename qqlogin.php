<?php
error_reporting(0);
header('Location: index.php?m=qqconnect&c=qqlogin&code='.$_GET['code']."&state=".$_GET['state']);

?>
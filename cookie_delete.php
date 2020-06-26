<?php

setcookie($_GET['name'], "", time()-3600);
header('Location:'.$_GET['redirect']);

?>
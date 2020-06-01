<?php
unset($_COOKIE['user_id']);
unset($_COOKIE['user_login']);
setcookie('user_id','',-1,'/');
setcookie('user_login','',-1,'/');
$home_url = 'http://'.$_SERVER['HTTP_HOST'];
header('Location:'.$home_url);
?>
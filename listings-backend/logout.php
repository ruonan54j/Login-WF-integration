<?php
echo "==============";
session_start();
session_destroy();
echo "==============";
echo $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.html';
die;
header('Location: ' . $home_url);

?>
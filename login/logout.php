<?php
include __DIR__ . '/../bootstrap.php';
session_start();
session_unset();
session_destroy();
header('Location: /site/login/login.php');
exit;


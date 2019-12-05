<?php
include __DIR__.'/../boostrap.php';
session_start();
session_unset();
session_destroy();
header('Location: /pdo/login.php');
exit;


<?php
include __DIR__ . '/../bootstrap.php';
session_start();
$_SESSION['UrlRedirect'] = $_SERVER['PHP_SELF'];
if($_SESSION['authenticated'] == true){
    $result = '登入時間： '.$_SESSION['login_time'];
    foreach($_SESSION['fruits'] as $fruit){
        $result .= "<br>$fruit";
    }
}else{
    header('Location: /site/login/login.php');
    exit;
}

?>

<html>
<head>
    <title>Untitled Document</title>
    <meta http-equiv="Content-Type" content="text/html; charset=big5" />
</head>

<body>
<div align="center">
    <p><font color="#0000FF"><strong>權限控管頁面！</strong></font></p>
    <p>Session 變數如下：</p>
    <p><?php echo $result?></p>
    <p><a href="/site/login/logout.php">[ 登 出 ]</a></p>
</div>
</body>
</html>

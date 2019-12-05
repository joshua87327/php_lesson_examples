<?php
include __DIR__.'/../boostrap.php';
if(isset($_POST[Submit])){
    // 如果帳號和密碼正確的話，寫入Session變數，並視情況重導到相關的頁面
    if($_POST[account] == "admin" && $_POST[password] == "pass"){
        // 啟動 Session
        session_start();

        // 寫入 Session 變數值
        $_SESSION['authenticated'] = true;
        $_SESSION['fruits'] = array("orange", "banana", "apple");
        $_SESSION['login_time'] = date('Y-m-d h:i:s');
        // 檢查在 $_SESSION 全域變數中，是否有之前設定好的網址重導 Session 變數
        if(isset($_SESSION[UrlRedirect])){
            $redir = $_SESSION[UrlRedirect];
        }else{
            $redir = '/pdo/login_success.php';
        }

        // 重導到相關頁面
        header("Location: $redir");
        exit;
    }else{
        header('Location: access_denied.htm');
        exit;
    }
}
?>

<html>
<head>
    <title>LOGIN</title>
    <meta http-equiv="Content-Type" content="text/html; charset=big5" />
</head>

<body>
<form name="form1" id="form1" method="post" action="">
    <p align="center">帳號：
        <input name="account" type="text" id="account" />
    </p>
    <p align="center">密碼：
        <input name="password" type="password" id="password" />
    </p>
    <p align="center">
        <input type="submit" name="Submit" value="登 入" />
    </p>
</form>
</body>
</html>

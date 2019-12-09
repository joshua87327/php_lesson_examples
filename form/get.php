<?php
include __DIR__ . '/../bootstrap.php';
?>
<html>
<head>
    <title>GET Practice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<form name="form1" id="form1" method="GET" action="./get.php">
    <h2 align="center">Search</h2>
    <p align="center">
        ID：<input name="sel_id" type="text" id="sel_id" />
        <input type="submit" value="Enter" />
    </p>
</form>

<p align="center">
<?php
if(isset($_GET['sel_id']) && $_GET['sel_id']!=''){
    $sql = 'SELECT * FROM team where id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($_GET['sel_id']));
    foreach ($stmt->fetchAll() as $rows){
        echo $rows['id'].' '.$rows['name'].' '.$rows['flag']. '<br>';
    }
}
?>
</p>
</body>
</html>


<?php
include __DIR__.'/../boostrap.php';
?>
<html>
<head>
    <title>PDO Practice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<form name="form1" id="form1" method="GET" action="./index.php">
    <p align="center">Search ID：
        <input name="sel_id" type="text" id="sel_id" />
    </p>
    <p align="center">
        <input type="submit" value="Enter" />
    </p>
</form>

<form name="form2" id="form2" method="GET" action="./index.php">
    <p align="center">Delete ID：
        <input name="del_id" type="text" id="del_id" />
    </p>
    <p align="center">
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
if(isset($_GET['del_id']) && $_GET['del_id']!=''){
    try{
    $sql = "DELETE FROM team WHERE id = ?";
    $sth = $conn->prepare($sql);
    $sth->execute(array($_GET['del_id']));
    echo 'Deleted ID:'.$_GET['del_id'].' successfully';
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}
?>
</p>
</body>
</html>


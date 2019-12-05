<?php
include __DIR__ . '/../bootstrap.php';
?>
<html>
<head>
    <title>PDO Practice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<form name="form1" id="form1" method="GET" action="./index.php">
    <h2 align="center">Search</h2>
    <p align="center">
        ID：<input name="sel_id" type="text" id="sel_id" />
        <input type="submit" value="Enter" />
    </p>
</form>

<form name="form2" id="form2" method="GET" action="./index.php">
    <h2 align="center">Delete</h2>
    <p align="center">
        ID：<input name="del_id" type="text" id="del_id" />
        <input type="submit" value="Enter" />
    </p>
</form>

<form name="form3" id="form3" method="GET" action="./index.php">
    <h2 align="center">Insert</h2>
    <p align="center">
        NAME：<input name="ins_name" type="text" id="ins_name" />
    </p>
    <p align="center">
        FLAG：<input name="ins_flag" type="text" id="ins_flag" />
    </p>
    <p align="center">
        <input type="submit" value="Enter" />
    </p>
</form>

<form name="form4" id="form4" method="GET" action="./index.php">
    <h2 align="center">Update</h2>
    <p align="center">
        ID：<input name="mod_id" type="text" id="mod_id" />
    </p>
    <p align="center">
        NAME：<input name="mod_name" type="text" id="mod_name" />
    </p>
    <p align="center">
        FLAG：<input name="mod_flag" type="text" id="mod_flag" />
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
if(isset($_GET['ins_name']) && $_GET['ins_name']!='' && isset($_GET['ins_flag']) && $_GET['ins_flag']!=''){
    try{
    $input = array($_GET['ins_name'],$_GET['ins_flag']);
    $sql = 'INSERT INTO team(name,flag) VALUES (?,?)';
    $stmt = $conn->prepare($sql);
    $stmt->execute($input);
    echo 'Insert '.$_GET['ins_name'].' successfully';
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}
if(isset($_GET['mod_id']) && $_GET['mod_id']!=''){
    if($_GET['mod_name']!='' && $_GET['mod_flag']==''){
        try{
            $input = array($_GET['mod_name'],$_GET['mod_id']);
            $sql = "UPDATE team SET name = ? WHERE id = ?";
            $sth = $conn->prepare($sql);
            $sth->execute($input);
            echo 'Update ID:'.$_GET['mod_id'].' successfully, name = '.$_GET['mod_name'];
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }elseif ($_GET['mod_name']=='' && $_GET['mod_flag']!=''){
        try{
            $input = array($_GET['mod_flag'],$_GET['mod_id']);
            $sql = "UPDATE team SET flag = ? WHERE id = ?";
            $sth = $conn->prepare($sql);
            $sth->execute($input);
            echo 'Update ID:'.$_GET['mod_id'].' successfully, flag = '.$_GET['mod_flag'];
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }elseif ($_GET['mod_name']!='' && $_GET['mod_flag']!=''){
        try{
            $input = array($_GET['mod_name'],$_GET['mod_flag'],$_GET['mod_id']);
            $sql = "UPDATE team SET name= ?, flag = ? WHERE id = ?";
            $sth = $conn->prepare($sql);
            $sth->execute($input);
            echo 'Update ID:'.$_GET['mod_id'].' successfully, name = '.$_GET['mod_name'].' flag = '.$_GET['mod_flag'];
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }else{
        echo '<p align="center" >Please Enter name or flag</p>';
    }
}
?>
</p>
</body>
</html>


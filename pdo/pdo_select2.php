<?php
include __DIR__ . '/../boostrap.php';
$sql = 'SELECT * FROM team where id = :id';
$stmt = $conn->prepare($sql);
$stmt->execute(array(':id'=> 1));
print_r($stmt->fetchAll());
echo '<br>';
$sql = 'SELECT * FROM team where id = ?';
$stmt = $conn->prepare($sql);
$id = 2;
$stmt->execute(array($id));
print_r($stmt->fetchAll());

<?php
include __DIR__ . '/../bootstrap.php';
$sql = 'SELECT * FROM team';
$arrays = $conn->query($sql)->fetchAll();
print_r($arrays);
echo '<br><br>';
foreach ($arrays as $rows){
    echo $rows['id'].' '.$rows['name'].' '.$rows['flag']. '<br>';
}

echo '<br>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>FLAG</th>
        </tr>
    </thead>
    <tbody>';
foreach ($arrays as $rows){
    echo '<tr><td>'.$rows['id'].'</td><td>'.$rows['name'].'</td><td>'.$rows['flag']. '</td></tr>';
}
echo '
    </tbody>
</table>';
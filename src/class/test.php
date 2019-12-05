<?php

use App\DB;

require_once 'DB.php';


$data = DB::run("SELECT name,score FROM ctfd")->fetchAll();
$tmp = array();
foreach ($data as $row){
    $tmp[] = $row;
}
print_r($data);

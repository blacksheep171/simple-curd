<?php

if(isset($_GET["index_id"])) {
    $index_id = $_GET["index_id"];
}

// stop if it's non-numeric
if (!preg_match('/^\d+$/', $index_id)) {
  die('not found.');
}

$file = 'users.json';
$data = file_get_contents($file);
$list = json_decode($data);
$key = array_search($index_id, array_column($list, 'id'));
unset($list[$key]);
$list = array_values($list);
if(file_put_contents($file,json_encode($list))){
    header('location: index.php');
};
<?php

if(isset($_GET["id"])) {
    $id = $_GET["id"];
}

// stop if it's non-numeric
if (!preg_match('/^\d+$/', $id)) {
  die('not found.');
}

$file = 'users.json';
$data = file_get_contents($file);
$list = json_decode($data);
// now, we will search the ID
for ($i = 0; $i < count($list); $i++) {

  if ($list[$i]->id === $id) {
    unset($list[$i]);
    break;
  }
}

// make the numeric array consecutive again
$list = array_values($list);

// var_dump($list[$id]);
// write the resulting JSON to disk
$fp = fopen($file, 'w');
fwrite($fp, json_encode($list));
fclose($fp);
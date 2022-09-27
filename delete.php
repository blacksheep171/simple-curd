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
$key = array_search($id, array_column($list, 'id'));
var_dump($key);
unset($list[$key]);
$list = array_values($list);
if(file_put_contents($file,json_encode($list))){
    echo "<span class='text-success'>Delete successfully</span>";
} else {
    echo "<span class='text-danger'>Can not delete</span>";
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Simple CURD</title>
</head>
<body>
<div class="container">
    <h4 >Delete User</h4><br />
     <a href="index.php" class="btn btn-dark">Back</a>
    </br>
</div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
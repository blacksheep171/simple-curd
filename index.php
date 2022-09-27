<?php
if(file_exists('users.json'))
{
$json = file_get_contents('users.json');

$users = json_decode($json);

    $message = "<h3 class='text-success'>JSON file data</h3>";
}else{
	 $message = "<h3 class='text-danger'>JSON file Not found</h3>";
}
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
    <div class="row">
        <div class="title"><h1>Simple CURD</h1></div>
    </div>
    <div>
        <div class="row">
            <div class="col-12">
                <a href="create.php" class="btn btn-success" >Add</a>
            </div>
            
        </div>
    </div>
    <br/>

    <div class ="row show_data">
            <div class="col-12">
                <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th class = "id">ID</th>
                                <th class ="name">name</th>
                                <th class = "username">username</th>
                                <th class = "email">email</th>
                                <th class = "phone">phone</th>
                                <th class = "website">website</th>
                                <th class = "Action">Action</th>
                            </tr>
                        </thead>
                        <tbody id="load_data">
                            <?php foreach($users as $user) : ?>
                            <tr>   
                                <td><?=  $user->id ?></td>
                                <td><?=  $user->name ?></td>
                                <td><?=  $user->username ?></td>
                                <td><?=  $user->email ?></td>
                                <td><?=  $user->phone ?></td>
                                <td><?=  $user->website ?></td>
                                <td><a class = "btn btn-primary" href="update.php?id=<?=  $user->id ?>">Edit</a>&nbsp;<a class = "btn btn-danger" href="delete.php?id=<?=  $user->id ?>">Delete</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

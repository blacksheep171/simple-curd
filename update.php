<?php
if(isset($_GET["id"])) {
    $id = $_GET["id"];
}
print_r($id);
$json = file_get_contents('users.json');

$users = json_decode($json);
// convert std class to array

// echo "<pre>";
// var_dump($users);
// echo "</pre>";
// foreach ($users as $key => $value) {
//     echo  $value[$key]. "<br/>";
// }
// var_dump($users[$id]);
// foreach ($users as $key => $user) {
//     if ($user['id']->id == $id ) {
//        var_dump($user[$key]['name']);
//     //    die();
//     }
// }
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
<div class="container" style="width:500px;">
     <h4 >Edit User</h4><br />
     <a href="index.php" class="btn btn-dark">Back</a>
</br>
     <form action="" method="POST">
            <?php if(isset($error))
            {
            echo $error;  
            }
            ?>
            <div id="name-group" class="form-group">
            <label for="name">Name</label>
            <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                value="<?= $users[$key]->name ?>"
                placeholder="Name"
            />
            </div></br>
            <div id="username-group" class="form-group">
            <label for="username">User Name</label>
            <input
                type="text"
                class="form-control"
                id="username"
                name="username"
                placeholder="User Name"
            />
            </div></br>

            <div id="email-group" class="form-group">
            <label for="email">Email</label>
            <input
                type="text"
                class="form-control"
                id="email"
                name="email"
                placeholder="email@example.com"
            />
            </div></br>

            <div id="phone-group" class="form-group">
            <label for="phone">Phone</label>
            <input
                type="text"
                class="form-control"
                id="phone"
                name="phone"
                placeholder="Please enter your phone number"
            />
            </div></br>

            <div id="website-group" class="form-group">
            <label for="website">Website</label>
            <input
                type="text"
                class="form-control"
                id="website"
                name="website"
                placeholder="Please enter your website"
            />
            </div></br>
        <div>
        <button type="submit" class="btn btn-success">Submit</button>
        <?php if(isset($message))
        {
            echo $message;
        }
        ?>
      </form>
        </br>
      
</div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
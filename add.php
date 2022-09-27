<?php

$message =  "";
$error = "";
if(isset($_POST["submit"])){
    if(empty($_POST["name"])) {
        $error = "<label class='text-danger'>Enter Name</label>";
    } else if(empty($_POST["username"])) {
        $error = "<label class='text-danger'>Enter username</label>";
    } else if(empty($_POST["email"])) {
        $error = "<label class='text-danger'>Enter email</label>";
    } else if(empty($_POST["phone"])) {
        $error = "<label class='text-danger'>Enter phone</label>";
    } else if(empty($_POST["website"])) {
        $error = "<label class='text-danger'>Enter website</label>";
    }
} else if(file_exists("users.json")) {
    
    $file = file_get_contents("users.json");
    $data = json_decode($file, true);

    // Get last id
    $last_item    = end($data);
    $last_item_id = $last_item['id'];
    $new_record= array(
        'id' => ++$last_item_id,
        'name' => $_POST["name"],
        'username' => $_POST["username"],
        'email' => $_POST["email"],
        'phone' => $_POST["phone"],
        'website' => $_POST["website"],
    );
    array_push($data,$new_record);
     
    $save_data = $data;
   
   file_put_contents('users.json',json_encode($data), LOCK_EX);

    if(!file_put_contents('users.json',json_encode($save_data,JSON_PRETTY_PRINT),LOCK_EX))
    {
    echo "<h3 class='text-success'>Can not create</h3>";
    } else {
    echo "<h3 class='text-danger'>Create Successfully</h3>";
    }
} else {
    $error = "JSON files does not exists";
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
<div class="container" style="width:500px;">
     <h4 >Create New User</h4><br />
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
                value=""
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
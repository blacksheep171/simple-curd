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
    <h1 class="page-header text-center">Create Users</h1>
    <div class="col-1"></div>
    <div class="col-8"><a href="index.php">Back</a>
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
        <input type="submit" name="save" value="Save" class="btn btn-primary">
        <?php if(isset($message))
        {
            echo $message;
        }
        ?>
      </form>
        </br>
</div>
<?php
 // Get last id
 
     if(isset($_POST['save'])){
        //open the json file
        $data = file_get_contents('users.json');
        $data = json_decode($data);
        $last_item    = end($data);
        $last_item_id = $last_item->id;
        //data in out POST
        $input = array(
            'id' => ++$last_item_id,
            'name' => $_POST['name'],
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'website' => $_POST['website']
        );
 
        //append the input to our array
        $data[] = $input;
        //encode back to json
        $data = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents('users.json', $data);
 
        header('location: index.php');
    }
?>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
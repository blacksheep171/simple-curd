<?php 

    include "upload.php";

     if(isset($_POST['save'])){
        //open the json file
        $data = file_get_contents('users.json');
        $data = json_decode($data);
        $last_item    = end($data);
        $last_item_id = $last_item->id;
        //data in out POST
        if(empty($error)){
            $image = null;
            $imageFileType = null;
        }
        $message = [];
        $input = array(
            'id' => ++$last_item_id,
            'name' => $_POST['name'],
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'website' => $_POST['website'],
            'extension' => $imageFileType,
            'image' => $image
        );
        if(empty($input['name'])) {
            $error_messages = "<label class='text-danger'>Name cannot be empty</label>";
        } else if(empty($input["username"])) {
            $error_messages = "<label class='text-danger'>Username cannot be empty</label>";
        } else if(empty($input["email"])) {
            $error_messages = "<label class='text-danger'>Email cannot be empty</label>";
        } else if(empty($input["phone"])) {
            $error_messages = "<label class='text-danger'>Phone cannot be empty</label>";
        } else if(empty($input["website"])) {
            $error_messages = "<label class='text-danger'>Website cannot be empty</label>";
        } else if (strlen($input['name']) < 1 || strlen($input['name']) > 255 ) {
            $error_messages = "<label class='text-danger'>Name must be between 1 and 255 characters</label>";
        } else if (strlen($input['username']) < 1 || strlen($input['username']) > 255 ) {
            $error_messages = "<label class='text-danger'>Username must be between 1 and 255 characters</label>";
        } else if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            $error_messages = "<label class='text-danger'>Email is invalid</label>";
        } else if (strlen($input['email']) < 1 || strlen($input['email']) > 255 ) {
            $error_messages = "<label class='text-danger'>Email must be between 1 and 255 characters</label>";  
        } else if (strlen($input['phone']) < 1 || strlen($input['phone']) > 12 ) {
            $error_messages = "<label class='text-danger'>Phone must be between 1 and 12 characters</label>";
        } else if (!is_numeric($input['phone'])) {
            $error_messages = "<label class='text-danger'>Phone must be numeric</label>";
        } else if (strlen($input['website']) < 1 || strlen($input['website']) > 255) {
            $error_messages = "<label class='text-danger'>Phone must be between 1 and 12 characters</label>";
        } else if (strlen($input['website']) < 1 || strlen($input['website']) > 255) {
            $error_messages = "<label class='text-danger'>Website must be between 1 and 12 characters</label>";
        }

        if(!empty($error_messages)){
            array_push($message,$error_messages);
        } 
        // if(!empty($error)) {
        //     array_push($message,$error);
        // }
        if(empty($message)) {
            //append the input to our array
            $data[] = $input;
            //encode back to json
            $data = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents('users.json', $data);
            header('location: index.php');
        }
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
    <h1 class="page-header text-center">Create Users</h1>
    <div class="col-1"></div>
    <div class="col-12"><a href="index.php">Back</a>
        <div class="row">
            <div class="col-sm-12">
                <form action="" method="POST" enctype="multipart/form-data">
                    <?php if(!empty($message))
                        {
                            echo $message[count($message)-1];
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
                            required
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
                            required
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
                            required
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
                            required
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
                            required
                        />
                        </div></br>

                        <div id="upload-group" class="form-group">
                            <label for="upload">upload</label>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </div></br>
                        <?php if(isset($error))
                            {
                                echo $error;
                            }
                        ?>
                    <div>
                    <input type="submit" name="save" value="Save" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
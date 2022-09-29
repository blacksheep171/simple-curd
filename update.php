<?php
    include "upload.php";
    //get id from URL
    if(isset($_GET["index_id"])) {
        $index_id = $_GET["index_id"];
    }
 
    //get json data
    $data = file_get_contents('users.json');
    $data_array = json_decode($data);
    $key = array_search($index_id, array_column($data_array, 'id'));
    
    //assign the data to selected index
    $row = $data_array[$key];
    $message = [];
    $errors = null;
    $img_name = isset($row->image) ? $row->image : null;
    //data in out POST
    
    if(empty($error)) {
        $image = null;
    } 
    if(isset($_POST['save'])) {
        if($image === null) {
            $image = $row->image;
        }
        $extension = $imageFileType;
        if($extension === "") {
            $extension = $row->extension;
        }

        $input = array(
            'id' => $row->id,
            'name' => $_POST['name'],
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'website' => $_POST['website'],
            'extension' => $row->extension,
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
        //     if(!empty($error)) {
        //     array_push($message,$error);
        // }
         //update the selected index
        $data_array[$key] = $input;

        if(empty($message)) {
            //encode back to json
            $data = json_encode($data_array, JSON_PRETTY_PRINT);
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
    <h1 class="page-header text-center">Edit Users</h1>
    <div class="col-1"></div>
    <div class="col-12"><a href="index.php">Back</a>
        <div class="row">
            <div class="col-sm-12">
                <form action="" method="POST" enctype='multipart/form-data'>
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
                            value="<?php echo $row->name; ?>"
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
                            value="<?php echo $row->username; ?>"
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
                            value="<?php echo $row->email; ?>"
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
                            value="<?php echo $row->phone; ?>"
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
                            value="<?php echo $row->website; ?>"
                            placeholder="Please enter your website"
                            required
                        />
                    </div></br>

                    <div id="upload-group" class="form-group">
                            <label for="upload">upload</label>
                            <input type="file" name="fileToUpload" value="<?php echo $img_name ?>"id="fileToUpload">
                    </div></br>
                <div>
                    <input type="submit" name="save" value="Save" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
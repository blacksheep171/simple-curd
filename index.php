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
        <div class="title"><h1 class="page-header text-center">Simple CURD</h1></div>
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
                <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th class = "id">ID</th>
                                <th class ="name">Name</th>
                                <th class = "username">Username</th>
                                <th class = "email">Email</th>
                                <th class = "phone">Phone</th>
                                <th class = "website">Website</th>
                                <th class = "website">Image</th>
                                <th class = "Action">Action</th>
                            </tr>
                        </thead>
                        <tbody id="load_data">
                        <?php
                        //fetch data from json
                        $data = file_get_contents('users.json');
                        //decode into php array
                        $data = json_decode($data);
 
                       
                        foreach($data as $row){
                               $img_url = isset($row->image) ? $row->image : null;
                               if(isset($img_url)){
                                $path = "./uploads/".$img_url;
                                $img = "<img src='$path' style = 'width:140px; height: 100px'/>";
                               } else {
                                    $img = null;
                               };
                            echo "
                                <tr>
                                    <td>".$row->id."</td>
                                    <td>".$row->name."</td>
                                    <td>".$row->username."</td>
                                    <td>".$row->email."</td>
                                    <td>".$row->phone."</td>
                                    <td>".$row->website."</td>
                                    <td>".$img."</td>
                                    <td>
                                        <a href='update.php?index_id=".$row->id."' class='btn btn-primary btn-sm'>Edit</a>
                                        <a href='delete.php?index_id=".$row->id."' class='btn btn-danger btn-sm'>Delete</a>
                                    </td>
                                </tr>
                            ";
                        }
                    ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

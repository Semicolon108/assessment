<?php
    include_once "./vendor/autoload.php";

    use App\Controller\Controller;

    $ctrl = new Controller;
    $assesments = $ctrl->
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <header class="w-100 bg-light border shadow-3" style="height:90px">
    </header>
    <section class="row my-3">
        <div class="col-2 border" style="height:90vh"></div>
        <div class="col-10">
            <div class="container col-11 mx-auto border bg-light" style="height:60px;">
                <span role="button" class="rounded-circle btn float-end border mt-2 d-flex align-items-center justify-content-center" style="width:45px;height:45px;"><img src="https://img.icons8.com/ios-filled/45/000000/add--v1.png"/></span>
            </div>
            <div class="container col-9 mx-auto my-5 h-75 border bg-light">
                <h4 class="text-center">Assessments</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Session</th>
                        <th scope="col">Term</th>
                        <th scope="col">class</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>
<?php
    include_once "./vendor/autoload.php";

    use App\Controller\Controller;

    $ctrl = new Controller;
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
            <div class="container col-11 mx-auto border bg-light" style="height:54px;">
                <span role="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="rounded-circle btn float-end border mt-3 d-flex align-items-center justify-content-center" style="width:24px;height:24px;"><img src="https://img.icons8.com/ios-filled/45/000000/add--v1.png"/></span>
                <!-- Button trigger modal -->

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create Assessment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select class="form-select" id="class">
                            <option selected>Class</option>
                            <?php
                                $classes = explode(",",$_SESSION['teacher']['class_to_teach']);
                                foreach($classes as $class):
                            ?>
                                    <option value="<?= $class?>"><?= $class?></option>
                            <?php
                                endforeach;
                            ?>
                        </select>
                        <select class="form-select mt-4" id="subject">
                            <option selected>Subject</option>
                            <?php
                                $subjects = explode(",",$_SESSION['teacher']['subjects']);
                                foreach($subjects as $subject):
                            ?>
                                    <option value="<?= $subject?>"><?= $subject?></option>
                            <?php
                                endforeach;
                            ?>
                        </select>
                        <input type="text" class="form-control mt-4" id="session" placeholder="session">
                        <input type="text" class="form-control mt-4" id="term" placeholder="term">
                        <input type="hidden" id="schoolId" value="<?= $_SESSION['teacher']['school_id']?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="create">Create</button>
                    </div>
                    </div>
                </div>
                </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $("#create").click(() => {
            const values = [$("#class").val(),$("#subject").val(),$("#session").val(),$("#term").val(),$("#schoolId").val()];
            const keys = ["class","subject","session","term","school_id"];
            const data = new FormData();
            for(let key in keys){
                data.append(keys[key],values[key]);
            }
            data.append("createAssessment",true);
            $.ajax({
                url : "requestHandler.php",
                method: "POST",
                data : data,
                cache: false,
                processData: false,
                contentType: false,
                success: (res) => {
                    console.log(res);
                }
            })
        })
    </script>
</body>
</html>
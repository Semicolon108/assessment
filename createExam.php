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
    <script>
        const setQuestion = (id) => {
            $("#staticBackdrop2").modal("show");
            console.log(id.split("_").pop());
        }
    </script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
</head>
<body>
    <header class="w-100 bg-light border shadow-3" style="height:90px">
    </header>
    <section class="row my-3">
        <div class="col-2 border" style="height:90vh"></div>
        <div class="col-10">
            <div class="container row col-11 mx-auto bg-light py-3" style="height:auto;">
                <div class="col-6">
                    <label for="exam">Exam Duration</label>
                    <input type="email" class="form-control w-100" id="duration">
                    <input type="hidden" class="form-control w-100" id="assessment_id" value='<?=$_GET['assessment_id'];?>''>
                </div>
                <div class="col-3 mx-auto">
                    <button type="button" class="btn btn-primary mt-4" id="createExam">Create</button>
                </div>
                <!-- Button trigger modal -->

                <!-- Modal -->
                <!--div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create Assessment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!--div class="modal-body">
                        <select class="form-select" id="class">
                            <option selected>Class</option>
                            <!__?php
                                $classes = explode(",",$_SESSION['teacher']['class_to_teach']);
                                foreach($classes as $class):
                            ?>
                                    <option value="<!--?=$class?>"><!--?= $class?></option>
                            <!--?php
                                endforeach;
                            ?>
                        </select>
                        <select class="form-select mt-4" id="subject">
                            <option selected>Subject</option>
                            <!--?php
                                $subjects = explode(",",$_SESSION['teacher']['subjects']);
                                foreach($subjects as $subject):
                            ?>
                                    <option value="<!--?= $subject?>"><!--?= $subject?></option>
                            <!--?php
                                endforeach;
                            ?>
                        </select>
                        <input type="text" class="form-control mt-4" id="session" placeholder="session">
                        <input type="text" class="form-control mt-4" id="term" placeholder="term">
                        <input type="hidden" id="schoolId" value="<!--?= $_SESSION['teacher']['school_id']?>" />

                        <input type="hidden" id="facultyId" value='<!--?=$_SESSION['teacher']['faculty_id']?>'' />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="create">Create</button>
                    </div>
                    </div>
                </div>
                </div-->
            </div>
            <div class="container col-9 mx-auto my-5 h-75 border bg-light">
                <h4 class="text-center">Assessments</h4>
                <!--table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Session</th>
                        <th scope="col">Class</th>
                        <th scope="col">Term</th>
                        <th scope="col">subject</th>
                        </tr>
                    </thead>
                    <tbody class="reload">
                    <!--?php
                        $schoolData = [
                            "school_id" => $_SESSION['teacher']['school_id'],
                            "faculty_id" => $_SESSION['teacher']['faculty_id']
                        ];
                        $assessments = $ctrl->fetchSchoolAssessment($schoolData);
                        $index = 1;
                        foreach($assessments as $assessment):
                    ?>
                            <tr>
                                <th scope="row"><!--?=$index?></th>
                                <td><!--?=$assessment['assessment_session']?></td>
                                <td hidden><!--?= $assessment['assessment_id']?></td>
                                <td><!--?=$assessment['class']?></td>
                                <td><!--?=$assessment['term']?></td>
                                <td><!--?=$assessment['subject']?></td>
                                <td role="button" class="btn" id="<!--?= 'id_'.$assessment['assessment_id']?>" onclick="setQuestion(this.id)">Create Exam</td>
                                <!-- Button trigger modal -->

                                <!-- Modal -->
                                <!--div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Set question</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <label for="floatingTextarea">Question</label>
                                                <textarea class="form-control" name="editor" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                            </div>
                                            <div class="container-fluid border mt-3" style="height:60px" id="optionPane">
                                                <button class="float-end btn btn-success mt-2 btn-sm" id="addOption">Add Option</button>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Understood</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                    <!--?php
                            $index++;
                        endforeach;
                    ?>
                    </tbody>
                </table>
            </div-->
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
       $("#createExam").click(() => {
           let data = new FormData()
           data.append("duration",$("#duration").val())
           data.append("assessment_id",$("#assessment_id").val())
           data.append("createExam",true);

           $.ajax({
               url: "requestHandler.php",
               method: "POST",
               data: data,
               cache: false,
               contentType: false,
               processData: false,
               success: (res) => {
                   console.log(res)
                }
           })
       })
    </script>
</body>
</html>
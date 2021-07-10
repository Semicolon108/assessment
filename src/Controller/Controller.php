<?php
    namespace App\Controller;

    use App\Controller\Database;
    use Ramsey\Uuid\Uuid;

    class Controller extends Database{

        public function createAssessment($data){

            $sqlValidate = "SELECT * FROM assessments WHERE assessment_session = ? AND class = ? AND term = ? AND faculty_id = ? AND assessment_subject = ?";
            $prepValidate = $this->connectDB()->prepare($sqlValidate);
            $execValidate = $prepValidate->execute([$data['session'],$data['class'],$data['term'],$data['faculty_id'],$data['subject']]);
            $res = $prepValidate->fetchAll();
            if($prepValidate->rowCount() > 0){
                $response = [
                    "status" => "error",
                    "message" => "Assessment already created"
                ];
                echo json_encode($response);
            }else{
                $assessment_id = Uuid::uuid6()->toString();

                $sql = "INSERT INTO assessments(assessment_id,assessment_session,assessment_subject,class,term,faculty_id) VALUE (?,?,?,?,?,?)";
                $prepStmt = $this->connectDB()->prepare($sql);
                $exec = $prepStmt->execute([$assessment_id,$data['session'],$data['subject'],$data['class'],$data['term'],$data['faculty_id']]);
                if($exec){
                    $response = [
                        "status" => "success",
                        "message" => "Assessment created"
                    ];
                    echo json_encode($response);
                }
            }
        }

        public function createExam($examData){
            $exam_id = Uuid::uuid6()->toString();
            $sql = "INSERT INTO exam(exam_id,assessment_id,duration,exam_date,exam_time) VALUE (?,?,?,?,?)";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$exam_id,$examData['assessment_id'],$examData['duration'],$examData['date'],$examData['time']]);
            if($exec){
                echo "exam created";
            }
        }

        public function createExamQuestions($questionDetails){
            $question_id = Uuid::uuid6()->toString();
            $sql = "INSERT INTO exam_questions(exam_id,question,options,answer,question_id) VALUE (?,?,?,?,?)";
            $options = implode(",",$questionDetails['options']);
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$questionDetails['exam_id'],$questionDetails['question'],$options,$questionDetails['answer'],$question_id]);
            if($exec){
                echo "question created";
            }
        }

        public function fetchQuestion($exam_id){
            $sql = "SELECT e.duration,eq.question,eq.answer,eq.options,a.subject,a.class,eq.question  FROM exam e
                    join assessments a on a.assessment_id = e.assessment_id
                    join exam_questions eq on eq.exam_id = e.exam_id WHERE e.exam_id = ?"; 
            $query = $this->connectDB()->prepare($sql);
            $exec = $query->execute([$exam_id]);
            $res = $query->fetchAll();
            return $res;
        }

        public function fetchSchoolAssessment($queryData){
            $sql = "SELECT * FROM assessments WHERE faculty_id = ? ORDER BY id DESC";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$queryData['faculty_id']]);
            $res = $prepStmt->fetchAll();
            return $res;
        }

        public function reFetchAssessment($schoolData){
            $assessments = $this->fetchSchoolAssessment($schoolData);
            
            $index = 1;
            foreach($assessments as $assessment){
                echo "<tr>";
                echo "<th scope='row'>".$index."</th>";
                echo "<td>".$assessment['assessment_session']."</td>";
                echo "<td>".$assessment['class']."</td>";
                echo "<td>".$assessment['term']."</td>";
                echo "<td>".$assessment['assessment_subject']."</td>";
                if(!$this->hasExam($assessment['assessment_id'])){
                    echo "<td>
                            <button class='btn btn-sm btn-success create' id='id_'".$assessment['assessment_id']."'>Create Exam</button>
                        </td>";
                }else{
                    echo "<td>
                            <button class='btn btn-sm btn-success create' id='id_'".$assessment['assessment_id']."'>View Exam</button>
                        </td>";
                }
                echo "</tr>";
                $index++;
            }
           
        }

        public function hasExam($assessment_id){
            $sql = "SELECT * FROM exam WHERE assessment_id = ?";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$assessment_id]);
            $res = $prepStmt->fetchAll();
            if($prepStmt->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function fetchExam($queryData){
            $sql = "SELECT * FROM exam e join assessments a on
                    e.assessment_id = a.assessment_id
                    join teacher t on t.faculty_id = a.faculty_id
                    join school s on s.school_id = t.school_id
                    WHERE e.assessment_id = ?";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$queryData]);
            $res = $prepStmt->fetch();
            if($prepStmt->rowCount() > 0){
                echo "<h4 class=''>School Name: ".$res['school_name']."</div>";
                echo "<h4 class=''> Exam date: ".$res['exam_date']."</div>";
                echo "<h4 class=''> Exam time: ".$res['exam_time']."</div>";
                echo "<h4 class=''> Exam duration: ".$res['duration']."</div>";
            }else{
                echo "No exam for this assessment yet!";
            }
            //print_r($res);
        }

        public function submitQuestion($questionAndAnswer){
            $data = $questionAndAnswer;
            $status = ((md5($data['choice']) == $data['actual_value'])? "correct" : "not correct");
            $sql = "INSERT INTO exam_answers (student_id,question_id,exam_id,answer,status) VALUE (?,?,?,?,?)";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$data['student_id'],$data['question_id'],$data['exam_id'],$data['choice'],$status]);
            if($exec && $status == "correct"){
                echo "correct! answer submitted"; 
            }else if($exec && $status != "correct"){
                echo "incorrect! answer submitted"; 
            }else{
                echo "something wengt wrong";
            }
        }

        public function fetchStudentAnswers($schoolData){
            $sql = "SELECT * FROM student s
                    join assessment a on eq.exam_id = e.exam_id
                    join exam_answers ea on ea.question_id = eq.question_id
                    WHERE e.assessment_id = ?";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$schoolData['assessment_id']]);
            $res = $prepStmt->fetchAll();
            print_r($res);
        }
        public function createSchool($details){
            $sql = "INSERT INTO school (school_name,school_id) VALUE (?,?)";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$details["school"], Uuid::uuid6()->toString()]);
            if($exec){
                echo "school created";
            }
        }

        public function fetchAllStudentResult($resultData){
            $sql = "SELECT * FROM student s join ";
        }
    }
?>
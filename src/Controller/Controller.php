<?php
    namespace App\Controller;

    use App\Controller\Database;
    use Ramsey\Uuid\Uuid;

    class Controller extends Database{

        public function createAssessment($data){
            $assessment_id = Uuid::uuid6()->toString();

            $sql = "INSERT INTO assessments(assessment_id,school_id,assessment_session,subject,class,term) VALUE (?,?,?,?,?,?)";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$assessment_id,$data['school_id'],$data['session'],$data['subject'],$data['class'],$data['term']]);
            if($exec){
                echo "Assessment created";
            }
        }

        public function createExam($examData){
            $exam_id = Uuid::uuid6()->toString();
            $sql = "INSERT INTO exam(exam_id,assessment_id,duration) VALUE (?,?,?)";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$exam_id,$examData['assessment_id'],$examData['duration']]);
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

        public function fetchSchoolAssessment($school_id){
            $sql = "SELECT * FROM assessments WHERE school_id = ?";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$school_id]);
            $res = $prepStmt->fetchAll();
            return $res;
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

        public function 
    }
?>
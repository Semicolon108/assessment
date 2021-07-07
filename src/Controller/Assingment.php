<?php
    namespace App\Controllers;

    use App\Controllers\Database;
    use Ramsey\Uuid\Uuid;
    use PDO;

    class Assingment extends Database{
        private $title;
        private $assignmentId;
        private $subject;
        private $deadline;
        private $class;
        private $teacherId;
        private $status;
        private $schoolId;


        public function createAssignment($data){
            $this->assignmentId = Uuid::uuid6()->toString();
            $this->schoolId = $data['school_id'];
            $this->title = $data['title'];
            $this->subject = $data['subject'];
            $this->deadline = date_create_from_format("Y-m-d", $data['deadline'])->format("d / m / Y");
            $this->class = $data['class'];
            $this->teacherId = $data['teachers_id'];
            $this->status = $data['status'];
            $sql = "INSERT INTO assingment (title,class,subject,status,school_id,teacher_id,assignment_id,deadline)
                    VALUE (?,?,?,?,?,?,?,?)";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$this->title,$this->class,$this->subject,$this->status,$this->schoolId,
                    $this->teacherId,$this->assignmentId,$this->deadline]);

            if($exec){
                echo "success";
            }
        }

        public function fetchAllAssingment($teacherId){
            $sql = "SELECT * FROM assingment WHERE teacher_id = ? ORDER BY created_at DESC";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$teacherId]);
            $res = $prepStmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        public function fetchSingleAssingment($id){
            $sql = "SELECT * FROM assingment WHERE assignment_id = ?";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$id]);
            $res = $prepStmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        }

        public function addQuestion($data,$assignmentId){
            $index = 0;
            $questions = $data['question'];
            $answerTypes = $data['type'];
            $questionId = Uuid::uuid6()->toString();
            $published = false;
            foreach ($questions as $question) {
                $questionId = Uuid::uuid6()->toString();
                $sql = "INSERT INTO assignment_questions (question,assignment_id,answer_type,question_id) VALUE (?,?,?,?)";
                $prepStmt = $this->connectDB()->prepare($sql);
                $exec = $prepStmt->execute([$question,$assignmentId,$answerTypes[$index],$questionId]);
                if($exec){
                    $published = true;
                }
                $index++;
            }
            if($published){
                $sql = "UPDATE assignment SET status = ? WHERE assignment_id = ?";
                $prepStmt = $this->connectDB()->prepare($sql);
                $exec = $prepStmt->execute(["published", $assignmentId]);
                if($exec){
                    echo "Assignment published successfully";
                }
            }
        }
        /*** 
        public function fetch($assignmentId){
            $sql = "SELECT a.assignment_id,a.title,aq.question,aq.answer_type FROM assignment AS a, assignment_questions as aq WHERE a.assignment_id = ? AND aq.assignment_id= ?";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$assignmentId,$assignmentId]);
            $res = $prepStmt->fetchAll(PDO::FETCH_ASSOC);
            print_r($res);
        }
        */

        /**
         * fetch all assignment
         */
        public function fetchnew($assignmentId){
            $sql = "SELECT * FROM assignment 
            inner join assignment_questions on assignment.assignment_id = assignment_questions.assignment_id WHERE assignment.assignment_id = ?";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$assignmentId]);
            $res = $prepStmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        /**
         * submit single or multiple questions
         */
        public function submitAssignmentQuestion($answers,$studentId){
            $submitted = false;
            foreach ($answers as $key => $value) {
                //confirm if multiple question
                if(is_array($value)){
                    if($key['answer_type'] == "text" && is_string($key['answer'])){
                        $sql =  "INSERT INTO assignment_answers (assignment_id,student_id,answer,question_id) VALUE (?,?,?,?)";
                        $prepStmt = $this->connectDB()->prepare($sql);
                        $exec = $prepStmt->execute([$key['assignment_id'],$studentId,$key['answer'],$key['question_id']]);
                        if($exec){
                            $submitted = true;
                        }
                    }
    
                    if($key['answer_type'] == "file upload" && file_exists($key['answer'])){
                        $name = $key['answer']['name'];
                        $size = $key['answer']['size'];
                        $tmp_name = $key['answer']['tmp_name'];
                        $type = $key['answer']['type'];
                        $formats = ['pdf','docx','mp3','mid','mpeg'];
                        $db_path = "";
                        if(in_array($type, $formats)){
                            $dir = $_SERVER['DOCUMENT_ROOT'].'/attendance/uploads/'.$file_name;
                            $db_path .= '/attendance/uploads/'.$file_name;
                            move_uploaded_file($tmp_name,$dir);
                            $sql =  "INSERT INTO assignment_answers (assignment_id,student_id,answer,question_id) VALUE (?,?,?,?)";
                            $prepStmt = $this->connectDB()->prepare($sql);
                            $exec = $prepStmt->execute([$key['assignment_id'],$studentId,$db_path,$key['question_id']]);
                            if($exec){
                                $submitted = true;
                            }
                        }
                    }
                }else{
                    if($key['answer_type'] == "text" && is_string($key['answer'])){
                        $sql =  "INSERT INTO assignment_answers (assignment_id,student_id,answer,question_id) VALUE (?,?,?,?)";
                        $prepStmt = $this->connectDB()->prepare($sql);
                        $exec = $prepStmt->execute([$key['assignment_id'],$studentId,$key['answer'],$key['question_id']]);
                        if($exec){
                            $submitted = true;
                        }
                    }
    
                    if($key['answer_type'] == "file upload" && file_exists($key['answer'])){
                        $name = $key['answer']['name'];
                        $size = $key['answer']['size'];
                        $tmp_name = $key['answer']['tmp_name'];
                        $type = $key['answer']['type'];
                        $formats = ['pdf','docx','mp3','mid','mpeg'];
                        $db_path = "";
                        if(in_array($type, $formats)){
                            $dir = $_SERVER['DOCUMENT_ROOT'].'/attendance/uploads/'.$file_name;
                            $db_path .= '/attendance/uploads/'.$file_name;
                            move_uploaded_file($tmp_name,$dir);
                            $sql =  "INSERT INTO assignment_answers (assignment_id,student_id,answer,question_id) VALUE (?,?,?,?)";
                            $prepStmt = $this->connectDB()->prepare($sql);
                            $exec = $prepStmt->execute([$key['assignment_id'],$studentId,$db_path,$key['question_id']]);
                            if($exec){
                                $submitted = true;
                            }
                        }
                    }
                }
            }
            if($submitted){
                echo "Assignmengt submitted successfully";
            }
        }
    }
?>
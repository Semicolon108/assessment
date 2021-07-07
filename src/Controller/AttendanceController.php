<?php
    namespace App\Controllers;

    use App\Controllers\Database;
    use App\Controllers\Student;
    use PDO;

    class AttendanceController extends Database{
        private $studentId;
        private $week;
        private $day;
        private $attendance;

        public function updateAttendanceRecord($data){
            $this->studentId = $data['student_id'];
            $this->day = $data['day'];
            $this->week = $data['week'];
            $this->attendance = $this->fetchAttendanceRecord($data['class'],$data['student_id']);
            foreach($this->attendance as &$day){
                if(sizeof($day) != $this->week){
                    $day[$this->week - 1] = 1;
                    break;
                }
            }
            $sql = "UPDATE students SET attendance = ? WHERE student_id = ?";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([json_encode($this->attendance),$this->studentId]);
            if($exec){
                echo "update successful";
            }
        }

        public function createAttendance($data){
            $sqlVerify = "SELECT * FROM attendance WHERE student_id = ?";
            $prepStmtVerifier = $this->connectDB()->prepare($sqlVerify);
            $execute = $prepStmtVerifier->execute([$data['student_id']]);
            if($prepStmtVerifier->rowCount() > 0){
                $sql = "UPDATE attendance SET attendance = ? WHERE student_id = ?";
                $prepStmt = $this->connectDB()->prepare($sql);
                $exec = $prepStmt->execute([$data['attendance'],$data['student_id']]);
                if($exec){
                    echo "student attendance record updated";
                }
            }else{
                $sql = "INSERT INTO attendance (school_id,student_id,attendance,date) VALUE (?,?,?,?)";
                $prepStmt = $this->connectDB()->prepare($sql);
                $exec = $prepStmt->execute([63,$data["student_id"],$data['attendance'],date("m / d / Y")]);
                if($exec){
                    echo "attendance marked";
                }
            }
        }
        public function fetchAttendanceRecord($class){
            $queryString = "SELECT * FROM students WHERE class = ?";
            $prepStmtClass = $this->connectDB()->prepare($queryString);
            $executeQuery = $prepStmtClass->execute([$class]);
            $res = $prepStmtClass->fetchAll();
            $attendance = [];
            foreach($res as $student){
                $sql = "SELECT attendance FROM attendance WHERE student_id = ?";
                $prepStmt = $this->connectDB()->prepare($sql);
                $execute = $prepStmt->execute([$student['student_id']]);
                $res = $prepStmt->fetch(PDO::FETCH_ASSOC);
                $attendance[] = $res;
               // print_r($attendance);
            }
            return $attendance;
        }

        public function selectAttendanceDate(){
            $sql = "SELECT date FROM attendance";
            $query = $this->connectDB()->query($sql);
            $res = $query->fetch();
            return $res;
        }
        
    }
?>
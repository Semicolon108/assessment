<?php
    namespace App\Controller;

    use App\Controller\Database;
    use Ramsey\Uuid\Uuid;
    use PDO;

    class Faculty extends Database{
        private $name;
        private $teacherId;
        private $email;
        private $assingedClass;
        private $password;
        private $schooldId;
        private $toTeach;
        private $classToTeach;

        public function login($data){
            $this->email = $data['email'];
            $this->password = $data['password'];
            $sql = "SELECT * FROM teacher WHERE email = ?";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$this->email]);
            $res = $prepStmt->fetch(PDO::FETCH_ASSOC);
            if($prepStmt->rowCount() > 0){
                $_SESSION['teacher'] = $res;
                return true;
               // echo $_SESSION['teacher']['assinged_class'];
            }
        }
        public function createTeacher($data){
            $this->name = $data['name'];
            $this->teacherId = Uuid::uuid6()->toString();
            $this->email = $data['email'];
            $this->class = $data['class'];
            $this->password = $data['password'];
            $this->schoolId = $data['school_id'];
            $this->toTeach = implode(",",$data['to_teach']);
            $this->classToTeach = implode(",",$data['class_to_teach']);

            $sql = "INSERT INTO teacher (name,teachers_id,email,password,assinged_class,school_id,subjects,class_to_teach) VALUE (?,?,?,?,?,?,?,?)";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$this->name,$this->teacherId,$this->email,$this->password,$this->class,$this->schoolId,$this->toTeach,$this->classToTeach]);
            if($exec){
                echo "Inserted successfully";
            }
        }

        public function selectClassStudents($class){
            $sql = "SELECT * FROM students WHERE class = ?";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$class]);
            if($prepStmt->rowCount() > 0){
                $res = $prepStmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            }else{
                echo "No student in this class yet!";
            }
        }
    }
?>
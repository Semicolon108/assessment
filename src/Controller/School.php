<?php
    namespace App\Controller;

    use App\Controller\Database;
    use Ramsey\Uuid\Uuid;
    
    class School extends Database{
        private $schoolName;
        private $schoolId;
        

        public function createSchool($details){
            $this->schoolName = $details["school"];
            $this->schoolId = Uuid::uuid6()->toString();
            $sql = "INSERT INTO school (school_name,school_id) VALUE (?,?)";
            $prepStmt = $this->connectDB()->prepare($sql);
            $exec = $prepStmt->execute([$this->schoolName, $this->schoolId]);
            if($exec){
                echo "school created";
            }
        }
    }
?>
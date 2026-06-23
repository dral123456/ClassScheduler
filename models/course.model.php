<?php
require_once "connection.php";

class ModelCourse{
  static public function regCourse($data){
    $db = new Connection();
    $pdo = $db->connect();
    try {
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->beginTransaction();

      $course_id = $pdo->prepare("
          SELECT CONCAT('CE', LPAD((COUNT(id)+1),4,'0')) as gen_id 
          FROM course
      ");
      $course_id->execute();
      $courseid = $course_id->fetch(PDO::FETCH_ASSOC);
      $coursecode = $courseid['gen_id'];

      $stmt = $pdo->prepare("
          INSERT INTO course(
              courseID, courseCode, courseName, roomNeed, courseHours, courseSessions, isSaturdayCourse, courseStatus
          ) VALUES (
              :courseID, :courseCode, :courseName, :roomNeed, :courseHours, :courseSessions, :isSaturdayCourse, 'Active'
          )
      ");
      $stmt->bindParam(":courseID", $coursecode, PDO::PARAM_STR);
      $stmt->bindParam(":courseCode", $data['courseCode'], PDO::PARAM_STR);
      $stmt->bindParam(":courseName", $data['courseName'], PDO::PARAM_STR);
      $stmt->bindParam(":roomNeed", $data['roomNeed'], PDO::PARAM_STR);
      $stmt->bindParam(":courseHours", $data['courseHours'], PDO::PARAM_STR);
      $stmt->bindParam(":courseSessions", $data['courseSessions'], PDO::PARAM_STR);
      $stmt->bindParam(":isSaturdayCourse", $data['isSaturdayCourse'], PDO::PARAM_STR);

      if($stmt->execute()){
        $pdo->commit();
        return "success";
      }else{
        $pdo->rollBack();
        return "error";
      }
    }catch (PDOException $e) {
      if ($pdo->inTransaction()) {
          $pdo->rollBack();
      }
      return "error: " . $e->getMessage();
    }
  }
  static public function courseList() {
    $stmt = (new Connection)->connect()->prepare("SELECT courseID, courseName, courseCode FROM course WHERE courseStatus = 'Active'");
    $stmt->execute();
    $results = $stmt->fetchAll();
    $stmt = null;
    return $results;
  }
}
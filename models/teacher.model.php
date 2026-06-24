<?php
require_once "connection.php";

class ModelTeacher{
  
  public static function regTeacher($data){
    $db = new Connection();
    $pdo = $db->connect();
    try {
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->beginTransaction();

      $teacher_id = $pdo->prepare("
          SELECT CONCAT('TR', LPAD((COUNT(id)+1),4,'0')) as gen_id 
          FROM teacher
      ");
      $teacher_id->execute();
      $teacherid = $teacher_id->fetch(PDO::FETCH_ASSOC);
      $teachercode = $teacherid['gen_id'];

      $stmt = $pdo->prepare("
          INSERT INTO teacher(
              teacherID, teacherFName, teacherMName, teacherLName, teacherSuffix, teacherStatus
          ) VALUES (
              :teacherID, :teacherFName, :teacherMName, :teacherLName, :teacherSuffix, 'Active'
          )
      ");
      $stmt->bindParam(":teacherID", $teachercode, PDO::PARAM_STR);
      $stmt->bindParam(":teacherFName", $data['teacherFName'], PDO::PARAM_STR);
      $stmt->bindParam(":teacherMName", $data['teacherMName'], PDO::PARAM_STR);
      $stmt->bindParam(":teacherLName", $data['teacherLName'], PDO::PARAM_STR);
      $stmt->bindParam(":teacherSuffix", $data['teacherSuffix'], PDO::PARAM_STR);

      if($stmt->execute()){
        $pdo->commit();
        return $teachercode;
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
  static public function teacherList($courseID = null) {
      $db = (new Connection)->connect();

      if ($courseID) {
          $stmt = $db->prepare("
              SELECT t.teacherID, t.teacherFName, t.teacherMName, t.teacherLName, t.teacherSuffix
              FROM teacher t
              INNER JOIN course_teacher ct ON t.teacherID = ct.teacherID
              WHERE t.teacherStatus = 'Active'
              AND ct.courseID = :courseID
          ");
          $stmt->bindParam(':courseID', $courseID, PDO::PARAM_STR);
      } else {
          $stmt = $db->prepare("
              SELECT teacherID, teacherFName, teacherMName, teacherLName, teacherSuffix
              FROM teacher
              WHERE teacherStatus = 'Active'
          ");
      }

      $stmt->execute();
      $results = $stmt->fetchAll();
      $stmt = null;
      return $results;
  }
}
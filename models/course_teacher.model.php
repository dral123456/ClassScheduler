<?php

require_once 'connection.php';

class ModelCourseTeacher{
  public static function regCourseTeacher($data){
    $db = new Connection();
    $pdo = $db->connect();
    try {
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->beginTransaction();

      $course_teacher_id = $pdo->prepare("
          SELECT CONCAT('CT', LPAD((COUNT(id)+1),4,'0')) as gen_id 
          FROM course_teacher
      ");
      $course_teacher_id->execute();
      $course_teacherid = $course_teacher_id->fetch(PDO::FETCH_ASSOC);
      $course_teachercode = $course_teacherid['gen_id'];

      $stmt = $pdo->prepare("
          INSERT INTO course_teacher(
            course_teacherID, courseID, teacherID
          ) VALUES (
            :course_teacherID, :courseID, :teacherID
          )
      ");
      $stmt->bindParam(":course_teacherID", $course_teachercode, PDO::PARAM_STR);
      $stmt->bindParam(":teacherID", $data['teacherID'], PDO::PARAM_STR);
      $stmt->bindParam(":courseID", $data['courseID'], PDO::PARAM_STR);

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
}
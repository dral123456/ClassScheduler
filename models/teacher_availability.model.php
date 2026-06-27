<?php
require_once 'connection.php';

class ModelTeacherAvailability {
    public static function regTeacherAvailability($data) {
        $db  = new Connection();
        $pdo = $db->connect();

        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

            $id_stmt = $pdo->prepare("
                SELECT CONCAT('TA', LPAD((COUNT(id)+1), 4, '0')) AS gen_id
                FROM teacher_availability
            ");
            $id_stmt->execute();
            $availabilityID = $id_stmt->fetch(PDO::FETCH_ASSOC)['gen_id'];

            $stmt = $pdo->prepare("
                INSERT INTO teacher_availability(availabilityID, teacherID, dayOfWeek, timeStart, timeEnd)
                VALUES (:availabilityID, :teacherID, :dayOfWeek, :timeStart, :timeEnd)
            ");
            $stmt->bindParam(':availabilityID', $availabilityID,    PDO::PARAM_STR);
            $stmt->bindParam(':teacherID',      $data['teacherID'], PDO::PARAM_STR);
            $stmt->bindParam(':dayOfWeek',      $data['dayOfWeek'], PDO::PARAM_STR);
            $stmt->bindParam(':timeStart',      $data['timeStart'], PDO::PARAM_STR);
            $stmt->bindParam(':timeEnd',        $data['timeEnd'],   PDO::PARAM_STR);

            if ($stmt->execute()) {
                $pdo->commit();
                return "success";
            } else {
                $pdo->rollBack();
                return "error";
            }
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) $pdo->rollBack();
            return "error: " . $e->getMessage();
        }
    }

    public static function clearTeacherAvailability($teacherID) {
        $db  = new Connection();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare("DELETE FROM teacher_availability WHERE teacherID = :teacherID");
            $stmt->bindParam(':teacherID', $teacherID, PDO::PARAM_STR);
            $stmt->execute();
            return "success";
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }
}
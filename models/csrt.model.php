<?php
require_once 'connection.php';

class ModelCsrt {
    public static function regCsrt($data) {
        $db  = new Connection();
        $pdo = $db->connect();

        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

            $id_stmt = $pdo->prepare("
                SELECT CONCAT('CS', LPAD((COUNT(id)+1), 4, '0')) AS gen_id
                FROM csrt
            ");
            $id_stmt->execute();
            $csrtID = $id_stmt->fetch(PDO::FETCH_ASSOC)['gen_id'];

            $stmt = $pdo->prepare("
                INSERT INTO csrt(CSRTID, courseID, sectionID, roomID, teacherID)
                VALUES (:CSRTID, :courseID, :sectionID, :roomID, :teacherID)
            ");
            $stmt->bindParam(':CSRTID',    $csrtID,            PDO::PARAM_STR);
            $stmt->bindParam(':courseID',  $data['courseID'],  PDO::PARAM_STR);
            $stmt->bindParam(':sectionID', $data['sectionID'], PDO::PARAM_STR);
            $stmt->bindParam(':roomID',    $data['roomID'],    PDO::PARAM_STR);
            $stmt->bindParam(':teacherID', $data['teacherID'], PDO::PARAM_STR);

            if ($stmt->execute()) {
                $pdo->commit();
                return "success";
            } else {
                $pdo->rollBack();
                return "error";
            }
        } catch (PDOException $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            return "error: " . $e->getMessage();
        }
    }
}
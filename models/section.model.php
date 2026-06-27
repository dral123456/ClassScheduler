<?php
require_once 'connection.php';

class ModelSection {
    public static function regSection($data) {
        $db  = new Connection();
        $pdo = $db->connect();

        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

            $id_stmt = $pdo->prepare("
                SELECT CONCAT('SC', LPAD((COUNT(id)+1), 4, '0')) AS gen_id
                FROM section
            ");
            $id_stmt->execute();
            $sectionID = $id_stmt->fetch(PDO::FETCH_ASSOC)['gen_id'];

            $stmt = $pdo->prepare("
                INSERT INTO section(sectionID, sectionCode, sectionSY, sectionSemester, sectionStatus)
                VALUES (:sectionID, :sectionCode, :sectionSY, :sectionSemester, 'Active')
            ");
            $stmt->bindParam(':sectionID',       $sectionID,               PDO::PARAM_STR);
            $stmt->bindParam(':sectionCode',     $data['sectionCode'],     PDO::PARAM_STR);
            $stmt->bindParam(':sectionSY',       $data['sectionSY'],       PDO::PARAM_STR);
            $stmt->bindParam(':sectionSemester', $data['sectionSemester'], PDO::PARAM_STR);

            if ($stmt->execute()) {
                $pdo->commit();
                return $sectionID;
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
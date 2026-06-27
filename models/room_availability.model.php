<?php
require_once 'connection.php';

class ModelRoomAvailability {
    public static function regRoomAvailability($data) {
        $db  = new Connection();
        $pdo = $db->connect();

        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();

            $id_stmt = $pdo->prepare("
                SELECT CONCAT('RA', LPAD((COUNT(id)+1), 4, '0')) AS gen_id
                FROM room_availability
            ");
            $id_stmt->execute();
            $availabilityID = $id_stmt->fetch(PDO::FETCH_ASSOC)['gen_id'];

            $stmt = $pdo->prepare("
                INSERT INTO room_availability(availabilityID, roomID, dayOfWeek, timeStart, timeEnd)
                VALUES (:availabilityID, :roomID, :dayOfWeek, :timeStart, :timeEnd)
            ");
            $stmt->bindParam(':availabilityID', $availabilityID,  PDO::PARAM_STR);
            $stmt->bindParam(':roomID',         $data['roomID'],  PDO::PARAM_STR);
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

    public static function clearRoomAvailability($roomID) {
        $db  = new Connection();
        $pdo = $db->connect();

        try {
            $stmt = $pdo->prepare("DELETE FROM room_availability WHERE roomID = :roomID");
            $stmt->bindParam(':roomID', $roomID, PDO::PARAM_STR);
            $stmt->execute();
            return "success";
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }
}
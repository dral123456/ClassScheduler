<?php
require_once "connection.php";

class ModelRoom{
  static public function regRoom($data){
    $db = new Connection();
    $pdo = $db->connect();
    try {
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->beginTransaction();

      $room_id = $pdo->prepare("
          SELECT CONCAT('RM', LPAD((COUNT(id)+1),4,'0')) as gen_id 
          FROM room
      ");
      $room_id->execute();
      $roomid = $room_id->fetch(PDO::FETCH_ASSOC);
      $roomcode = $roomid['gen_id'];

      $stmt = $pdo->prepare("
          INSERT INTO room(
              roomID, roomNum, roomType, roomStatus
          ) VALUES (
              :roomID, :roomNum, :roomType, 'Available'
          )
      ");
      $stmt->bindParam(":roomID", $roomcode, PDO::PARAM_STR);
      $stmt->bindParam(":roomNum", $data['roomNum'], PDO::PARAM_STR);
      $stmt->bindParam(":roomType", $data['roomType'], PDO::PARAM_STR);

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
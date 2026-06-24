<?php
class ControllerCsrt {
    static public function regCsrt($data) {
        $response = ModelCsrt::regCsrt($data);
        return $response;
    }
}
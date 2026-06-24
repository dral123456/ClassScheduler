<?php
class ControllerSection {
    static public function regSection($data) {
        $response = ModelSection::regSection($data);
        return $response;
    }
}
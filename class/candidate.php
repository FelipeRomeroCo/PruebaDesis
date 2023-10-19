<?php

require_once "conexion.php";

class Candidate {
    public $id;
    public $candidate_name;

    public function __construct(){
    }

    public function get_candidates(){
        $db = new Conexion();
        $query = "select id, candidate_name from candidates";
        $data = $db->query($query);
        return $data;
    }
}

?>
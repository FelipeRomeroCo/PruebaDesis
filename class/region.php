<?php

require_once "conexion.php";

class Region {
    public $id;
    public $region_name;

    public function __construct(){
    }

    public function get_regions(){
        $db = new Conexion();
        $query = "select id, region_name from regions";
        $data = $db->query($query);
        return $data;
    }
}



?>
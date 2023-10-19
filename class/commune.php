<?php

require_once "conexion.php";

class Commune {
    public $id;
    public $commune_name;

    public function __construct()   {
    }

    public function get_communes()    {
        $db = new Conexion();
        $query = "select id, commune_name from communes";
        $data = $db->query($query);
        return $data;
    }
}

?>
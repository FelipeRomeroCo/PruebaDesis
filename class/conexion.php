<?php 

class Conexion {

    public $conexion;

    public function __construct() {
        include('./config.php');
        
        $this->conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->conexion->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $this->conexion->connect_errno . ") " . $this->conexion->connect_error;
        }
    }

    public function pdo($sql, $parameters)  {
        $result = $this->conexion->prepare($sql);

        if (sizeof($parameters))    {
            $types = str_repeat("s", sizeof($parameters));
            $result->bind_param($types, ...$parameters);
        }
        $result->execute();
        $result = $result->get_result();
        return $result;
    }

    public function query($sql) {
        $result = $this->conexion->query($sql);
        if(!$result) {
            throw new Exception("Error al ejecutar la consulta: " . $this->conexion->error);
        }
        return $result;
    }
    
    public function cerrar() {
        $this->conexion->close();
    }

}

?>




<?php
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if($action == 'add_record'){
        // Conexión a la base de datos utilizando constantes de configuración definidas en config.php
        include('config.php');

        $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("La conexión falló: " . $conexion->connect_error);
        }

        // Obtener datos del formulario utilizando ajax
        $user_name = $_POST['user_name'];
        $user_nickname = $_POST['user_nickname'];
        $rut = $_POST['rut'];
        $email = $_POST['email'];
        $region = $_POST['region'];
        $commune = $_POST['commune'];
        $candidate = $_POST['candidate'];
        $web = $_POST['web'];
        $tv = $_POST['tv'];
        $social_media = $_POST['social_media'];
        $friend = $_POST['friend'];

        //Validación de caracteres especiales en input Nombre y Apellido por seguridad
        if (!preg_match('/^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ]+$/', $user_name)) {
            echo json_encode(
                array(
                    'success' => false,
                    'message' => "El Nombre y Apellido no pueden contener caracteres especiales"
                )
            );
            exit();
        }

        //Validación del lárgo mínimo de caracteres y presencia de letras y números para Alias 
        if (!preg_match('/^(?=.*[a-zA-ZáéíóúÁÉÍÓÚñÑ])(?=.*[0-9])/', $user_nickname) || strlen($user_nickname) <= 5) {
            echo json_encode(
                array(
                    'success' => false,
                    'message' => "El Alias debe contener más de 5 caracteres, letras y números"
                )
            );
            exit();
        }

        //Funciones utilizadas para validar que el RUT ingresado sea válido

        //Esta primera función transforma el RUT ingresado en array para eliminar los "." y "-" que se pudieron haber ingresado,
        //de este modo, el sistema podrá validar el rut sin importar cómo sea escrito
        function get_rut_numbers($rut) {
            $nambersRut = [];
            $rutArray = str_split($rut);
            foreach ($rutArray as $namber) {
                if ($namber != '.' && $namber != '-') {
                    $nambersRut[] = $namber;
                }
            }
            return $nambersRut;
        }

        //Esta segunda función realiza la lógica para verificar que el RUT sea válido
        function validate_rut($rut){

            $listaVerificadora = [2,3,4,5,6,7,2,3];
            $digitoVerificador = strtoupper(substr($rut, -1));
            
            // Obtener los números ingresados en el rut, excluyendo los puntos y el guión.
            $nambersRut = get_rut_numbers($rut);

            array_pop($nambersRut);

            // Asegurarse de que el rut ingresado tenga más de 7 dígitos.
            if (count($nambersRut) > 6) {
                // Convertir los números ingresados a enteros y revertir el orden para la multiplicación.
                $cuerpoInt = array_map('intval', $nambersRut);
                $cuerpoIntInvertido = array_reverse($cuerpoInt);
                $multiplicacion = array_map(function ($x, $y) { return $x * $y; }, $cuerpoIntInvertido, $listaVerificadora);

                $resultado = strval(11 - ceil(array_sum($multiplicacion) % 11));

                // Realizar las comprobaciones para determinar si el RUT es válido.
                if ($resultado === '10') {
                    $resultado = 'K';
                    if ($resultado === $digitoVerificador) {
                        return true;
                    } else {
                        return false;
                    }
                } elseif ($resultado === '11') {
                    $resultado = '0';
                    if ($resultado === $digitoVerificador) {
                        return true;
                    } else {
                        return false;
                    }
                } elseif ($resultado !== '0' && $resultado !== 'K' && $resultado !== '10' && $resultado !== '11') {
                    if ($resultado === $digitoVerificador) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }

        if(!validate_rut($rut)){
            echo json_encode(
                array(
                    'success' => false,
                    'message' => "El RUT ingresado no es válido"
                )
            );
            exit();
        } else {
            $rut = get_rut_numbers($rut);
            $rut = implode("", $rut);
        }

        //Validación de duplicación de votos por RUT
        $sql = "SELECT COUNT(*) as total FROM users WHERE rut = '$rut'";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            if ($fila['total'] > 0) {
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => "El RUT ingresado ya registró su voto"
                    )
                );
                $conexion->close();
                exit();
            } 
        } 

        //Validación de selección de una Región
        if(empty($region)){
            echo json_encode(
                array(
                    'success' => false,
                    'message' => "Debe seleccionar una Región"
                )
            );
            exit();
        }

        //Validación de selección de una Comuna
        if(empty($commune)){
            echo json_encode(
                array(
                    'success' => false,
                    'message' => "Debe seleccionar una Comuna"
                )
            );
            exit();
        }

        //Validación de selección de un Candidato
        if(empty($candidate)){
            echo json_encode(
                array(
                    'success' => false,
                    'message' => "Debe seleccionar un Candidato"
                )
            );
            exit();
        }

        //Validación de selección de dos opciones en Cómo se enteró de nosotros
        if (($web + $tv + $social_media + $friend) < 2){
            echo json_encode(
                array(
                    'success' => false,
                    'message' => "Debe seleccionar al menos dos opciones sobre Cómo se enteró de nosotros"
                )
            );
            exit();
        }

        // Insertar datos en la tabla 'users'
        $sql = "INSERT INTO users (
            user_name, 
            user_nickname, 
            rut, 
            email, 
            web, 
            tv, 
            social_media, 
            friend,
            region_id, 
            commune_id, 
            candidate_id
            ) VALUES (
                '$user_name', 
                '$user_nickname', 
                '$rut', 
                '$email', 
                $web, 
                $tv, 
                $social_media, 
                $friend,
                $region, 
                $commune, 
                $candidate
                )";

        if ($conexion->query($sql) === TRUE) {
            echo json_encode(
                array(
                    'success' => true,
                    'message' => "Nuevo registro creado con éxito"
                )
            );
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }

        $conexion->close();
    }

    if($action == 'search_commune'){
        $region = $_POST['region'];

        // Conexión a la base de datos utilizando constantes de configuración definidas en config.php
        include('config.php');

        $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $sql = "SELECT * FROM communes WHERE region_id = $region";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $comunas = array();
            while ($fila = $resultado->fetch_assoc()) {
                $comuna = array(
                    'id' => $fila['id'],
                    'commune_name' => $fila['commune_name']
                );
                array_push($comunas, $comuna);
            }
        
            echo json_encode(
                array(
                    'success' => true,
                    'message' => $comunas
                )
            );

            exit();
        }
        $conexion->close();
    }
}
?>
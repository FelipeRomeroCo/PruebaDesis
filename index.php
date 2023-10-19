<?php

require './class/conexion.php';
require './class/region.php';
require './class/commune.php';
require './class/candidate.php';

$region_db = new Region();
$regions = $region_db->get_regions();

$commune_db = new Commune();
$communes = $commune_db->get_communes();

$candidate_db = new Candidate();
$candidates = $candidate_db->get_candidates();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Votación</title>
</head>
<body>
    <h1>Formulario de Votación:</h1>
    <form>
        <table>
            <tr>
                <td><label for="name">Nombre y Apellido</label></td>
                <td><input id="name" type="text" style="width: 60%;" required></td>
            </tr>
            <tr>
                <td><label for="nickname">Alias</label></td>
                <td><input id="nickname" type="text" minlength="6" style="width: 60%;" required></td>
            </tr>
            <tr>
                <td><label for="rut">RUT</label></td>
                <td><input id="rut" type="text" style="width: 60%;" required></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input id="email" type="email" style="width: 60%;" required></td>
            </tr>
            <tr>
                <td><label for="region">Región</label></td>
                <td>
                    <select name="region" id="region" style="width: 62%;">
                        <option value="">Seleccione su Región</option>
                        <?php foreach ($regions as $region) { ?>
                            <option value="<?php echo $region["id"] ?>"><?php echo $region["region_name"] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="commune">Comuna</label></td>
                <td>
                    <select name="commune" id="commune" style="width: 62%;">
                        <option value="">Seleccione su Comuna</option>
                        <?php foreach ($communes as $commune) { ?>
                            <option value="<?php echo $commune["id"] ?>"><?php echo $commune["commune_name"] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="candidate">Candidato</label></td>
                <td>
                    <select name="candidate" id="candidate" style="width: 62%;">
                        <option value="">Seleccione un candidato</option>
                        <?php foreach ($candidates as $candidate) { ?>
                            <option value="<?php echo $candidate["id"] ?>"><?php echo $candidate["candidate_name"] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><p>Cómo se enteró de Nosotros</p></td>
                <td>
                    <input type="checkbox" id="web" name="web" value="web">
                    <label for="web">Web</label>

                    <input type="checkbox" id="tv" name="tv" value="tv">
                    <label for="tv">TV</label>

                    <input type="checkbox" id="social_media" name="social_media" value="social_media">
                    <label for="social_media">Redes Sociales</label>

                    <input type="checkbox" id="friend" name="friend" value="friend">
                    <label for="friend">Amigo</label>
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <button type="submit">Votar</button>
                </td>
            </tr> 
        </table>
    </form>

    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="main.js"></script>
</body>
</html>
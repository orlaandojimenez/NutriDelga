<?php
require '../common/config/mysqli.config.php';
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");
if(isset($_GET)):
  foreach($_GET as $key => $getValue):
    switch ($key):
      case 'control':
        list($userid, $control) = explode(";", $getValue);
        $mysqli->query("UPDATE ga_nutriologo SET admin = $control WHERE id = $userid LIMIT 1");
        break;
      case 'insert':
        $response = array();
        $response['response'] = false;
        list($nombres, $apellidos, $email, $sexo, $password) = explode(";", $getValue);
        $created = time();
        $mysqli->query("INSERT INTO ga_nutriologo (nombres, apellidos, email, sexo, path_img_perfil, status, fecha_nacimiento, created_at, updated_at, password) VALUES ('{$nombres}', '{$apellidos}', '{$email}', '{$sexo}','1', '10', '2016-08-16', '{$created}', '0','{$password}')");

        $response['response'] = "Usuario agregado con éxito!";

        echo json_encode($response);

        break;
      case 'delete':
        $mysqli->query("UPDATE ga_nutriologo SET enable = 0 WHERE `id`=$getValue");
        break;
      case 'update':
        $response = array();
        $response['response'] = false;
        list($userid, $nombres, $apellidos, $email, $sexo, $password) = explode(";", $getValue);

        if($password !== 'none'):
          $mysqli->query("UPDATE ga_nutriologo SET password = '{$password}' WHERE id = $userid");
        endif;

        $mysqli->query("UPDATE ga_nutriologo SET nombres = '{$nombres}', apellidos = '{$apellidos}', email = '{$email}', sexo = '{$sexo}' WHERE id=$userid");

        $response['response'] = "Datos guardados con éxito!";

        echo json_encode($response);

        break;

      default:
        echo "Error! Script no encontrado";
        break;
    endswitch;
  endforeach;
endif;
 ?>

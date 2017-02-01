<?php
require '../../common/config/mysqli.config.php';
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");

defined('YII_DEBUG') or define('YII_DEBUG', true);
  defined('YII_ENV') or define('YII_ENV', 'dev');


  require(__DIR__ . '/../../vendor/autoload.php');
  require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
  require(__DIR__ . '/../../common/config/bootstrap.php');
  require(__DIR__ . '/../config/bootstrap.php');

  $config = yii\helpers\ArrayHelper::merge(
      require(__DIR__ . '/../../common/config/main.php'),
      require(__DIR__ . '/../../common/config/main-local.php'),
      require(__DIR__ . '/../config/main.php'),
      require(__DIR__ . '/../config/main-local.php')
  );


  $application = new yii\web\Application($config);


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
      case 'insertObse':
        $response = array();
        list($observaciones,$userid) = explode(";",$getValue);
        $mysqli->query("UPDATE ga_consulta SET observaciones = '{$observaciones}' WHERE id = '{$userid}'");
        $response['response'] = "Consulta guardada con exito";
        echo json_encode($response);
        break;
      case 'searchObser':
        $response = array();
        list($userid) = explode(";",$getValue);
        $consulta = $mysqli->query("SELECT observaciones FROM ga_consulta WHERE id = '{$userid}'");
        if($row = $consulta->fetch_assoc()){
          $response['response'] = $row["observaciones"];
        }
        echo json_encode($response);
        break;
      case 'searchCal1':
        $response = array();
        list($userid) = explode(";",$getValue);
        $consulta = $mysqli->query("SELECT  SUM(ga_platillo_alimento.cantidad_calorica) FROM ga_platillo_alimento LEFT JOIN ga_dieta ON ga_platillo_alimento.id_platillo = ga_dieta.id_platillo WHERE ga_dieta.id_consulta = '{$userid}' AND ga_dieta.dia = 0");
        if($row = $consulta->fetch_assoc()){
          $response['response'] = $row["SUM(ga_platillo_alimento.cantidad_calorica)"];
        }
        echo json_encode($response);
        break;
        case 'searchCal2':
        $response = array();
        list($userid) = explode(";",$getValue);
        $consulta = $mysqli->query("SELECT  SUM(ga_platillo_alimento.cantidad_calorica) FROM ga_platillo_alimento LEFT JOIN ga_dieta ON ga_platillo_alimento.id_platillo = ga_dieta.id_platillo WHERE ga_dieta.id_consulta = '{$userid}' AND ga_dieta.dia = 1");
        if($row = $consulta->fetch_assoc()){
          $response['response'] = $row["SUM(ga_platillo_alimento.cantidad_calorica)"];
        }
        echo json_encode($response);
        break;
        case 'searchCal3':
        $response = array();
        list($userid) = explode(";",$getValue);
        $consulta = $mysqli->query("SELECT  SUM(ga_platillo_alimento.cantidad_calorica) FROM ga_platillo_alimento LEFT JOIN ga_dieta ON ga_platillo_alimento.id_platillo = ga_dieta.id_platillo WHERE ga_dieta.id_consulta = '{$userid}' AND ga_dieta.dia = 2");
        if($row = $consulta->fetch_assoc()){
          $response['response'] = $row["SUM(ga_platillo_alimento.cantidad_calorica)"];
        }
        echo json_encode($response);
        break;
        case 'searchCal4':
        $response = array();
        list($userid) = explode(";",$getValue);
        $consulta = $mysqli->query("SELECT  SUM(ga_platillo_alimento.cantidad_calorica) FROM ga_platillo_alimento LEFT JOIN ga_dieta ON ga_platillo_alimento.id_platillo = ga_dieta.id_platillo WHERE ga_dieta.id_consulta = '{$userid}' AND ga_dieta.dia = 3");
        if($row = $consulta->fetch_assoc()){
          $response['response'] = $row["SUM(ga_platillo_alimento.cantidad_calorica)"];
        }
        echo json_encode($response);
        break;
        case 'searchCal5':
        $response = array();
        list($userid) = explode(";",$getValue);
        $consulta = $mysqli->query("SELECT  SUM(ga_platillo_alimento.cantidad_calorica) FROM ga_platillo_alimento LEFT JOIN ga_dieta ON ga_platillo_alimento.id_platillo = ga_dieta.id_platillo WHERE ga_dieta.id_consulta = '{$userid}' AND ga_dieta.dia = 4");
        if($row = $consulta->fetch_assoc()){
          $response['response'] = $row["SUM(ga_platillo_alimento.cantidad_calorica)"];
        }
        echo json_encode($response);
        break;

      default:
        echo "Error! Script no encontrado";
        break;
    endswitch;
  endforeach;
endif;
 ?>

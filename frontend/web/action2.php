<?php	
	require '../../common/config/mysqli.config.php';
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

		if(isset($_POST['Agregar']))
		{
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$email = $_POST['email'];
			$sexo = $_POST['sexo'];				
			$fecha_nacimiento = date("Y-m-d");
			$created = time();  
			$password = Yii::$app->getSecurity()->generatePasswordHash($_POST['password']);
			       

			if($_FILES['imagen']['tmp_name'] !== "")
			{
				$imagen = date("YmdHis").".png";
				rename($_FILES['imagen']['tmp_name'],"assets/a72f2a9d/img/".$imagen); 
				chmod("assets/a72f2a9d/img/".$imagen, 0644);				
				$mysqli->query("INSERT INTO ga_nutriologo (nombres, apellidos, email, sexo, path_img_perfil, status, fecha_nacimiento, created_at, updated_at, password) VALUES ('{$nombre}', '{$apellido}', '{$email}', '{$sexo}','{$imagen}', '10', '{$fecha_nacimiento}', '{$created}', '0','{$password}')");
			}
			else
			{
				$mysqli->query("INSERT INTO ga_nutriologo (nombres, apellidos, email, sexo, path_img_perfil, status, fecha_nacimiento, created_at, updated_at, password) VALUES ('{$nombre}', '{$apellido}', '{$email}', '{$sexo}','1', '10', '{$fecha_nacimiento}', '{$created}', '0','{$password}')");
			}


		        
        

			header("Location: http://www.nutriologadelgado.com/frontend/web/usuarios");
		
	}
	elseif(isset($_POST['Modificar']))
	{
		$userid = $_POST['id'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$email = $_POST['email'];
		$sexo = $_POST['sexo'];			
		$password = $_POST['password'];
		
        if($password !== "")
        {		
	  	  $newPassword = Yii::$app->getSecurity()->generatePasswordHash($_POST['password']);
          $mysqli->query("UPDATE ga_nutriologo SET password = '{$newPassword}' WHERE id = $userid");
        }

        if($_FILES['imagen']['tmp_name'] !== "")
        {        	
        	$imagen = date("YmdHis").".png";	
        	rename($_FILES['imagen']['tmp_name'],"assets/a72f2a9d/img/".$imagen);
        	chmod("assets/a72f2a9d/img/".$imagen, 0644);        	
        	$mysqli->query("UPDATE ga_nutriologo SET path_img_perfil = '{$imagen}' WHERE id = $userid");
        }
        
        $mysqli->query("UPDATE ga_nutriologo SET nombres = '{$nombre}', apellidos = '{$apellido}', email = '{$email}', sexo = '{$sexo}' WHERE id=$userid");

        header("Location: http://www.nutriologadelgado.com/frontend/web/usuarios");
	}
	
		
?>
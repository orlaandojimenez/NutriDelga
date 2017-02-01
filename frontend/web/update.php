<?php
require '../../common/config/mysqli.config.php';

//$created = $_POST['created'];
//substr('abcdef', 0, 10);
$adicional = $_POST['adicional'];
$result = $mysqli->query("SELECT AUTO_INCREMENT AS auto_id FROM information_schema.TABLES WHERE TABLE_NAME = 'ga_alimento'");
/*$sql_command->execute();
$result = $sql_command->get_result();*/
$fetch = $result->fetch_assoc();
$auto_id = $fetch['auto_id'];

$created = 0;
$i = 0;
$html = '';
while($created < 1):

  $i++;
  $sql_command = $mysqli->query("SELECT * FROM ga_alimento WHERE id = '{$auto_id}' LIMIT 1");
  $exist = $sql_command->num_rows;

  if($exist > 0):
    //actualizamos
    $mysqli->query("UPDATE ga_alimento SET adicional = '{$adicional}' WHERE id = '{$auto_id}' LIMIT 1");
    $html .= 'comprobacion no. ' . $i . ' : COMPLETADO <br>';
    $created++;
  else:
    $html .= 'comprobacion no. ' . $i . ' <br>';
  endif;

endwhile;

echo $html;
//$sql_command->execute();




//echo $alimento['id_auto'];
//$alimentos = $mysqli->query("SELECT * FROM alimentos WHERE created_at = $")
 ?>

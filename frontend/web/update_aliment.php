<?php
 require '../../common/config/mysqli.config.php';

$adicional = $_POST['adicional'];
$id = $_POST['id'];

$mysqli->query("UPDATE ga_alimento SET adicional = '{$adicional}' WHERE id ='{$id}' LIMIT 1");
?>

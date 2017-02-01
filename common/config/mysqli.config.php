<?php
$mysql['hostname'] = 'localhost';
$mysql['username'] = 'root';
$mysql['password'] = '';
$mysql['dbname'] = 'nutridelga';

$mysqli = new mysqli($mysql['hostname'], $mysql['username'], $mysql['password'], $mysql['dbname'], 3306);
if($mysqli->connect_errno):
  exit("Error en la conexión al servidor MySQL");
endif; ?>

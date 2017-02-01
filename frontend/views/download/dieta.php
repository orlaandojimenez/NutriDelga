<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Consulta */
/* @var $form ActiveForm */


usort($dietas, function($a, $b) {
    return $a->dia - $b->dia;
});

?>

<div class="row">
    <div class="col-xs-2 text-right"><b>Paciente:</b></div>
    <div class="col-xs-3"><?= "$paciente->nombres $paciente->apellidos"?></div>
    <div class="col-xs-2 text-right"><b>Fecha Consulta:</b></div>
    <div class="col-xs-2"><?= date('d M Y', $consulta->created_at) ?></div>
</div>
<div class="row">
    <div class="col-xs-12">
        <h4>Dieta</h4>
        <?=  $this->render('_form_dieta.php',['model'=>$dietas, 'platillos'=> []]) ?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
    <p class="text-justify"><b>Observaciones: </b><?= $consulta->observaciones ?></p>
    <?php foreach ($dietas as $key => $dieta) { ?>
        <h4>Dieta #<?= $key+1 ?>: <?= $dieta->nombre ?> <small>(<?= Yii::$app->params['diaEnum'][$dieta->dia] ?>, <?= Yii::$app->params['tipoDietaEnum'][$dieta->tipo] ?>)</small></h4>
        <p><b>Cantidad calorica:</b> <?= $dieta->cantidad_calorica ?></p>
        <p><b>Ingredientes:</b></p>
        <ul>
        <?php foreach ($dieta->idPlatillo->platilloAlimentos as $key => $platilloAlimento) { ?>
            <li><?php if($platilloAlimento->cantidad == 0.5){
                echo '1/2';
                } 
                else if($platilloAlimento->cantidad == 0.25){
                    echo '1/4';
                }
                else if($platilloAlimento->cantidad == 0.75){
                    echo '3/4';
                }
                else if($platilloAlimento->cantidad == 0.33){
                    echo '1/3';
                }
                else if($platilloAlimento->cantidad == 0.66){
                    echo '2/3';
                }
                else
                   echo $platilloAlimento->cantidad
                
                ?> 
                <?= $platilloAlimento->idAlimento->nombre ?></li>
        <?php } ?>
        </ul>
        <p class="text-justify"><b>Preparación:</b> <?= $dieta->idPlatillo->preparacion ?></p>
        <hr/>
    <?php } ?>
    </div>
</div>
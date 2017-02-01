<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Consulta */
/* @var $form ActiveForm */
?>
<div class="row">
    <div class="col-xs-12">
        <h3>Sintomas y Signos</h3>
        <?= $sintomassignos != null ? $this->render('_form_signos_sintomas.php',['model'=>$sintomassignos]) : "<p>Sin datos</p>" ?>
    </div>
    <div class="col-xs-12">
        <h3>Estilo de vida</h3>
        <?= $estilovida!=null ? $this->render('_form_estilo.php',['model'=>$estilovida]) : "<p>Sin datos</p>" ?>
    </div>
    <div class="col-xs-12">
        <h3>Datos antropometricos</h3>
        <?= $antropometricos!=null ? $this->render('_form_antropometrico.php',['model'=>$antropometricos]) : "<p>Sin datos</p>" ?>
    </div>
    <div class="col-xs-12">
        <h3>Datos bioquimicos</h3>
        <?= $bioquimicos!=null ? $this->render('_form_bioquimicos.php',['model'=>$bioquimicos]) : "<p>Sin datos</p>" ?>
    </div>
    <div class="col-xs-12">
        <h3>Intervención</h3>
        <?= $intervencion!=null ? $this->render('_form_intervencion.php',['model'=>$intervencion]) : "<p>Sin datos</p>" ?>
    </div>
    <div class="col-xs-12">
        <h3>Recordatorios</h3>
        <?= $recordatorios!=null ? $this->render('_form_recordatorio.php',['model'=>$recordatorios,'cantidades'=>$cantidades]) : "<p>Sin datos</p>" ?>
    </div>
    <div class="col-xs-12">
        <h3>Dietas</h3>
        <?=  $this->render('_form_dieta.php',['model'=>$dietas, 'platillos'=> $platillos]) ?>
        <p class="text-justify"><b>Observaciones: </b><?= $consulta->observaciones ?></p>
    </div>
</div>

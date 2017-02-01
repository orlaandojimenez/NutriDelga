<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Consulta */
/* @var $form ActiveForm */

?>

<?php foreach ($consultas as $key => $consulta) {
    $paciente = $consulta->idPaciente;
    $antropometricos = $consulta->idDatosAntropometricos;
    $bioquimicos = $consulta->idDatosBioquimicos;
    $estilovida = $consulta->idEstiloVida;
    $intervencion = $consulta->idIntervencion;
    $recordatorio = $consulta->idRecordatorio;
    $sintomassignos = $consulta->idSintomasSignos;
    $cantidades = $recordatorio !== null ? $recordatorio->cantidades : null;
    $dietas = $consulta->dietas;
 ?>
    <div class="row">
        <h2>Consulta #<?= $key + 1 ?><small>(<?= date("d M Y", $consulta->created_at) ?>)</small></h2>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h4>Sintomas y Signos</h4>
            <?= $sintomassignos != null ? $this->render('_form_signos_sintomas.php',['model'=>$sintomassignos]) : "<p>Sin datos</p>" ?>
        </div>
        <div class="col-xs-12">
            <h4>Estilo de vida</h4>
            <?= $estilovida!=null ? $this->render('_form_estilo.php',['model'=>$estilovida]) : "<p>Sin datos</p>" ?>
        </div>
        <div class="col-xs-12">
            <h4>Datos antropometricos</h4>
            <?= $antropometricos!=null ? $this->render('_form_antropometrico.php',['model'=>$antropometricos]) : "<p>Sin datos</p>" ?>
        </div>
        <div class="col-xs-12">
            <h4>Datos bioquimicos</h4>
            <?= $bioquimicos!=null ? $this->render('_form_bioquimicos.php',['model'=>$bioquimicos]) : "<p>Sin datos</p>" ?>
        </div>
        <div class="col-xs-12">
            <h4>Intervención</h4>
            <?= $intervencion!=null ? $this->render('_form_intervencion.php',['model'=>$intervencion]) : "<p>Sin datos</p>" ?>
        </div>
        <div class="col-xs-12">
            <h4>Recordatorios</h4>
            <?= $recordatorio!=null ? $this->render('_form_recordatorio.php',['model'=>$recordatorio,'cantidades'=>$cantidades]) : "<p>Sin datos</p>" ?>
        </div>
        <div class="col-xs-12">
            <h4>Dietas</h4>
            <?=  $this->render('_form_dieta.php',['model'=>$dietas, 'platillos'=> []]) ?>
        </div>
        <hr/>
    </div>

<?php } ?>

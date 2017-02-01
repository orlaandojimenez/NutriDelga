<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Consulta */
/* @var $form ActiveForm */

$this->title = "Consulta | ".($paciente->nombres.' '.$paciente->apellidos);
$this->params['breadcrumbs'][] = ['label' => 'Pacientes', 'url' => Url::toRoute('paciente/index')];
$this->params['breadcrumbs'][] = $this->title;
dmstr\web\DataTablesAsset::register($this);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="nav-tabs-custom">
            <ul id="tab_form" class="nav nav-tabs">
                <li class="active"><a href="#signos" data-toggle="tab">Signos y Sintomas</a></li>
                <li><a href="#bioquimicos" data-toggle="tab">Bioquimicos </a></li>
                <li><a href="#estilo" data-toggle="tab">Estilo de vida</a></li>
                <li><a href="#antropometrico" data-toggle="tab">Antropométricos</a></li>
                <li><a href="#recordatorio" data-toggle="tab">Recordatorio</a></li>
                <li><a href="#intervencion" data-toggle="tab">Intervención</a></li>
                <li><a href="#tabDieta" data-toggle="tab">Dieta</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="signos">
                    <?= $this->render('_form_signos_sintomas.php',['model'=>$sintomassignos]) ?>
                </div>
                <div class="tab-pane" id="bioquimicos">
                    <?= $this->render('_form_bioquimicos.php',['model'=>$bioquimicos]) ?>
                </div>
                <div class="tab-pane" id="estilo">
                    <?= $this->render('_form_estilo.php',['model'=>$estilovida]) ?>
                </div>
                <div class="tab-pane" id="antropometrico">
                    <?= $this->render('_form_antropometrico.php',['model'=>$antropometricos]) ?>
                </div>
                <div class="tab-pane" id="recordatorio">
                    <?= $this->render('_form_recordatorio.php',['model'=>$recordatorios,'cantidades'=>$cantidades]) ?>
                </div>
                <div class="tab-pane" id="intervencion">
                    <?= $this->render('_form_intervencion.php',['model'=>$intervencion]) ?>
                </div>
                <div class="tab-pane" id="tabDieta">
                    <?=  $this->render('_form_dieta.php',['model'=>$dietas, 'platillos'=> $platillos]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
$('input').each(function()
{
  if($(this).val() == ''){
      $(this).val('NA');// = 'NA';
    }
});

</script>
<?= $this->render('@app/views/modals/_modal.php') ?>
<?= $this->render('@app/views/modals/_modal_ingrediente_edit.php') ?>
<?= $this->render('@app/views/modals/_modal_platillo_edit.php') ?>

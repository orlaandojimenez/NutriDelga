<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EstiloVida */
/* @var $form ActiveForm */

?>

<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
    <?= $form->field($model, 'id',['options'=>['class'=>'']])->hiddenInput()->label(false) ?>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'sueno') ?>
            <?= $form->field($model, 'actividad_fisica')->inline()->radioList([0=>"Si",1=>"No"]) ?>
            <?= $form->field($model, 'tipo_actividad_fisica') ?>
            <?= $form->field($model, 'frecuencia_actividad_fisica') ?>
            <?= $form->field($model, 'duracion_actividad_fisica') ?>
            <?= $form->field($model, 'fuma')->inline()->radioList([0=>"Si",1=>"No"]) ?>
            <?= $form->field($model, 'cantidad_fuma') ?>
            <?= $form->field($model, 'alcohol')->inline()->radioList([0=>"Si",1=>"No"]) ?>
            <?= $form->field($model, 'cantidad_alcohol') ?>
            <?= $form->field($model, 'suplementos')->inline()->radioList([0=>"Si",1=>"No"]) ?>
            <?= $form->field($model, 'cantidad_suplementos') ?>
           <?= $form->field($model, 'observaciones')->textArea(['rows'=>3]) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>

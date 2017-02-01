<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DatosAntropometricos */
/* @var $form ActiveForm */
?>
<?php $form = ActiveForm::begin(['layout' => 'horizontal', 'fieldConfig' => [
                                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                    'horizontalCssClasses' => [
                                        'label' => 'col-sm-8 col-md-6',
                                        'wrapper' => 'col-sm-4 col-md-6',
                                        'error' => '',
                                        'hint' => '',
                                    ],
                                ]]); ?>

    <div class="row"><?= $form->field($model, 'id',['options'=>['class'=>'']])->hiddenInput()->label(false) ?></div>
    <div class="row">
        <div class="col-sm-4 col-md-3"><?= $form->field($model, 'peso') ?></div>
        <div class="col-sm-4 col-md-3"><?= $form->field($model, 'talla') ?></div>
        <div class="col-sm-4 col-md-3"><?= $form->field($model, 'imc') ?></div>
        <div class="col-sm-4 col-md-3"><?= $form->field($model, 'porciento_grasa') ?></div>
        <div class="col-sm-4 col-md-3"><?= $form->field($model, 'porciento_agua') ?></div>
        <div class="col-sm-4 col-md-3"><?= $form->field($model, 'grasa_visceral') ?></div>
        <div class="col-sm-4 col-md-3"><?= $form->field($model, 'masa_magra') ?></div>
        <div class="col-sm-4 col-md-3"><?= $form->field($model, 'edad_metabolica') ?></div>
        <div class="col-sm-4 col-md-3"><?= $form->field($model, 'cintura') ?></div>
        <div class="col-sm-4 col-md-3"><?= $form->field($model, 'cadera') ?></div>
        <div class="col-sm-4 col-md-3"><?= $form->field($model, 'abdomen') ?></div>
        <div class="col-sm-4 col-md-3"><?= $form->field($model, 'pb') ?></div>
        <div class="col-sm-4 col-md-3"><?= $form->field($model, 'peso_objetivo') ?></div>        
        <div class="col-sm-4 col-md-3"><?= $form->field($model, 'observaciones')->textArea(['rows'=>3]) ?></div>
    </div>

<?php ActiveForm::end(); ?>

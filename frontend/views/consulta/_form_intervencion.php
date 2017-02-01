<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Intervencion */
/* @var $form ActiveForm */

$fieldPorcentaje = [
    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
    'horizontalCssClasses' => [
        'label' => 'col-sm-6',
        'wrapper' => 'col-sm-6',
        'error' => '',
        'hint' => '',
    ]
];

?>

<?php $form = ActiveForm::begin(['layout' => 'horizontal',
                                'fieldConfig' => [
                                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                    'horizontalCssClasses' => [
                                        'label' => 'col-sm-2',
                                        'wrapper' => 'col-sm-10',
                                        'error' => '',
                                        'hint' => '',
                                    ],
                                ],
    ]); ?>
    <div class="row"><?= $form->field($model, 'id',['options'=>['class'=>'']])->hiddenInput()->label(false) ?> </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <?= $form->field($model, 'kcal') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-4"><?= $form->field($model, 'porcentaje_carbohidratos',$fieldPorcentaje) ?></div>
                        <div class="col-sm-4"><?= $form->field($model, 'porcentaje_lipidos',$fieldPorcentaje) ?></div>
                        <div class="col-sm-4"><?= $form->field($model, 'porcentaje_proteina',$fieldPorcentaje) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-4"><?= $form->field($model, 'gramos_carbohidratos',$fieldPorcentaje) ?></div>
                        <div class="col-sm-4"><?= $form->field($model, 'gramos_lipidos',$fieldPorcentaje) ?></div>
                        <div class="col-sm-4"><?= $form->field($model, 'gramos_proteina',$fieldPorcentaje) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <?= $form->field($model, 'indicaciones')->textArea(['rows' => 6]) ?>
           <?= $form->field($model, 'observaciones')->textArea(['rows'=>3]) ?>
        </div>
    </div>


<?php ActiveForm::end(); ?>

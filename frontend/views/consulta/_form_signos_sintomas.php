<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\SintomasSignos */
/* @var $form ActiveForm */
?>

<?php $form = ActiveForm::begin(['id'=>'form_signos_sintomas','layout' => 'horizontal',
                                'fieldConfig' => [
                                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                    'horizontalCssClasses' => [
                                        'label' => 'col-sm-5',
                                        'wrapper' => 'col-sm-7',
                                        'error' => '',
                                        'hint' => '',
                                    ],
                                ],
                            ]); ?>
    <div class="row"><?= $form->field($model, 'id',['options'=>['class'=>'']])->hiddenInput()->label(false) ?></div>
    <div class="row">
        <div class="col-md-3 col-sm-4"><?= $form->field($model, 'apetito') ?></div>
        <div class="col-md-3 col-sm-4"><?= $form->field($model, 'estrenimiento') ?></div>
        <div class="col-md-3 col-sm-4"><?= $form->field($model, 'pirosis') ?></div>
        <div class="col-md-3 col-sm-4"><?= $form->field($model, 'distencion') ?></div>
        <div class="col-md-3 col-sm-4"><?= $form->field($model, 'vomito') ?></div>
        <div class="col-md-3 col-sm-4"><?= $form->field($model, 'piel') ?></div>
        <div class="col-md-3 col-sm-4"><?= $form->field($model, 'unas') ?></div>
        <div class="col-md-3 col-sm-4"><?= $form->field($model, 'cabello') ?></div>
        <div class="col-md-3 col-sm-4"><?= $form->field($model, 'mareos') ?></div>
        <div class="col-md-3 col-sm-4"><?= $form->field($model, 'cefalea') ?></div>
        <div class="col-md-3 col-sm-4"><?= $form->field($model, 'observaciones')->textArea(['rows'=>3]) ?></div>
    </div>


<?php ActiveForm::end(); ?>

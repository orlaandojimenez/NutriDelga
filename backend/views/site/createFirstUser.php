<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model backend\models\Usuario */
/* @var $form ActiveForm */
$this->title="Crear primer usuario";

dmstr\web\DatepickerAsset::register($this);
?>
<div class="box">
    <div class="box-header">
        <div class="box-body">
            <div class="col-sm-12">
                <?php $form = ActiveForm::begin(['id'=>'form_create_first_usuario','layout' => 'horizontal',
                                            'fieldConfig' => [
                                                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                                'horizontalCssClasses' => [
                                                    'label' => 'col-sm-3',
                                                    'wrapper' => 'col-sm-9',
                                                    'error' => '',
                                                    'hint' => '',
                                                ],
                                            ],
                                        ]); ?>
                
                    <div class="row">
                        <div class="col-sm-6"><?= $form->field($model, 'nombre') ?></div>
                        <div class="col-sm-6"><?= $form->field($model, 'apellidos') ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><?= $form->field($model, 'email') ?></div>
                        <div class="col-sm-6"><?= $form->field($model, 'fecha_nacimiento')->textInput(['data-rol' => 'datepicker']) ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><?= $form->field($model, 'password')->passwordInput() ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6"><?= $form->field($model , 'sexo')->dropDownList(Yii::$app->params['sexoEnum']) ?></div>
                    </div>
                    
                    
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary pull-right']) ?>
                    
                <?php ActiveForm::end(); ?></div>
        </div>
    </div>  
</div>

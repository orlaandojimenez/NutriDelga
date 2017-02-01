<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\NutriologoModel */
/* @var $form yii\widgets\ActiveForm */
dmstr\web\DatepickerAsset::register($this);
?>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
            </div>

            <?php $form = ActiveForm::begin(); ?>
            <div class="box-body">
                
                <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>
                
                <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>
                
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                
                <?php if(Yii::$app->controller->action->id==='create'){ ?>
                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                <?php } ?>
                
                <?= $form->field($model, 'path_img_perfil')->textInput(['maxlength' => true]) ?>
                
                <?= $form->field($model, 'fecha_nacimiento')->textInput(['data-rol' => 'datepicker']) ?>
                
                <?= $form->field($model , 'sexo')->dropDownList(Yii::$app->params['sexoEnum']) ?>
                
                <?= $form->field($model , 'status')->dropDownList(Yii::$app->params['statusEnum']) ?>
            </div>

            <div class="box-footer">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

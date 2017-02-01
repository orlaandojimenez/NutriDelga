<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Alimento */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="">
        <div class="box box-primary">
            <div class="box-header with-border">
            </div>
            <?php $form = ActiveForm::begin(); ?>

            <div class="box-body">
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'descripcion')->textArea(['maxlength' => true,'rows'=>6]) ?>

                <?= $form->field($model, 'kcal')->textInput() ?>

                <?= $form->field($model, 'por_lipidos')->textInput() ?>

                <?= $form->field($model, 'por_proteinas')->textInput() ?>

                <?= $form->field($model, 'por_carbohidratos')->textInput() ?>

                <?= $form->field($model, 'rico_en')->textInput() ?>

                <?= $form->field($model, 'racion')->textInput() ?>

                <?= $form->field($model, 'unidad')->textInput() ?>

                <?= $form->field($model, 'adicional')->textInput() ?>

                <?= $form->field($model, 'tipo')->dropDownList(ArrayHelper::getColumn(Yii::$app->params['tipoCantidadEnum'],function ($element) {
    return $element[0];
})) ?>

            </div>
            <div class="box-footer">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

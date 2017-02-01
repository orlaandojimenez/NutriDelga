<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AlimentoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alimento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!--<?= $form->field($model, 'id') ?>-->

    <!--<?= $form->field($model, 'id_nutriologo') ?>-->

    <?= $form->field($model, 'nombre') ?>

    <!--<?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'kcal') ?>-->



    <?php // echo $form->field($model, 'por_lipidos') ?>

    <?php // echo $form->field($model, 'por_proteinas') ?>

    <?php // echo $form->field($model, 'por_carbohidratos') ?>

    <?php // echo $form->field($model, 'rico_en') ?>

    <?php // echo $form->field($model, 'racion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

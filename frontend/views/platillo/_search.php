<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PlatilloSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="platillo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_nutriologo') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'cantidad') ?>

    <?= $form->field($model, 'ingredientes') ?>

    <?php // echo $form->field($model, 'preparacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

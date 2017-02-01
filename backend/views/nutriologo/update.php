<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\NutriologoModel */

$this->title = 'Update Nutriologo Model: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Nutriologo Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="nutriologo-model-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

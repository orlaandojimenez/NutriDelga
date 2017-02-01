<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\NutriologoModel */

$this->title = 'Create Nutriologo Model';
$this->params['breadcrumbs'][] = ['label' => 'Nutriologos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nutriologo-model-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Intervencion */
/* @var $form ActiveForm */

?>
    <?= DetailView::widget([
        'model' => $model,
        //'filterModel' => $searchModel,
        'attributes'=>[
            'kcal',
            'porcentaje_carbohidratos',
            'porcentaje_lipidos',
            'porcentaje_proteina',
            'indicaciones',
            'gramos_carbohidratos',
            'gramos_lipidos',
            'gramos_proteina',
            'observaciones',
        ]

    ]); ?>

    



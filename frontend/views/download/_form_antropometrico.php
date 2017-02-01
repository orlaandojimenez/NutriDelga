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
            'peso',
            'talla',
            'imc',
            'porciento_grasa',
            'grasa_visceral',
            'masa_magra',
            'edad_metabolica',
            'cintura',
            'cadera',
            'abdomen',
            'pb',
            'peso_objetivo',
            'observaciones',
        ]

    ]); ?>

    



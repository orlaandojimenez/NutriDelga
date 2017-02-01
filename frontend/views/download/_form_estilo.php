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
            'sueno',
            'actividad_fisica',
            'tipo_actividad_fisica',
            'frecuencia_actividad_fisica',
            'duracion_actividad_fisica',
            'fuma',
            'cantidad_fuma',
            'alcohol',
            'cantidad_alcohol',
            'suplementos',
            'cantidad_suplementos',
            'observaciones',
        ]

    ]); ?>

    



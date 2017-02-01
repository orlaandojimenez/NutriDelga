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
            'apetito',
            'estrenimiento',
            'pirosis',
            'distencion',
            'vomito',
            'piel',
            'unas',
            'cabello',
            'mareos',
            'cefalea',
            'observaciones',
        ]

    ]); ?>

    



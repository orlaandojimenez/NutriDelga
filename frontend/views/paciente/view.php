<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Paciente */

$this->title = $model->nombres;
$this->params['breadcrumbs'][] = ['label' => 'Pacientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paciente-view">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_nutriologo:html'=>[
                'label' => 'Nutriologo',
                'value' => $model->idNutriologo->nombres,
            ],
            'nombres',
            'apellidos',
            'sexo:html'=>[
                'label' => 'Sexo',
                'value' => Yii::$app->params['sexoEnum'][$model->sexo],
            ],
            'telefono',
            'motivo:ntext',
            'email:email',
            'fecha_nacimiento',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Alimento */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Alimentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alimento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Seguro que desea eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'id_nutriologo',
            'nombre',
            'descripcion',
            'kcal',
            'por_lipidos',
            'por_proteinas',
            'por_carbohidratos',
            'rico_en',
            'racion',
            'unidad',
            'tipo',
            'adicional',
        ],
    ]) ?>

</div>

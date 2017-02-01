<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\NutriologoModel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Nutriologo Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nutriologo-model-view">

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
            'nombres',
            'apellidos',
            'email:email',
            'password',
            'path_img_perfil',
            'fecha_nacimiento',
            'sexo',
            'password_reset_token',
            'status',
            'created_at',
            'updated_at',
            'auth_key',
        ],
    ]) ?>

</div>

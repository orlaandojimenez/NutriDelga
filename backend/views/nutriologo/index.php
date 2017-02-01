<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NutriologoSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nutriologos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box">
    <div class="box-header">
        <div class="box-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        
            <p class="text-right">
                <?= Html::a('<i class="fa fa-plus"></i> Agregar nutriologo', ['create'], ['class' => 'btn btn-info']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
        
                    'id',
                    'nombres',
                    'apellidos',
                    'email:email',
                    'password',
                    // 'path_img_perfil',
                    // 'fecha_nacimiento',
                    // 'sexo',
                    // 'password_reset_token',
                    // 'status',
                    // 'created_at',
                    // 'updated_at',
                    // 'auth_key',
        
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AlimentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alimentos';
$this->params['breadcrumbs'][] = $this->title;
dmstr\web\DataTablesAsset::register($this);
?>
<div class="box">
    <div class="box-body">

        <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

        <p class="text-right">
            <?= Html::a('<i class="fa fa-plus"></i> Alimento', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?php $dataProvider->sort = false; ?>
        <?= GridView::widget([

            //'filterModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tableOptions'=> ['id' => 'datatable_alimentos','class' => 'table table-bordered table-striped table-responsive'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                [
                    //'class' => DataColumn::className(), // this line is optional
                    'label' => 'Nombre',
                    'value' => function ($model) {
                        return Html::a($model->nombre, ['view','id'=>$model->id], []);
                    },
                    'format'=>'html'
                ],
                //'id_nutriologo',
                //'nombre',
                'descripcion',
                'kcal',
                //'tipo',
                // 'por_proteinas',
                // 'por_carbohidratos',
                // 'rico_en',
                // 'racion',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlatilloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Platillos';
$this->params['breadcrumbs'][] = $this->title;

dmstr\web\DataTablesAsset::register($this);

?>
<div class="box">
    <div class="box-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-right">
        <?= Html::a('<i class="fa fa-plus"></i> Platillo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $dataProvider->sort = false; ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'tableOptions'=> ['id' => 'datatable_frontend\models\Platillo', 'class' => 'table table-bordered table-striped table-responsive'],
        'columns'=>[
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'id_nutriologo',
            //'nombre',
            [
                //'class' => DataColumn::className(), // this line is optional
                'label' => 'Nombre',
                'value' => function ($model) {
                    return Html::a($model->nombre, ['view','id'=>$model->id], []);
                },
                'format'=>'html'
            ],
            'cantidad',
            [
                'label' => 'Cant. Calorica',
                'value' => function ($model) {
                    $cantidad_calorica = 0;
                    if($model->platilloAlimentos!==null)
                        foreach ($model->platilloAlimentos as $key => $platilloAlimento)
                            $cantidad_calorica += $platilloAlimento->cantidad_calorica;
                    return $cantidad_calorica;
                },
                'format'=>'html'
            ],
            //'preparacion:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
</div>

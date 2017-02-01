<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NutriologoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pacientes';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'template' => '<li><i class="fa fa-users"></i> {link}</li>'];

dmstr\web\DataTablesAsset::register($this);
dmstr\web\DatepickerAsset::register($this);
dmstr\web\MorrisAsset::register($this);
?>
<div class="box">
    <div class="box-body">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p class="text-right">
            <?= Html::a('<i class="fa  fa-user-plus"></i> Agregar paciente', ['create'], ['class' => 'btn btn-info', 'id'=>'modal_add_paciente',]) ?>
        </p>
        <?php $dataProvider->sort = false; ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'tableOptions'=> ['id' => 'datatable_pacientes', 'class' => 'table table-bordered table-striped'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    //'class' => DataColumn::className(), // this line is optional
                    'label' => 'Nombre',
                    'value' => function ($model) {
                        return Html::a($model->nombres . ' ' . $model->apellidos, Url::toRoute(['consulta/create/', 'id'=>$model->id]), []);
                    },
                    'format'=>'html'
                ],
                'email:email',
                //'id',
                //'id_nutriologo',
                //'apellidos',
                'telefono',
                [
                    //'class' => DataColumn::className(), // this line is optional
                    'label' => 'Sexo',
                    'value' => function ($model) {
                        return Yii::$app->params['sexoEnum'][$model->sexo];
                    },
                    'format'=>'html'
                ],
                [
                    //'class' => DataColumn::className(), // this line is optional
                    'label' => 'Ocupación',
                    'value' => function ($model) {
                        return $model->idDatosSocieconomicos !== null ? $model->idDatosSocieconomicos->ocupacion: "S/A";
                    },
                    'format'=>'html'
                ],
                // 'motivo:ntext',
                // 'fecha_nacimiento',
                // 'status',
                // 'created_at',
                // 'updated_at',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{historial} {chart} {update} {delete}',
                    'buttons'=>[
                        'view' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['class'=>'btn btn-default']);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,['class'=>'btn btn-default', "title"=>"Eliminar", 'aria-label'=>"Eliminar", 'data-confirm'=>"¿Está seguro de eliminar este elemento?", 'data-method'=>"post", 'data-pjax'=>"0"]);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['id'=>'modal_update_cliente', 'class'=>'btn btn-default']);
                        },
                        'historial' => function ($url, $model, $key) {
                            return Html::a('<span class="fa fa-folder"></span>', Url::toRoute(['consulta/historial/', 'id'=>$model->id]),['class'=>'btn btn-default']);
                        },
                        'chart' => function ($url, $model, $key) {
                            return Html::a('<span class="fa fa-bar-chart"></span>', Url::toRoute(['consulta/grafica/', 'id'=>$model->id]),['class'=>'btn btn-default','id' => "modal_grafica"]);
                        },
                    ]
                ],
            ],
        ]); ?>
    </div>
</div>
<?= $this->render('@app/views/modals/_modal.php') ?>

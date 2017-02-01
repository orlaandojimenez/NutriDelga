<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlatilloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Historial | ".$paciente->nombres.' '.$paciente->apellidos;
$this->params['breadcrumbs'][] = $this->title;

dmstr\web\DataTablesAsset::register($this);
dmstr\web\DatepickerAsset::register($this);
?>
<div class="box">
    <div class="box-body">
    <p class="text-right">
            <?= Html::a('<i class="fa  fa-download"></i> Historial', Url::toRoute("download/historial/".$paciente->id), ['class' => 'btn btn-primary', 'target'=>'blank', 'id' => "modal_rango_historial"]) ?>
        </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php $model->sort = false; ?>    
    <?= GridView::widget([
        'dataProvider' => $model,
        //'filterModel' => $searchModel,
        'tableOptions'=> ['id' => 'datatable_frontend\models\Platillo', 'class' => 'table table-bordered table-striped table-responsive'],
        'columns'=>[
            //['class' => 'yii\grid\SerialColumn'],

            [
                'label'=>'Fecha',
                'headerOptions' => ['data-priority'=>'1'],
                'attribute' => 'created_at',
                'format' => ['date', 'php:d-M-Y']
            ],
            [   'attribute' => 'idDatosAntropometricos.imc',
                //'headerOptions' => ['data-priority'=>'1'],
            ],
            //'idIntervencion.indicaciones',
            //'nombre',
            // 'preparacion:ntext',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['data-priority'=>'2'],
                    'template' => '{update} {download} {dieta} {delete}',
                    'buttons'=>[
                        'update' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 
                                            Url::toRoute([
                                                'consulta/assing',
                                                'id'=>$model->id
                                            ]),['class'=>'btn btn-default']);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,['class'=>'btn btn-default', "title"=>"Eliminar", 'aria-label'=>"Eliminar", 'data-confirm'=>"¿Está seguro de eliminar este elemento?", 'data-method'=>"post", 'data-pjax'=>"0"]);
                        },
                        'download' => function ($url, $model, $key) {
                            return Html::a('<i class="fa fa-download"></i>', 
                                            Url::toRoute([
                                                'download/consulta',
                                                'id'=>$model->id
                                            ]),['class'=>'btn btn-default','data-toggle'=>"tooltip", 'title'=>"Descargar consulta.", 'target'=>'blank']);
                        },
                        'dieta' => function ($url, $model, $key) {
                            return Html::a('<i class="fa fa-file-pdf-o"></i>', 
                                            Url::toRoute([
                                                'download/dieta',
                                                'id'=>$model->id
                                            ]),['class'=>'btn btn-default','data-toggle'=>"tooltip", 'title'=>"Descargar dieta.", 'target'=>'blank']);
                        },
                    ]
                ],
        ],
    ]); ?>
    </div>
</div>
<?= $this->render('@app/views/modals/_modal.php') ?>
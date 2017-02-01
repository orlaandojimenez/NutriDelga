<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;

$inputCalendar = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-calendar form-control-feedback'></span>"
];

if(!Yii::$app->request->isAjax){
    $this->title ="Generación de historial";
    dmstr\web\DatepickerAsset::register($this);
}
?>

<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Intervalo de fechas para generación de historial</h4>
            </div>
<?php $form = ActiveForm::begin([
        'id'=>'form_download_historial','layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-5',
                'wrapper' => 'col-sm-7',
                'error' => '',
                'hint' => '',
            ],
        ],
        'options' =>[
            'enableAjaxValidation' => true,
            'enableClientValidation'=> true,
            'target' => Yii::$app->request->isAjax ? 'new' : ''
        ]
]); ?>
    <div class="modal-body">
    <div class="box-body">
        <div class="row"> 
            <div class="col-sm-12"><?= Alert::widget() ?></div>
        </div>
        <div class="row">
            <div class="col-sm-6"><?= $form->field($model, 'fecha_ini', $inputCalendar)->inline()->textInput(['maxlength' => true, 'data-rol' => 'datepicker', 'autocomplete' => 'off',]) ?></div>
            <div class="col-sm-6"><?= $form->field($model, 'fecha_fin', $inputCalendar)->textInput(['maxlength' => true, 'data-rol' => 'datepicker', 'autocomplete' => 'off',]) ?></div>
        </div>
    </div><!-- /.box-body -->
    <div class="box-footer">        
        <button type="submit" class="btn btn-info pull-right">Consultar</button>
    </div><!-- /.box-footer -->
<?php ActiveForm::end(); ?>
</div>
        </div>
    </div>
<?php 
$script = <<<TEXTJS
    console.log("test");
TEXTJS;
$this->registerJS($script);
?>
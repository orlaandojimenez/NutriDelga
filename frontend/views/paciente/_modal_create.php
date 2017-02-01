<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;

$inputMail = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-envelope form-control-feedback'></span>"
];
$inputPhone = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-phone form-control-feedback'></span>"
];
$inputCalendar = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-calendar form-control-feedback'></span>"
];
$inputText = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}",
];
?>
<?php $form = ActiveForm::begin([
        'id'=>'form_create_update_paciente','layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-3',
                'wrapper' => 'col-sm-9',
                'error' => '',
                'hint' => '',
            ],
        ],
        'options' =>[
            'enableAjaxValidation' => true,
            'enableClientValidation'=> true
        ]
]); ?>
    <div class="box-body">
        <?= $form->field($model, 'id',['options'=>['class'=>'']])->hiddenInput()->label(false) ?>
        <div class="row"> 
            <div class="col-sm-12"><?= Alert::widget() ?></div>
        </div>
        <div class="row">
            <div class="col-sm-6"><?= $form->field($model, 'nombres', $inputText)->inline()->textInput(['maxlength' => true]) ?></div>
            <div class="col-sm-6"><?= $form->field($model, 'apellidos', $inputText)->textInput(['maxlength' => true]) ?></div>
        </div>
        <div class="row">
            <div class="col-sm-6"><?= $form->field($model , 'sexo', $inputText)->dropDownList(Yii::$app->params['sexoEnum']) ?></div>
            <div class="col-sm-6"><?= $form->field($model,  'email', $inputMail)->textInput(['maxlength' => true]) ?></div>
        </div>

        <div class="row">
            <div class="col-sm-6"><?= $form->field($model,  'telefono', $inputPhone)->textInput(['maxlength' => true]) ?></div>
            <div class="col-sm-6"><?= $form->field($model,  'fecha_nacimiento', $inputCalendar)->textInput(['maxlength' => true, 'data-rol' => 'datepicker', 'autocomplete' => 'off',]) ?></div>
        </div>
        <div class="row">
            <div class="col-sm-12"><?= $form->field($model,  'motivo')->textarea(['rows' => 6]) ?></div>
        </div>
    </div><!-- /.box-body -->
    <div class="box-footer">        
        <button type="submit" class="btn btn-info pull-right">Guardar</button>
    </div><!-- /.box-footer -->
<?php ActiveForm::end(); ?>
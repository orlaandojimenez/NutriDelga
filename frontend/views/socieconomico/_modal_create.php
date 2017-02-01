<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;
use yii\helpers\Url;

if(!isset($model) && isset($id_paciente) && ($model = frontend\models\DatosSocieconomicos::find()->joinWith('pacientes')->where(["ga_paciente.id" => $id_paciente])->one()) == null){
    $model = new \frontend\models\DatosSocieconomicos();
}
$inputText = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => '<div class="input-group"><span class="input-group-addon">$</span>{input}<span class="input-group-addon">.00</span></div>',
];
?>
<?php $form = ActiveForm::begin(['id'=>'form_modal_sociecomico','layout' => 'horizontal',
                                    'action' => Url::toRoute(["/socieconomico/add/", 'id'=>$id_paciente]),
                                    'fieldConfig' => [
                                        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                        'horizontalCssClasses' => [
                                            'label' => 'col-sm-5',
                                            'wrapper' => 'col-sm-7',
                                            'error' => '',
                                            'hint' => '',
                                        ],
                                    ],
                                ]); ?>
    <div class="box-body">
        <?= $form->field($model, 'id',['options'=>['class'=>'']])->hiddenInput()->label(false) ?>
        <div class="row"> 
            <div class="col-sm-12"><?= Alert::widget() ?></div>
        </div>
        <?= $form->field($model, 'ocupacion')->inline()->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'horario')->inline()->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'dinero_comida',$inputText)->inline()->textInput(['maxlength' => true]) ?>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right">Guardar</button>
    </div><!-- /.box-footer -->                                                        
<?php ActiveForm::end(); ?>

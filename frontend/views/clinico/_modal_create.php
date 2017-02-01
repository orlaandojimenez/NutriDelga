<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;
use yii\helpers\Url;

if(!isset($model) && isset($id_paciente) && ($model = frontend\models\DatosClinicos::find()->joinWith('pacientes')->where(["ga_paciente.id" => $id_paciente])->one()) == null){
    $model = new \frontend\models\DatosClinicos();
}
$inputText = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => '<div class="input-group"><span class="input-group-addon">$</span>{input}<span class="input-group-addon">.00</span></div>',
];
?>
<?php $form = ActiveForm::begin(['id'=>'form_modal_clinico','layout' => 'horizontal',
                                    'action' => Url::toRoute(["/clinico/add/", 'id'=>$id_paciente]),
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
    
        <?= $form->field($model, 'antecedentes_familiares')->inline()->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'antecedentes_personales')->inline()->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'padecimiento_actual')->inline()->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'medicamentos')->inline()->textInput(['maxlength' => true]) ?>

    </div>
    <div class="box-footer">                                                            
        <button type="submit" class="btn btn-info pull-right">Guardar</button>
    </div><!-- /.box-footer -->
<?php ActiveForm::end(); ?>
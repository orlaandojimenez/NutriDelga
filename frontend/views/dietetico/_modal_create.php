<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;
use yii\helpers\Url;

if(!isset($model) &&  isset($id_paciente) && ($model = frontend\models\DatosDieteticos::find()->joinWith('pacientes')->where(["ga_paciente.id" => $id_paciente])->one()) == null){
    $model = new \frontend\models\DatosDieteticos();
}
$inputFreccuenciaConsumo = [
    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
    'horizontalCssClasses' => [
        'label' => 'col-sm-4',
        'wrapper' => 'col-sm-8',
        'error' => '',
        'hint' => '',
    ],
];
?>
<?php $form = ActiveForm::begin(['id'=>'form_modal_clinico','layout' => 'horizontal',
                                    'action' => Url::toRoute(["/dietetico/add/", 'id'=>$id_paciente]),
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

        <?= $form->field($model, 'numero_comidas')->inline()->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'preaparacion')->inline()->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'ganancia')->inline()->textInput(['maxlength' => true]) ?>

        
        <p><b>Frecuencia de consumo semanal</b></p>
        <hr/>
        <div class="row">
            <div class="col-sm-6"><?= $form->field($model, 'lacteos', $inputFreccuenciaConsumo)->textInput(['maxlength' => true]) ?></div>
            <div class="col-sm-6"><?= $form->field($model, 'frutas', $inputFreccuenciaConsumo)->textInput(['maxlength' => true]) ?></div>
        </div>
        <div class="row">
            <div class="col-sm-6"><?= $form->field($model, 'verduras', $inputFreccuenciaConsumo)->textInput(['maxlength' => true]) ?></div>
            <div class="col-sm-6"><?= $form->field($model, 'aoa', $inputFreccuenciaConsumo  )->textInput(['maxlength' => true]) ?></div>
        </div>
        <div class="row">
            <div class="col-sm-6"><?= $form->field($model, 'leguminosas', $inputFreccuenciaConsumo)->textInput(['maxlength' => true]) ?></div>
            <div class="col-sm-6"><?= $form->field($model, 'cereales', $inputFreccuenciaConsumo)->textInput(['maxlength' => true]) ?></div>
        </div>
        <div class="row">
            <div class="col-sm-6"><?= $form->field($model, 'producto', $inputFreccuenciaConsumo)->textInput(['maxlength' => true]) ?></div>
        </div>
    <div class="box-footer">                                                            
        <input type="hidden" name="info" value="dietetico">
        <input type="hidden" name="id"  id="idD" value="">
        <button type="submit" class="btn btn-info pull-right">Guardar</button>
    </div><!-- /.box-footer -->
<?php ActiveForm::end(); ?>
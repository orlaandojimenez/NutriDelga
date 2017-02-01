<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Recordatorio */
/* @var $form yii\widgets\ActiveForm */

?>

<?php $form = ActiveForm::begin(['layout' => 'horizontal',
                                'fieldConfig' => [
                                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                    'horizontalCssClasses' => [
                                        'label' => 'col-sm-2',
                                        'wrapper' => 'col-sm-10',
                                        'error' => '',
                                        'hint' => '',
                                    ],
                                ],
    ]); ?>
    <div class="row"><?= $form->field($model, 'id',['options'=>['class'=>'']])->hiddenInput()->label(false) ?> </div>
    <div class="row"><?= $form->field($model, 'indicaciones',['options'=>['class'=>'']])->textArea(['rows'=>6]) ?> </div>
	<div class="row">
		<div class="col-sm-12">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr class="active">
							<th></th>
							<th>Desayuno</th>
							<th>Colación</th>
							<th>Comida</th>
							<th>Colación</th>
							<th>Cena</th>
							<th>Otros</th>
						</tr>
					</thead>
					<tbody id="cantidades">
						<?php for ($i=0; $i < count($cantidades); $i++) { ?>
						<tr>
							<th class="active" style="width: 200px !important;">
								<?php // $form->field($cantidades[$i], "[$i]id",['options'=>['class'=>''],'template' => "{input}"])->hiddenInput()->label(false) ?>
								<?= $form->field($cantidades[$i], "[$i]tipo",['options'=>['class'=>''],'template' => "{input}"])->hiddenInput()->label(false) ?>
								<?= Yii::$app->params['tipoCantidadEnum'][$cantidades[$i]->tipo][0] ?>
							</th>
							<td>
								<?= $form->field($cantidades[$i], "[$i]desayuno",['options'=>['class'=>''],'template' => "{input}"])->label(false) ?>
							</td>
							<td>
								<?= $form->field($cantidades[$i], "[$i]colacion_desayuno",['options'=>['class'=>''],'template' => "{input}"])->label(false) ?>
							</td>
							<td>
								<?= $form->field($cantidades[$i], "[$i]comida",['options'=>['class'=>''],'template' => "{input}"])->label(false) ?>
							</td>
							<td>
								<?= $form->field($cantidades[$i], "[$i]colacion_comida",['options'=>['class'=>''],'template' => "{input}"])->label(false) ?>
							</td>
							<td>
								<?= $form->field($cantidades[$i], "[$i]cena",['options'=>['class'=>''],'template' => "{input}"])->label(false) ?>
							</td>
							<td>
								<?= $form->field($cantidades[$i], "[$i]otros",['options'=>['class'=>''],'template' => "{input}"])->label(false) ?>
							</td>
						</tr>
						<?php } ?>
						<tr class="info">
							<th>Calorias subtotales</th>
							<td class="text-center"><?= $model->kcal_desayuno ?></td>
							<td class="text-center"><?= $model->kcal_colacion_desayuno ?></td>
							<td class="text-center"><?= $model->kcal_comida ?></td>
							<td class="text-center"><?= $model->kcal_colacion_comida ?></td>
							<td class="text-center"><?= $model->kcal_cena ?></td>
							<td class="text-center"><?= $model->kcal_otros ?></td>
						</tr>
						<tr class="success">
							<th>Calorias totales</th>
							<td colspan="6" class="text-center"><?= $model->kcal ?></td>
						</tr>
					</tbody>
				</table>

    	<?= $form->field($model, 'observaciones')->textArea(['rows'=>3]) ?>
			</div>
			<p class="text-right">
		        <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary', 'id' => 'btn_submit_ajax']) ?>
			</p>
		</div>
	</div>
<?php ActiveForm::end(); ?>

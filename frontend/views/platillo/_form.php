<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Platillo */
/* @var $form yii\widgets\ActiveForm */
dmstr\web\DataTablesAsset::register($this);
?>

<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
		    <div class="box-header with-border">
			</div>
		    <?php $form = ActiveForm::begin(['id'=>isset($isModal) && $isModal? 'form_modal_nuevo_platillo':'',
		    	'options'=>['data-container'=>'#platillo-create']
		    ]); ?>
		
			<div class="box-body">

				<?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

				<?= $form->field($model, 'cantidad')->textInput(['maxlength' => true]) ?>

				<?= $form->field($model, 'preparacion')->textarea(['rows' => 6]) ?>
				
				<p><b>Alimentos</b></p>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Alimento</th>
								<th>Cantidad</th>
								<th>Cant. Calorica</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="ingredientes">
							<?php for ($i=0; $i < count($ingredientes); $i++) { ?>
							<tr data-platillo-alimento="<?= $ingredientes[$i]->id_alimento ?>">
								<td name="Ingrediente">
									<?= $form->field($ingredientes[$i], "[$i]id_alimento",['options'=>['class'=>''],'template' => "{input}"])->hiddenInput()->label(false) ?>
									<?= $form->field($ingredientes[$i], "[$i]cantidad",['options'=>['class'=>''],'template' => "{input}"])->hiddenInput()->label(false) ?>
									<?= $form->field($ingredientes[$i], "[$i]cantidad_calorica",['options'=>['class'=>''],'template' => "{input}"])->hiddenInput()->label(false) ?>
									<?= $ingredientes[$i]->idAlimento->nombre ?>						
								</td>
								<td name="cantidad"><?= $ingredientes[$i]->cantidad ?></td>
								<td name="calorias"><?= $ingredientes[$i]->cantidad_calorica ?></td>
								<td><button type="button" class="btn btn-danger btn-xs" data-ingrediente-remove="yes"><span class="glyphicon glyphicon-remove"></span></button></td>
							</tr>
							<?php } ?>
						</tbody>
                        <tr class="active">
                            <th>Cantidad total kal.</th>
                            <td>
															<body onload="setInterval('total()',500);">
																<p id="calTotal"></p>
															</body>
                            </td>
                        </tr>
					</table>
				</div>
			</div>
		    
		    <div class="box-footer">
		    	<div class="form-group">
		    	    <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		    	</div>
		    </div>
		
		    <?php ActiveForm::end(); ?>
		</div>
	</div>
	<div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
            <h4>Alimentos disponibles</h4>
            </div>
            <div class="box-body">
           
				<?php $dataProviderAlimentos->sort = false; ?>
		        <?= GridView::widget([
		            'dataProvider' => $dataProviderAlimentos,
		            //'filterModel' => $searchModel,
		            'tableOptions'=> ['id' => 'datatable_alimentos','class' => 'table table-bordered table-striped'],
		            'options'=>['style'=>'max-width:500px;'],
		            'columns' => [
		                //['class' => 'yii\grid\SerialColumn'],

		                //'id',
		                'nombre',
		                //'id_nutriologo',
		                //'nombre',
		                //'descripcion',
		                'kcal',
		                // 'por_lipidos',
		                // 'por_proteinas',
		                // 'por_carbohidratos',
		                // 'rico_en',
		                // 'racion',
                        'unidad',
		                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{add}',
                    'buttons'=>[
                        'add' => function ($url, $model, $key) {
                            return Html::button('<span class="glyphicon glyphicon-plus"></span>',['class'=>'btn btn-primary btn-xs', 'data-ingrediente-add'=>$model->id]);
                        }
                    ]
                ],
		            ],
		        ]); ?>

            </div>
            <div class="box-footer">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function total() {
	var total = 0;
	$("#ingredientes tr").find('td:eq(2)').each(function (){
		valor = $(this).html();
		total += parseFloat(valor);
	})
document.getElementById("calTotal").innerHTML = total;
}
</script>
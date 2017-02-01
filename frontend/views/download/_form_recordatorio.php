<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Recordatorio */
/* @var $form yii\widgets\ActiveForm */

?>

    <div class="row">
    	<div class="col-xs-12">
	    	<p class="text-justify"><b>Indicaciones: </b><?= $model->indicaciones ?></p>
	    </div>
	</div>
	<div class="row">
		<div class="col-xs-12">
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
								<?= Yii::$app->params['tipoCantidadEnum'][$cantidades[$i]->tipo][0] ?>						
							</th>
							<td>
								<?= $cantidades[$i]->desayuno ?>
							</td>
							<td>
								<?= $cantidades[$i]->colacion_desayuno ?>
							</td>
							<td>
								<?= $cantidades[$i]->comida ?>
							</td>
							<td>
								<?= $cantidades[$i]->colacion_comida ?>
							</td>
							<td>
								<?= $cantidades[$i]->cena ?>
							</td>
							<td>
								<?= $cantidades[$i]->otros ?>
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
				<p><b>Observaciones: </b><?= $model->observaciones ?></p>
			</div>
			
		</div>
	</div>

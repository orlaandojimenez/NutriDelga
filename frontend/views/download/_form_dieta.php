<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model frontend\models\Recordatorio */
/* @var $form yii\widgets\ActiveForm */

?>

	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr class="active">
							<th></th>
							<?php foreach(Yii::$app->params['diaEnum'] as $key => $value) {?>
								<th><?= $value ?></th>
							<?php } ?>
						</tr>
					</thead>
					<tbody id="platillos">
					<?php $counter = 0 ?>
					<?php for($i=0; $i < count(Yii::$app->params['tipoDietaEnum']); $i++) { ?>
						<tr>
							<th class="active" style="width: 100px !important;"><?= Yii::$app->params['tipoDietaEnum'][$i] ?></th>
                			<?php for ($j=0; $j < count(Yii::$app->params['diaEnum']); $j++) { ?>
                			<td>
            				<?php foreach ($model as $key => $value) { ?>
            				<?php 	if($value->tipo == $i && $value->dia == $j){?>
        					<span class="label label-default">
					        	<input type="hidden" value="<?= $value->id_platillo ?>" name="Dieta[<?= $counter ?>][id_platillo]"/>
				         		<input type="hidden" value="<?= $value->tipo ?>" name="Dieta[<?= $counter ?>][tipo]"/>
				           		<input type="hidden" value="<?= $value->dia ?>" name="Dieta[<?= $counter ?>][dia]"/>
				           		<input type="hidden" value="<?= $value->nombre ?>" name="Dieta[<?= $counter ?>][nombre]"/>
				           		<a href="#" data-platillo-remove>
				               		<i class="remove glyphicon glyphicon-remove-sign glyphicon-white"></i>
					        	</a>
					        <?= $value->nombre ?>
					        </span>
					        <?php 		$counter++ ;?>
            				<?php 	} ?>
            				<?php } ?>
                			</td>                    		
	                		<?php } ?>
	                	</tr>
	                <?php } ?>
					</tbody>
				</table>
			</div>
			
		</div>
	</div>


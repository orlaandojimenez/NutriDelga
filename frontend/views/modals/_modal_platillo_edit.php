<?php
use yii\helpers\Html;
?>
<div class="modal fade" id="modalPlatilloEdit" tabindex="-1" role="dialog" style="z-index: 1600;">
	<div class="modal-dialog">
		<div class="modal-content">
	        <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title" id="myModalLabel">Datos del platillo</h4>
	        </div>
	        <form class="form-horizontal" role="form">
	        	<div class="modal-body">
					<input type="hidden" name="Dieta[0][id_platillo]" value="0">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
				                <label class="col-md-4 control-label" for="Dieta[0][nombre]">Nombre</label>
				                <div class="col-md-8">
				                    <input class="form-control" name="Dieta[0][nombre]" disabled type="text"/>
				                </div>
				            </div>
						</div>
			            <div class="col-sm-12">
			            	<div class="form-group">
			            	    <label class="col-md-4 control-label" for="Dieta[0][cantidad]">Cantidad</label>
			            	    <div class="col-md-8">
			            	        <input class="form-control" name="Dieta[0][cantidad]" type="number" min="1" disabled="">
			            	    </div>
			            	</div>
			            </div>
			            <div class="col-sm-12">
			            	<div class="form-group">
			            	    <label class="col-md-4 control-label" for="Dieta[0][cantidad_calorica]">
			            	        Cant. Calorica
			            	    </label>
			            	    <div class="col-md-8">
			            	        <input class="form-control" name="Dieta[0][cantidad_calorica]" type="number" disabled="">
			            	    </div>
			            	</div>
			            </div>
			            <div class="col-sm-12">
			            	<div class="form-group">
			            	    <label class="col-md-4 control-label" for="Dieta[0][tipo]">
			            	        Tipo
			            	    </label>
			            	    <div class="col-md-8">
			            	        <?= Html::dropDownList("Dieta[0][tipo]", "", Yii::$app->params['tipoDietaEnum'], ['class'=>'form-control']) ?>
			            	    </div>
			            	</div>
			            </div>
			            <div class="col-sm-12">
			            	<div class="form-group">
			            	    <label class="col-md-4 control-label" for="Dieta[0][dia]">
			            	        Día
			            	    </label>
			            	    <div class="col-md-8">
			            	        <?= Html::dropDownList("Dieta[0][dia]", "", Yii::$app->params['diaEnum'], ['class'=>'form-control']) ?>
			            	    </div>
			            	</div>
			            </div>
					</div>
		    	</div>
	        	<div class="modal-footer">
	        	    <button type="button" id="modalPlatilloEditSave" class="btn btn-info pull-right">Agregar</button>
	        	</div>
	        </form>
		</div>
	</div>
</div>
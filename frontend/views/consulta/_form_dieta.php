<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model frontend\models\Recordatorio */
/* @var $form yii\widgets\ActiveForm */

?>

<?php $form = ActiveForm::begin(['id'=>'form_dieta','layout' => 'horizontal',
                                'fieldConfig' => [
                                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                    'horizontalCssClasses' => [
                                        'label' => 'col-sm-2',
                                        'wrapper' => 'col-sm-10',
                                        'error' => '',
                                        'hint' => '',
                                    ],
                                ],
                                'options'=>['data-container'=>'#tabDieta']
    ]); ?>

 	<div class="row">
		<div class="col-md-7">
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
			<body onload="consultaObser(); consultaCal1(); consultaCal2(); consultaCal3(); consultaCal4(); consultaCal5();">
    		<table class="table table-bordered">
					<tr class="active">
						<td>
							<label>Total calorias</label>
						</td>
						<td>
							<textarea id="calDia1" name="calDia1" class="form-control" readonly="true" placeholder="0" style="text-align: right;"></textarea>
						</td>
						<td>
							<textarea id="calDia2" name="calDia2" class="form-control" readonly="true" placeholder="0" style="text-align: right;"></textarea>
						</td>
						<td>
							<textarea id="calDia3" name="calDia3" class="form-control" readonly="true" placeholder="0" style="text-align: right;"></textarea>
						</td>
						<td>
							<textarea id="calDia4" name="calDia4" class="form-control" readonly="true" placeholder="0" style="text-align: right;"></textarea>
						</td>
						<td>
							<textarea id="calDia5" name="calDia5" class="form-control" readonly="true" placeholder="0" style="text-align: right;"></textarea>
						</td>
					</tr>
				</table>
    			<label>Observaciones</label>
    			<textarea id="obserText" name="obserText" class="form-control"></textarea><br />
    			<input type="hidden" id="idConsulta" name="idConsulta" value="<?php echo $value->id_consulta ?>"></input>
    		</body>
			<p class="text-right">
		        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary', 'id' => 'btn_submit_ajax', 'onclick' => 'addObservaciones();']) ?>
    		</p>
		</div>
		<div class="col-md-5">
	        <div class="box box-primary">
	            <div class="box-header with-border">
	            <h4>Platillos disponibles
                <?= Html::a('<i class="fa  fa-plus"></i> Alimento', Url::toRoute('alimento/create'), ['class' => 'btn btn-success btn-sm pull-right', 'id'=>'modal_add_alimento','data-size'=>'lg']) ?>
                
                <!--<?= Html::a('<i class="fa  fa-plus"></i> Platillo', Url::toRoute('platillo/create'), ['class' => 'btn btn-info btn-sm pull-right', 'id'=>'modal_add_platillo','data-size'=>'lg']) ?></h4>-->

                <?= Html::a('<i class="fa  fa-plus"></i> Platillo', Url::toRoute('platillo/create'), ['class' => 'btn btn-info btn-sm pull-right']) ?></h4>

	            </div>
	            <div class="box-body">
					<?php $platillos->sort = false; ?>
			        <?= GridView::widget([
			            'dataProvider' => $platillos,
			            //'filterModel' => $searchModel,
			            'tableOptions'=> ['id' => 'datatable_platillos','class' => 'table table-bordered table-striped'],
			            'columns' => [
			                'nombre',
			                'cantidad',
			                [
			                    'label' => 'Cant. Calorica',
			                    'value' => function ($model) {
			                    	$cantidad_calorica = 0;
			                    	if($model->platilloAlimentos!==null)
				                    	foreach ($model->platilloAlimentos as $key => $platilloAlimento)
				                    		$cantidad_calorica += $platilloAlimento->cantidad_calorica;
			                        return $cantidad_calorica;
			                    },
			                    'format'=>'html'
			                ],
			                [
		                    'class' => 'yii\grid\ActionColumn',
		                    'template' => '{add}',
		                    'buttons'=>[
		                        'add' => function ($url, $model, $key) {
		                            return Html::button('<span class="glyphicon glyphicon-plus"></span>',['class'=>'btn btn-primary btn-xs', 'data-platillo-add'=>$model->id]);
		                        }
		                    ]],
			            ],
			        ]); ?>

	            </div>
	            <div class="box-footer">
	        </div>
	    </div>
	</div>
<?php ActiveForm::end(); ?>
<script type="text/javascript">
	function addObservaciones(){
		var header = window.location.href;
		var userid = $("#idConsulta").val();
		var obser = $("#obserText").val();
		var datamin = obser + ';' + userid + ';';
		$.ajax({
			url:'http://www.nutriologadelgado.com/frontend/web/action.php',
			//url:'http://localhost:8080/ProyectoNutriologa/public_html/frontend/web/action.php',
			type:'GET',
			dataType: 'json',
			data:{'insertObse':datamin},
			success: function(datas){
				alert(datas.response);
			}
		});
		setTimeout(location.reload.bind(location),3000);
	}

	function consultaObser()
	{
		var header = window.location.href;
		var userid = $("#idConsulta").val();
		var datamin = userid + ';';
		$.ajax({
			url:'http://www.nutriologadelgado.com/frontend/web/action.php',
			//url:'http://localhost:8080/ProyectoNutriologa/public_html/frontend/web/action.php',
			type:'GET',
			dataType: 'json',
			data:{'searchObser':datamin},
			success: function(datas){
				$("#obserText").val(datas.response);
			}
		});
	}

	function consultaCal1(){
		var header = window.location.href;
		var userid = $("#idConsulta").val();
		var datamin = userid + ';';
		$.ajax({
			//url:'http://www.nutriologadelgado.com/frontend/web/action.php',
			url:'http://localhost:8080/ProyectoNutriologa/public_html/frontend/web/action.php',
			type:'GET',
			dataType: 'json',
			data:{'searchCal1':datamin},
			success: function(datas){
				$("#calDia1").val(datas.response);
			}
		});
	}

	function consultaCal2(){
		var header = window.location.href;
		var userid = $("#idConsulta").val();
		var datamin = userid + ';';
		$.ajax({
			url:'http://www.nutriologadelgado.com/frontend/web/action.php',
			//url:'http://localhost:8080/ProyectoNutriologa/public_html/frontend/web/action.php',
			type:'GET',
			dataType: 'json',
			data:{'searchCal2':datamin},
			success: function(datas){
				$("#calDia2").val(datas.response);
			}
		});
	}

	function consultaCal3(){
		var header = window.location.href;
		var userid = $("#idConsulta").val();
		var datamin = userid + ';';
		$.ajax({
			url:'http://www.nutriologadelgado.com/frontend/web/action.php',
			//url:'http://localhost:8080/ProyectoNutriologa/public_html/frontend/web/action.php',
			type:'GET',
			dataType: 'json',
			data:{'searchCal3':datamin},
			success: function(datas){
				$("#calDia3").val(datas.response);
			}
		});
	}

	function consultaCal4(){
		var header = window.location.href;
		var userid = $("#idConsulta").val();
		var datamin = userid + ';';
		$.ajax({
			url:'http://www.nutriologadelgado.com/frontend/web/action.php',
			//url:'http://localhost:8080/ProyectoNutriologa/public_html/frontend/web/action.php',
			type:'GET',
			dataType: 'json',
			data:{'searchCal4':datamin},
			success: function(datas){
				$("#calDia4").val(datas.response);
			}
		});
	}

	function consultaCal5(){
		var header = window.location.href;
		var userid = $("#idConsulta").val();
		var datamin = userid + ';';
		$.ajax({
			url:'http://www.nutriologadelgado.com/frontend/web/action.php',
			//url:'http://localhost:8080/ProyectoNutriologa/public_html/frontend/web/action.php',
			type:'GET',
			dataType: 'json',
			data:{'searchCal5':datamin},
			success: function(datas){
				$("#calDia5").val(datas.response);
			}
		});
	}
</script>
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;
?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel" >Grafica | <?= $model->nombres.' '.$model->apellidos ?></h4>
        </div>
        <div class="modal-body">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="graficaPaciente" data-chart="graficaPaciente" data-type="line" data-object="paciente" style="height: 400px;"></div>
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">        
                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-primary pull-right">Cerrar</button>
            </div><!-- /.box-footer -->
        </div>
    </div>
</div>

<script type="text/javascript">
    grayap.graficas.paciente ={
      // ID of the element in which to draw the chart.
      element: 'graficaPaciente',
      resize: true,
      data: [
      <?php for ($i=0; $i < count($model->consultas); $i++) {?>
        <?php if($model->consultas[$i]->idDatosAntropometricos===null) continue; ?>
        {
            y: '<?= ($i+1).' '.date('d M y') ?>', 
            masa: <?= $model->consultas[$i]->idDatosAntropometricos->imc ?>, 
            peso: <?= $model->consultas[$i]->idDatosAntropometricos->peso ?>, 
            grasa: <?= $model->consultas[$i]->idDatosAntropometricos->porciento_grasa ?>
        } <?= $i+1 == count($model->consultas) ? '' : ',' ?>
      <?php } ?>
      ],
      xkey: 'y',
      ykeys: ['masa','peso','grasa'],
      labels: ['Masa muscular','Peso','% Grasa'],
      lineColors: ['#f00','#0f0','#00f'],
      hideHover: 'auto'
    };
    //Enable charts in gryap.js
    grayap.initCharts(true);
</script>

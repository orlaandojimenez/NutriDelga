<?php

use yii\helpers\Html;

?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="window.location.reload()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Datos del paciente</h4>
            </div>
            <div class="modal-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#general" data-toggle="tab">General</a></li>
                        <?php if($model->id!=0){ ?>
                        <li><a href="#socieconomico" data-toggle="tab">Socieconomico </a></li>
                        <li><a href="#clinico" data-toggle="tab">Clinico</a></li>
                        <li><a href="#dietetico" data-toggle="tab">Dietetico</a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="general">
                        <div><?= $this->render('_modal_create.php',['model'=>$model],false,true) ?></div>
                    </div>
                    <?php if($model->id!=0){ ?>
                    <div class="tab-pane" id="socieconomico">
                        <div><?= $this->render('@app/views/socieconomico/_modal_create.php',['id_paciente'=>$model->id]) ?></div>
                    </div>
                    <div class="tab-pane" id="clinico">
                        <div><?= $this->render('@app/views/clinico/_modal_create.php',['id_paciente'=>$model->id]) ?></div>
                    </div>
                    <div class="tab-pane" id="dietetico">
                        <div><?= $this->render('@app/views/dietetico/_modal_create.php',['id_paciente'=>$model->id]) ?></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

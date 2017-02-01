<?php

use yii\helpers\Html;

?>
<div class="modal-dialog" role="document" style="width:40%">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" onclick="window.location.reload()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Nuevo Alimento</h4>
        </div>
        <div class="modal-body">
            <div class="alimento-create">
			    <?= $this->render('_form1', [
			        'model' => $model,
			        'isModal'=>true
			    ]) ?>
			</div>
        </div>
    </div>
</div>

<?php

use yii\helpers\Html;

?>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" onclick="window.location.reload()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Nuevo Platillo</h4>
        </div>
        <div class="modal-body">
            <div class="platillo-create">
			    <?= $this->render('_form', [
			        'model' => $model,
			        'ingredientes' => $ingredientes,
			        'dataProviderAlimentos' => $dataProviderAlimentos,
			        'isModal'=>true
			    ]) ?>
			</div>
        </div>
    </div>
</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Platillo */

$this->title = 'Nuevo Platillo';
$this->params['breadcrumbs'][] = ['label' => 'Platillos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="platillo-create">
    <?= $this->render('_form', [
        'model' => $model,
        'ingredientes' => $ingredientes,
        'dataProviderAlimentos' => $dataProviderAlimentos,
    ]) ?>
</div>
<?= $this->render('@app/views/modals/_modal_ingrediente_edit.php') ?>

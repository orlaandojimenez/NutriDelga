<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DatosBioquimicos */
/* @var $form ActiveForm */
?>

<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
	<?= $form->field($model, 'id',['options'=>['class'=>'']])->hiddenInput()->label(false) ?>
    <div class="row">
    	<div class="col-sm-12"><?= $form->field($model, 'reciente')->textArea(['rows'=>10]) ?></div>
    </div>
<?php ActiveForm::end(); ?>


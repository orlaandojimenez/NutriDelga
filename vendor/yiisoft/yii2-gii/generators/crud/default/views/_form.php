<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
		    <div class="box-header with-border">
			</div>
		    <?= "<?php " ?>$form = ActiveForm::begin(); ?>
		
			<div class="box-body">
			<?php foreach ($generator->getColumnNames() as $attribute) {
			    if (in_array($attribute, $safeAttributes)) {
			        echo "				<?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
			    }
			} ?>
			</div>
		    
		    <div class="box-footer">
		    	<div class="form-group">
		    	    <?= "<?= " ?>Html::submitButton($model->isNewRecord ? <?= $generator->generateString('Create') ?> : <?= $generator->generateString('Update') ?>, ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		    	</div>
		    </div>
		
		    <?= "<?php " ?>ActiveForm::end(); ?>
		</div>
	</div>
</div>
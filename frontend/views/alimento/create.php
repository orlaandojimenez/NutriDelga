<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Alimento */

$this->title = 'Nuevo Alimento';
$this->params['breadcrumbs'][] = ['label' => 'Alimentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alimento-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>

/*
function inputCheck(){
  if($("#alimento-adicional").val() == ''){
    $('.field-alimento-adicional').addClass('has-error');
    $('.field-alimento-adicional').children('.help-block').html('Adicional no puede estar vacío.');
  } else {
    if($('.field-alimento-adicional').hasClass('has-error')){
      $('.field-alimento-adicional').removeClass('has-error');
    }
    if($('.field-alimento-adicional').children('.help-block').html() !== ''){
      $('.field-alimento-adicional').children('.help-block').html('');
    }
    $('.field-alimento-adicional').addClass('has-success');
  }
}
*/

function updateAlimento(){
  inputCheck();
  var adicional = $("#alimento-adicional").val();
  var falta = false;
  $('input').each(function()
  {
    if(!$(this).val()){
        falta = true;
      }
  });
  if(falta === false){

    $.ajax({
      url:'/frontend/web/update.php',
      type:'POST',
      dataType:'json',
      cache:false,
      data:{'adicional':adicional},
    });

    return true;

  }
  else {
    return false;
  }

}

$(document).ready(function () {
  $('form').submit(function(event){
    if(updateAlimento()){
          return true;
         }
         else {
          event.preventDefault();
            return false;
        }
     });

$("#alimento-adicional").focusout(function(){
  inputCheck();
 });

});
</script>

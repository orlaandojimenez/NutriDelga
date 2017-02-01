<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

$page= str_replace('/frontend/web/', '', $_SERVER['REQUEST_URI']);
$pages = array('usuarios');

if(strpos($page, '?')):
list($page, $get) = explode("?", $page);
list($getKey, $getValue) = explode('=', $get);
endif;

?>
<div class="content-wrapper">
    <section class="content-header">

      <?php if(!in_array($page, $pages)): ?>
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo \yii\helpers\Html::encode($this->title);
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php } ?>

        <?=
      Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
      <?php endif;?>
    </section>

    <section class="content">
        <?= Alert::widget() ?>

        <?php
        if(in_array($page, $pages)):
          $page = "../views/$page/index.php";
          if (file_exists($page)):
            include $page;
          else:
            echo "<h1>Error 404</h1>";
          endif;
        else:
          echo $content;
        endif;
         ?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Versión</b> 1.0
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> <a href="<?= Yii::$app->getUrlManager()->getBaseUrl()?>/"><?= Yii::$app->name ?></a>.</strong> Todos los derechos reservados.    
</footer>

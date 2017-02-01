<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
$len = (int)strlen(Yii::$app->name) / 2;
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini"><b>'.substr(Yii::$app->name, 0,$len/2).'</b>'.substr(Yii::$app->name,$len/2,$len-$len%2).'</span><span class="logo-lg"><b>' . substr(Yii::$app->name, 0,$len) . '</b>'.substr(Yii::$app->name,$len).'</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs text-capitalize"><?=  strtolower(explode(" ",Yii::$app->user->identity->nombre)[0]." ".explode(" ",Yii::$app->user->identity->apellidos)[0]) ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <span class="text-capitalize"><?= strtolower(Yii::$app->user->identity->nombre.' '.Yii::$app->user->identity->apellidos) ?></span>
                                <small>Miembro desde <?= date('M. Y', Yii::$app->user->identity->created_at) ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

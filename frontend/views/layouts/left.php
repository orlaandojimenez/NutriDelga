<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">            
                <img src="<?= $directoryAsset ?>/img/<?= Yii::$app->user->identity->path_img_perfil ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><span class="text-capitalize"><?= strtolower(Yii::$app->user->identity->nombres.' '.Yii::$app->user->identity->apellidos) ?></span></p>
                <!--a href="#"><i class="fa fa-circle text-success"></i> En linea</a-->
            </div>
        </div>

        <!-- search form -->
        <!--form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form-->
        <!-- /.search form -->

        <?php

        $menu =   [
              'options' => ['class' => 'sidebar-menu'],
              'items' => [
                  ['label' => 'Menú principal', 'options' => ['class' => 'header']],
                  ['label' => 'Pacientes', 'icon' => 'fa fa-users', 'url' => ['/paciente']],                  
                  ['label' => 'Alimentos', 'icon' => 'fa fa-apple', 'url' => ['/alimento']],
                  ['label' => 'Platillos', 'icon' => 'fa fa-cutlery', 'url' => ['/platillo']],
                  
                  
              ]];

          
        if(Yii::$app->user->identity->admin > 0):
          array_push($menu['items'], ['label' => 'Usuarios', 'icon' => 'fa fa-user', 'url' => ['/usuarios']]);
        endif;

        echo  dmstr\widgets\Menu::widget($menu) ?>

    </section>

</aside>

<?php
namespace dmstr\web;

use yii\base\Exception;
use yii\web\AssetBundle as BaseAdminLteAsset;

/**
 * AdminLte AssetBundle
 * @author Rubi Luna
 * @since 0.1
 */
class DataTablesAsset extends BaseAdminLteAsset
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/datatables';
    public $css = [
        'dataTables.bootstrap.css',
    ];
    public $js = [
        'jquery.dataTables.min.js',
        'dataTables.bootstrap.min.js',
        'extensions/Responsive/js/dataTables.responsive.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}

<?php
namespace dmstr\web;

use yii\base\Exception;
use yii\web\AssetBundle as BaseAdminLteAsset;

/**
 * AdminLte AssetBundle
 * @author Rubi Luna
 * @since 0.1
 */
class DatePickerAsset extends BaseAdminLteAsset
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/datepicker';
    public $css = [
        'datepicker3.css',
    ];
    public $js = [
        'bootstrap-datepicker.js',
        'locales/bootstrap-datepicker.es.js',
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

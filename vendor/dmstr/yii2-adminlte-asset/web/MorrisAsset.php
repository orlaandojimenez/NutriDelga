<?php
namespace dmstr\web;

use yii\base\Exception;
use yii\web\AssetBundle as BaseAdminLteAsset;

/**
 * AdminLte AssetBundle
 * @author Rubi Luna
 * @since 0.1
 */
class MorrisAsset extends BaseAdminLteAsset
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/morris';
    public $css = [
        'morris.css',
    ];
    public $js = [
        'raphael-min.js',
        'morris.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}

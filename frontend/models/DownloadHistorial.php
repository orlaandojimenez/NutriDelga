<?php

namespace frontend\models;

use Yii;


/**
 * DownloadHistorial Model
 */
class DownloadHistorial extends \yii\base\Model
{
    public $fecha_fin;
    public $fecha_ini;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_ini', 'fecha_fin'], 'required'],
            [['fecha_fin', 'fecha_fin'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fecha_ini' => 'Fecha inicio',
            'fecha_fin' => 'Fecha final',
        ];
    }

}

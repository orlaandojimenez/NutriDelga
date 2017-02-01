<?php

namespace frontend\models;

use Yii;


/**
 * This is the model class for table "{{%sintomas_signos}}".
 *
 * @property integer $id
 * @property string $apetito
 * @property string $estrenimiento
 * @property string $pirosis
 * @property string $distencion
 * @property string $vomito
 * @property string $piel
 * @property string $unas
 * @property string $cabello
 * @property string $mareos
 * @property string $cefalea
 * @property string $observaciones
 * @property Consulta[] $consultas
 * @property HistorialClinico[] $historialClinicos
 */
class SintomasSignos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sintomas_signos}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apetito', 'estrenimiento', 'pirosis', 'distencion', 'vomito', 'piel', 'unas', 'cabello', 'mareos', 'cefalea'], 'required'],
            [['observaciones'], 'string', 'max' => 1000],
            [['apetito'], 'string', 'max' => 25],
            [['estrenimiento'], 'string', 'max' => 23],
            [['pirosis', 'distencion', 'vomito', 'piel', 'unas', 'cabello', 'mareos', 'cefalea'], 'string', 'max' => 22],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'apetito' => 'Apetito',
            'estrenimiento' => 'Estreñimiento',
            'pirosis' => 'Pirosis',
            'distencion' => 'Distención',
            'vomito' => 'Vomito',
            'piel' => 'Piel',
            'unas' => 'Uñas',
            'cabello' => 'Cabello',
            'mareos' => 'Mareos',
            'cefalea' => 'Cefalea',
            'observaciones' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConsultas()
    {
        return $this->hasMany(Consulta::className(), ['id_sintomas_signos' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialClinicos()
    {
        return $this->hasMany(HistorialClinico::className(), ['id_sintomas' => 'id']);
    }
}

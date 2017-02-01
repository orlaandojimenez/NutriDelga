<?php

namespace frontend\models;

use Yii;


/**
 * This is the model class for table "{{%cantidades}}".
 *
 * @property integer $id
 * @property integer $id_recordatorio
 * @property string $desayuno
 * @property string $colacion_desayuno
 * @property string $comida
 * @property string $colacion_comida
 * @property string $cena
 * @property string $otros
 * @property integer $tipo
 *
 * @property Recordatorio $idRecordatorio
 */
class Cantidades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cantidades}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_recordatorio', 'tipo'], 'integer'],
            [['desayuno', 'colacion_desayuno', 'comida', 'colacion_comida', 'cena', 'otros'], 'required'],
            [['desayuno', 'colacion_desayuno', 'comida', 'colacion_comida', 'cena', 'otros'], 'number'],
            [['id_recordatorio'], 'exist', 'skipOnError' => true, 'targetClass' => Recordatorio::className(), 'targetAttribute' => ['id_recordatorio' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_recordatorio' => 'Id Recordatorio',
            'desayuno' => 'Desayuno',
            'colacion_desayuno' => 'Colación',
            'comida' => 'Comida',
            'colacion_comida' => 'Colación',
            'cena' => 'Cena',
            'otros' => 'Otros',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRecordatorio()
    {
        return $this->hasOne(Recordatorio::className(), ['id' => 'id_recordatorio']);
    }
}

<?php

namespace frontend\models;

use Yii;


/**
 * This is the model class for table "{{%platillo_alimento}}".
 *
 * @property integer $id
 * @property integer $id_platillo
 * @property integer $id_alimento
 * @property integer $cantidad
 * @property integer $cantidad_calorica
 *
 * @property Alimento $idAlimento
 * @property Platillo $idPlatillo
 */
class PlatilloAlimento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%platillo_alimento}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_platillo', 'id_alimento'], 'integer'],
            [['cantidad_calorica', 'cantidad'], 'required'],
            [['id_alimento'], 'exist', 'skipOnError' => true, 'targetClass' => Alimento::className(), 'targetAttribute' => ['id_alimento' => 'id']],
            [['id_platillo'], 'exist', 'skipOnError' => true, 'targetClass' => Platillo::className(), 'targetAttribute' => ['id_platillo' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_platillo' => 'Id Platillo',
            'id_alimento' => 'Id Alimento',
            'cantidad' => 'Cantidad',
            'cantidad_calorica' => 'Cantidad Calórica',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAlimento()
    {
        return $this->hasOne(Alimento::className(), ['id' => 'id_alimento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPlatillo()
    {
        return $this->hasOne(Platillo::className(), ['id' => 'id_platillo']);
    }
}

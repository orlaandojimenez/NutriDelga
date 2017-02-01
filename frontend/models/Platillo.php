<?php

namespace frontend\models;

use Yii;


/**
 * This is the model class for table "{{%platillo}}".
 *
 * @property integer $id
 * @property integer $id_nutriologo
 * @property string $nombre
 * @property string $cantidad
 * @property string $preparacion
 *
 * @property Dieta[] $dietas
 * @property Menu[] $menus
 * @property Nutriologo $idNutriologo
 * @property PlatilloAlimento[] $platilloAlimentos
 * @property Preparacion[] $preparacions
 */
class Platillo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%platillo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_nutriologo'], 'integer'],
            [['nombre', 'cantidad', 'preparacion'], 'required'],
            [['preparacion'], 'string'],
            [['nombre'], 'string', 'max' => 25],
            [['cantidad'], 'string', 'max' => 11],
            [['id_nutriologo'], 'exist', 'skipOnError' => true, 'targetClass' => Nutriologo::className(), 'targetAttribute' => ['id_nutriologo' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_nutriologo' => 'Id Nutriologo',
            'nombre' => 'Nombre',
            'cantidad' => 'Cantidad',
            'preparacion' => 'Preparación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDietas()
    {
        return $this->hasMany(Dieta::className(), ['id_platillo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['id_platillo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdNutriologo()
    {
        return $this->hasOne(Nutriologo::className(), ['id' => 'id_nutriologo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlatilloAlimentos()
    {
        return $this->hasMany(PlatilloAlimento::className(), ['id_platillo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreparacions()
    {
        return $this->hasMany(Preparacion::className(), ['id_platillo' => 'id']);
    }
}

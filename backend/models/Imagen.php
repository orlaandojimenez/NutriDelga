<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ga_imagen".
 *
 * @property integer $id
 * @property string $small_url
 * @property string $medium_url
 * @property string $large_url
 *
 * @property Usuario[] $usuarios
 */
class Imagen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ga_imagen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['small_url', 'medium_url', 'large_url'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'small_url' => 'Small Url',
            'medium_url' => 'Medium Url',
            'large_url' => 'Large Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['id_imagen' => 'id']);
    }
}

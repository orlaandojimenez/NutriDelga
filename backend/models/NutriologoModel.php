<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%nutriologo}}".
 *
 * @property integer $id
 * @property string $nombres
 * @property string $apellidos
 * @property string $email
 * @property string $password
 * @property string $path_img_perfil
 * @property string $fecha_nacimiento
 * @property integer $sexo
 * @property string $password_reset_token
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $auth_key
 *
 * @property Paciente[] $pacientes
 */
class NutriologoModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%nutriologo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombres', 'apellidos', 'email', 'password',], 'required'],
            [['fecha_nacimiento'], 'safe'],
            [['sexo', 'status',], 'integer'],
            [['nombres', 'apellidos', 'email'], 'string', 'max' => 50],
            [['password', 'password_reset_token',], 'string', 'max' => 150],
            [['path_img_perfil'], 'string', 'max' => 100],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombres' => 'Nombre',
            'apellidos' => 'Apellidos',
            'email' => 'Correo',
            'password' => 'Contraseña',
            'path_img_perfil' => 'Path Img Perfil',
            'fecha_nacimiento' => 'Fecha de Nacimiento',
            'sexo' => 'Sexo',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Estatus',
            'created_at' => 'Creado el',
            'updated_at' => 'Actualizado el',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPacientes()
    {
        return $this->hasMany(Paciente::className(), ['id_nutriologo' => 'id']);
    }
}

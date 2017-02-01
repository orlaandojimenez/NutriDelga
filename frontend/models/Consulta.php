<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%consulta}}".
 *
 * @property integer $id
 * @property integer $id_paciente
 * @property integer $id_datos_antropometricos
 * @property integer $id_datos_bioquimicos
 * @property integer $id_estilo_vida
 * @property integer $id_intervencion
 * @property integer $id_sintomas_signos
 * @property integer $id_recordatorio
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property DatosAntropometricos $idDatosAntropometricos
 * @property DatosBioquimicos $idDatosBioquimicos
 * @property EstiloVida $idEstiloVida
 * @property Intervencion $idIntervencion
 * @property Paciente $idPaciente
 * @property Recordatorio $idRecordatorio
 * @property SintomasSignos $idSintomasSignos
 * @property Dieta[] $dietas
 */
class Consulta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%consulta}}';
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
    public function rules()
    {
        return [
            [['id_paciente'], 'required'],
            [['id_paciente', 'id_datos_antropometricos', 'id_datos_bioquimicos', 'id_estilo_vida', 'id_intervencion', 'id_sintomas_signos', 'id_recordatorio', 'created_at', 'updated_at'], 'integer'],
            [['observaciones'], 'string','max'=>1000],
            [['id_datos_antropometricos'], 'exist', 'skipOnError' => true, 'targetClass' => DatosAntropometricos::className(), 'targetAttribute' => ['id_datos_antropometricos' => 'id']],
            [['id_datos_bioquimicos'], 'exist', 'skipOnError' => true, 'targetClass' => DatosBioquimicos::className(), 'targetAttribute' => ['id_datos_bioquimicos' => 'id']],
            [['id_estilo_vida'], 'exist', 'skipOnError' => true, 'targetClass' => EstiloVida::className(), 'targetAttribute' => ['id_estilo_vida' => 'id']],
            [['id_intervencion'], 'exist', 'skipOnError' => true, 'targetClass' => Intervencion::className(), 'targetAttribute' => ['id_intervencion' => 'id']],
            [['id_paciente'], 'exist', 'skipOnError' => true, 'targetClass' => Paciente::className(), 'targetAttribute' => ['id_paciente' => 'id']],
            [['id_recordatorio'], 'exist', 'skipOnError' => true, 'targetClass' => Recordatorio::className(), 'targetAttribute' => ['id_recordatorio' => 'id']],
            [['id_sintomas_signos'], 'exist', 'skipOnError' => true, 'targetClass' => SintomasSignos::className(), 'targetAttribute' => ['id_sintomas_signos' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_paciente' => 'Id Paciente',
            'id_datos_antropometricos' => 'Id Datos Antropometricos',
            'id_datos_bioquimicos' => 'Id Datos Bioquimicos',
            'id_estilo_vida' => 'Id Estilo Vida',
            'id_intervencion' => 'Id Intervencion',
            'id_sintomas_signos' => 'Id Sintomas Signos',
            'id_recordatorio' => 'Id Recordatorio',
            'observaciones' => 'Observaciones',
            'created_at' => 'Creada el',
            'updated_at' => 'Actualizada el',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDatosAntropometricos()
    {
        return $this->hasOne(DatosAntropometricos::className(), ['id' => 'id_datos_antropometricos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDatosBioquimicos()
    {
        return $this->hasOne(DatosBioquimicos::className(), ['id' => 'id_datos_bioquimicos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstiloVida()
    {
        return $this->hasOne(EstiloVida::className(), ['id' => 'id_estilo_vida']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdIntervencion()
    {
        return $this->hasOne(Intervencion::className(), ['id' => 'id_intervencion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPaciente()
    {
        return $this->hasOne(Paciente::className(), ['id' => 'id_paciente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRecordatorio()
    {
        return $this->hasOne(Recordatorio::className(), ['id' => 'id_recordatorio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSintomasSignos()
    {
        return $this->hasOne(SintomasSignos::className(), ['id' => 'id_sintomas_signos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDietas()
    {
        return $this->hasMany(Dieta::className(), ['id_consulta' => 'id']);
    }
}

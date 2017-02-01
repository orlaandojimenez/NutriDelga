<?php
/**
 * @author Rubi Lorena
 */
namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use frontend\models\DatosClinicos;


class ClinicoController extends \yii\web\Controller
{

	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [                        
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],            
        ];
    }

    /**
     * Create relation of paciente with clinico
     * @return Render view
     */
    public function actionAdd($id)
    {
        $paciente = $this->findModelPaciente($id);

        if($paciente->idDatosClinicos === null)
            $model = new DatosClinicos();
        else
            $model = $paciente->idDatosClinicos;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $paciente->id_datos_clinicos = $model->id;
            $paciente->save();
            Yii::$app->session->setFlash('success', '<i class="icon fa fa-check"></i>Datos clinicos actualizados correctamente.');
            if(Yii::$app->request->isAjax){
                return $this->renderPartial('_modal_create',[
                        'model' => $model,
                        'id_paciente' => $id,
                ],true,true); 
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if(Yii::$app->request->isAjax){
                return $this->renderPartial('_modal_create',[
                        'model' => $model,
                        'id_paciente' => $id,
                ],true,true); 
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    protected function findModelPaciente($id)
    {
        if (($model = \frontend\models\Paciente::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

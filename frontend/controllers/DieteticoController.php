<?php
/**
 * @author Rubi Lorena
 */
namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use frontend\models\DatosDieteticos;

class DieteticoController extends \yii\web\Controller
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

    public function actionAdd($id)
    {
        $paciente = $this->findModelPaciente($id);

        if($paciente->idDatosDieteticos === null)
            $model = new DatosDieteticos();
        else
            $model = $paciente->idDatosDieteticos;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $paciente->id_datos_dieteticos = $model->id;
            $paciente->save();
            Yii::$app->session->setFlash('success', '<i class="icon fa fa-check"></i>Datos dieteticos actualizados correctamente.');
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

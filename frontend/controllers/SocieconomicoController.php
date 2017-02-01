<?php
/**
 * @author Rubi Lorena
 */
namespace frontend\controllers;

use Yii;
use frontend\models\DatosSocieconomicos;
use frontend\models\SocieconomicoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SocieconomicoController implements the CRUD actions for DatosSocieconomicos model.
 */
class SocieconomicoController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionAdd($id){
        $paciente = $this->findModelPaciente($id);

        if($paciente->idDatosSocieconomicos === null)
            $model = new DatosSocieconomicos();
        else
            $model = $paciente->idDatosSocieconomicos;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $paciente->id_datos_socieconomicos = $model->id;
            $paciente->save();
            Yii::$app->session->setFlash('success', '<i class="icon fa fa-check"></i>Datos socieconomicos actualizados correctamente.');
            if(Yii::$app->request->isAjax){
                return $this->renderPartial('_modal_create',[
                        'model' => $model,
                        'id_paciente' => $id,
                ]); 
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if(Yii::$app->request->isAjax){
                return $this->renderPartial('_modal_create',[
                        'model' => $model,
                        'id_paciente' => $id,
                ]); 
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

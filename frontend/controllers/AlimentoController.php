<?php
/**
 * @author Rubi Lorena
 */
namespace frontend\controllers;

use Yii;
use frontend\models\Alimento;
use frontend\models\AlimentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AlimentoController implements the CRUD actions for Alimento model.
 */
class AlimentoController extends Controller
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

    /**
     * Lists all Alimento models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlimentoSearch();
        $request = Yii::$app->request->queryParams;
        $request['AlimentoSearch']['id_nutriologo'] = Yii::$app->user->identity->id;
        $dataProvider = $searchModel->search($request);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Alimento model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Alimento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Alimento();
        $model->id_nutriologo = Yii::$app->user->identity->id;

        if(Yii::$app->request->isAjax){
            return $this->renderPartial('_modal_create', [
                'model' => $model,
            ]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Alimento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Alimento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {//desactivo las llaves foraneas, elimino el registro, y luego las vuelvo a activar.
        $db = Yii::$app->db;
        $db->createCommand('set FOREIGN_KEY_CHECKS = 0;')->execute();
        $this->findModel($id)->delete();
        $db->createCommand('set FOREIGN_KEY_CHECKS = 1;')->execute();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Alimento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Alimento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Alimento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

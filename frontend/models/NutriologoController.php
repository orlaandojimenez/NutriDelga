<?php

namespace frontend\models;

use Yii;
use yii\filters\AccessControl;

class NutriologoController extends \yii\web\Controller
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

    public function actionChangePassword()
    {
        return $this->render('change-password');
    }

    public function actionPerfil()
    {
        return $this->render('perfil');
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

}

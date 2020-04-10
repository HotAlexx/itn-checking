<?php

namespace app\controllers;

use app\models\ItnForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        var_dump(Yii::$app->fnsapi->checkSelfemployed('4444')); die();

        $model = new ItnForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            Yii::$app->session->setFlash('success', "Код успешно отправлен на проверку!");

            return $this->refresh();
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }

}

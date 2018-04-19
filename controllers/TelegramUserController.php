<?php

namespace webstik\telegramNotifications\controllers;

use Yii;
use webstik\telegramNotifications\models\TelegramUser;
use webstik\telegramNotifications\models\TelegramUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TelegramUserController implements the CRUD actions for TelegramUser model.
 */
class TelegramUserController extends Controller
{

    /**
     * Lists all TelegramUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TelegramUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }

    public function actionStatus($id)
    {
        $model = $this->findModel($id);
        if ($model->is_allowed == 0) {
            $model->is_allowed = 1;
            $model->allowed_by = Yii::$app->user->id;
            $model->allowed_at = date("Y-m-d H:i:s");
            $model->save();
            return $this->redirect(['index']);
        }

        $model->is_allowed = 0;
        $model->allowed_by = null;
        $model->allowed_at = null;
        $model->save();
        return $this->redirect(['index']);
    }



    /**
     * Finds the TelegramUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TelegramUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TelegramUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

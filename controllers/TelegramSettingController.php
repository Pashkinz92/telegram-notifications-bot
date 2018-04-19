<?php

namespace webstik\telegramNotifications\controllers;

use Yii;
use webstik\telegramNotifications\models\TelegramSettings;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * TelegramSettingController implements the CRUD actions for TelegramSettings model.
 */
class TelegramSettingController extends Controller
{
    private $telegram_set_id = 1;
    /**
     * Lists all TelegramSettings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = $this->findModel($this->telegram_set_id);
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionUpdate()
    {
        $model = $this->findModel($this->telegram_set_id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Finds the TelegramSettings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TelegramSettings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TelegramSettings::findOne($id)) !== null) {
            return $model;
        } else {
            return new TelegramSettings(['id' => $this->telegram_set_id]);
        }
    }
}

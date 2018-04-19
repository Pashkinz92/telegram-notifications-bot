<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Telegram Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telegram-settings-index box box-primary ">
    <div class="box-header">
        <p>
            <?= Html::a(Yii::t('app', 'Update'), ['update'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'webhook_url:url',
                //'do_logs',
                'token',
                'PIN_code',
            ],
        ]) ?>
    </div>
</div>

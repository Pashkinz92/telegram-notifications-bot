<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TelegramSettings */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => '',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Telegram Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="review-update box box-primary ">


    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>

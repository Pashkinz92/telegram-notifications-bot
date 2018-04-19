<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TelegramUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Telegram Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="telegram-user-index box box-primary ">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
   <!-- <div class="box-header">
        <p>
            <?/*= Html::a(Yii::t('app', 'Create Telegram User'), ['create'], ['class' => 'btn btn-success']) */?>
        </p>
    </div>-->
    <div class="box-body">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'chat_id',
            'first_name',
            'last_name',
            'username',
            // 'created_at',
            // 'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Статус',
                'template' => '{status}',
                'buttons' => [
                    'status' => function ($url, $model) {
                        if ($model->is_allowed == 0) {
                            return Html::a('<span class="label label-danger">Не допущен</span>', $url);
                        }
//                            return '<span class="label label-success">Approved</span>';
                        return Html::a('<span class="label label-success">Допущен</span>', $url);
                    },
                ],
            ],

//             'allowed_by',
//             'allowed_at',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
</div>

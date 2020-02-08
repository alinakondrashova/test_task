<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\db\Query;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <ul>
        <?php
        foreach ($categories as $category) : ?>
            <li>
                <a href="#"><?= $category->title ?></a>
                <span> <?= $category->getTasks()->count(); ?> </span>
            </li>
        <?php endforeach; ?>

    </ul>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             'title',
            [
                'attribute' => 'category',
                'value' => function($task){
                    $category_id=$task->category_id;
                    $query=Category::find()
                        ->select('title')
                        ->from('category') 
                        ->where(['id'=>$category_id])
                        ->one();
                    return $query->title;
                }
            ],
            [
                'attribute' => 'date',
                'format' => ['date', 'dd/MM/yyyy']
            ],
            'comments_count',
            ['class' => 'yii\grid\ActionColumn'],
        ],

    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'title',
            'category_id',
            'date',
            'comments_count',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
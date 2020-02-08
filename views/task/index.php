<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\db\Query;
use app\models\Category;
use app\models\Comment;

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
        //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
                'attribute' => 'category',
                'value' => function ($task) {
                    $category_id = $task->category_id;
                    $query = Category::find()
                        ->select('title')
                        ->from('category')
                        ->where(['id' => $category_id])
                        ->one();
                    return $query->title;
                }
            ],
            [
                'attribute' => 'date',
                'format' => ['date', 'dd/MM/yyyy']
            ],
            [
                'attribute' => 'comments_count',
                'value' => function ($task) {
                    $count_id = $task->id;
                    $query = Comment::find()
                        ->where(['task_id' => $count_id])
                        ->count();;
                    return $query;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],

    ]); ?>
    

</div>
<button onclick="convertToJSON()">Convert</button>
<button onclick="saveToFile()">Save</button>
<textarea id="output" style="visibility:hidden;"></textarea>

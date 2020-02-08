<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">
    <h4>Category: <?= $task->category->title ?> </h4>
    <h4>Created on <?= Yii::$app->formatter->asDate($task->date, 'long') ?> </h4>

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Set Category', ['set-category', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <br>
    <?php
    $form = \yii\widgets\ActiveForm::begin([
        'action' => [
            'task/comment',
            'id' => $task->id
        ],
        'options' => ['role' => 'form']
    ]) ?>
    <div class="form-group">
        <?= $form->field($commentForm, 'comment')->textarea(['class' => 'form-control', 'placeholder' => 'Write your comment'])->label(false); ?>
    </div>

    
    <button type="submit" class="btn btn-outline-primary">Post comment</button>
    <?php
    $form = \yii\widgets\ActiveForm::end(); ?>
    <?php if (!empty($comments)) : ?>

        <?php foreach ($comments as $comment) : ?>
            <br>

            <div class="container bg-info">
                <p>Comment
                    <div class="bg-primary">
                        <h4><?= $comment->text; ?></h4>
                    </div>

            </div>
            <hr>

        <?php endforeach; ?>


    <?php endif; ?>
</div>
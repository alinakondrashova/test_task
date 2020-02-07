<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

?>
<div class="task-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= Html::dropDownList('category', $selectedCategory, $categories, ['class' => 'form-controller']) ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
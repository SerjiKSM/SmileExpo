<?php

use app\models\CategoryForm;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$model = new CategoryForm();
?>

<?php $form = ActiveForm::begin(['options' => ['action' => '', 'method' => 'post','name' => 'form-update', 'class' => 'class-update']]);?>

    <?= $form->field($model, 'name')?>
    <?= $form->field($model, 'description')?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success'])?>
    </div>

<?php $form = ActiveForm::end();?>

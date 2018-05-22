<?php

    use app\models\CategoryForm;
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;

    $model = new CategoryForm();
?>

<?php $form = ActiveForm::begin(['options' => ['action' => '', 'method' => 'post','name' => 'form-update', 'class' => 'class-update']]);?>

    <?= $form->field($model, 'name')->textInput(['value' => $category->title])?>
    <?= $form->field($model, 'description')->textarea(['value' => $category->description])?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success'])?>
    </div>

<?php $form = ActiveForm::end();?>

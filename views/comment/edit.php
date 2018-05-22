<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\CommentForm;
use yii\widgets\ActiveForm;
use \kartik\datetime\DateTimePicker;

$model = new CommentForm();

?>

<?php Pjax::begin(); ?>

<?php $form = ActiveForm::begin(['options' => ['action' => 'comment/edit', 'method' => 'post','name' => 'form-create-comment', 'class' => 'class-create-comment']]);?>

<?= $form->field($model, 'fieldDate')->widget(DateTimePicker::className(),[
    'name' => 'dp_1',
    'type' => DateTimePicker::TYPE_INPUT,
    'options' => ['placeholder' => 'Ввод даты/времени...', 'value' => $comment->date],
    'convertFormat' => true,
    'value'=> date("Y-m-d",(integer) $model->fieldDate),
    'pluginOptions' => [
        'format' => 'yyyy-MM-dd',
        'autoclose'=>true,
        'weekStart'=>1, //неделя начинается с понедельника
        'startDate' => '01.05.2015 00:00', //самая ранняя возможная дата
        'todayBtn'=>true, //снизу кнопка "сегодня"
    ]
]);?>

<?= $form->field($model, 'user')->textInput(['value' => $comment->user])?>

<?= $form->field($model, 'email')->textInput(['value' => $comment->email])?>

<?= $form->field($model, 'comment')->textarea(['value' => $comment->comment])?>

<?= $form->field($model, 'product')->dropDownList($productItems, $productParams)?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success'])?>
    </div>

<?php $form = ActiveForm::end();?>

<?php Pjax::end(); ?>
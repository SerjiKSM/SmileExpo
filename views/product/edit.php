<?php

use yii\helpers\Html;
//use yii\widgets\Pjax;
use app\models\ProductForm;
use yii\widgets\ActiveForm;
use app\models\UploadImageForm;

$productFormModel = new ProductForm();

?>

<?php //Pjax::begin(); ?>

    <?php $form = ActiveForm::begin(['options' => ['action' => '', 'method' => 'post','name' => 'form-update-product', 'class' => 'class-update-product']]);?>

        <?= $form->field($productFormModel, 'name')->textInput(['value' => $product->title])?>

        <?= $form->field($productFormModel, 'category')->dropDownList($categoryItems, $categoryParams, ['options' => [4 => ['selected' => true]]])?>

        <?= $form->field($productFormModel, 'description')->textarea(['value' => $product->description])?>
        <?= $form->field($productFormModel, 'cost')->textInput(['value' => $product->cost])?>

        <?= $form->field($productFormModel, 'image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success'])?>
    </div>

<?php $form = ActiveForm::end();?>

<?php //Pjax::end(); ?>
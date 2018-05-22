<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\ProductForm;
use yii\widgets\ActiveForm;

$productFormModel = new ProductForm();

?>

<?php Pjax::begin(); ?>

    <?php $form = ActiveForm::begin(['options' => ['action' => 'product/create-product', 'method' => 'post','name' => 'form-create-product', 'class' => 'class-create-product']]);?>

        <?= $form->field($productFormModel, 'name')?>

        <?= $form->field($productFormModel, 'category')->dropDownList($categoryItems, $categoryParams)?>

        <?= $form->field($productFormModel, 'description')?>
        <?= $form->field($productFormModel, 'cost')?>

        <?= $form->field($productFormModel, 'image')->fileInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Create', ['class' => 'btn btn-success'])?>
        </div>

    <?php $form = ActiveForm::end();?>

<?php Pjax::end(); ?>
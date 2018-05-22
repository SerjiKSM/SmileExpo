<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$script_3 = <<< JS
//    $('.update-products').click(function () {
//        console.log(22222222);
//    });
JS;
$this->registerJs($script_3);

$this->registerCssFile("/css/style.css");

$this->title = Yii::t('main', 'product_catalog');

?> 
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Yii::t('main', 'product_catalog')?></h1>

    </div>

    <?php if(Yii::$app->session->hasFlash('message')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="container content">

        <hr>

        <a href="/category/create" title="Create" aria-label="Create" class='btn btn-success'>
            <?= Yii::t('main', 'create_category')?>
        </a>

        <a href="/product/create-product" title="Create" aria-label="Create" class='btn btn-success'>
            <?= Yii::t('main', 'create_product')?>
        </a>

        <a href="/comment/create-comment" title="Create" aria-label="Create" class='btn btn-success'>
            <?= Yii::t('main', 'create_comment')?>
        </a>

        <a href="/comment/view-comment" title="View" aria-label="View" class='view-comment btn btn-success'>
            <?= Yii::t('main', 'view_comment')?>
        </a>

        <hr>

        <div class="row">
            <div class="col-md-4">
                <div class="list-group">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="3"><?= Yii::t('main', 'categories')?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (count($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <tr>
                                    <td>
                                        <?php Pjax::begin(); ?>
                                        <a href="/category/category-products?id=<?= Html::encode("$category->id")?>" class="list-group-item" data-pjax="0">
                                            <?= Html::encode("$category->title")?>
                                        </a>
                                        <?php Pjax::end(); ?>
                                    </td>
                                    <td>
                                        <a id="modalButton" href="/category/edit?id=<?= Html::encode("$category->id")?>" title="Update" aria-label="Update" data-pjax="0">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/category/delete?id=<?= Html::encode("$category->id")?>" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-info">
                                <span>Категорий нет!</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-8 products">

                <div class="row">
                    <?php if (count($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <div class="col-sm-4">
                                <div class="product">
                                    <div class="product-img">
                                        <a href="#">
                                            <img src="<?php echo Yii::$app->request->baseUrl; ?>/img/<?= Html::encode("$product->path_photo")?>" alt="<?= Html::encode("$product->path_photo")?>">
                                        </a>
                                    </div>
                                    <p class="product-title">
                                        <?= Html::encode("$product->title")?>
                                    </p>
                                    <p class="product-desc"><?= Html::encode("$product->description")?></p>
                                    <p class="product-price">Price: <?= Html::encode("$product->cost")?></p>

                                    <p>
                                        <a id="modalButton" href="/product/edit?id=<?= Html::encode("$product->id")?>" title="Update" aria-label="Update" data-pjax="0" class='btn btn-success'>
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>

                                        <a href="/product/delete?id=<?= Html::encode("$product->id")?>" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post" class='btn btn-success'>
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </p>

                                </div>

                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <span>По этой категории товаров нет!</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
            </div>
        </div>
    </div>

</div>



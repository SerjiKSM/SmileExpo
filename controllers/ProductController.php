<?php

namespace app\controllers;

use app\models\Product;
use app\models\ProductForm;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use app\models\Category;
use Yii;

class ProductController extends Controller
{
    public function actionCreateProduct()
    {
        if (Yii::$app->request->isPost){
            $productForm = new ProductForm();
            $productForm->createProduct();

            return $this->redirect(['/']);
        }

        $categories = Category::find()->all();
        $categoryItems = ArrayHelper::map($categories,'id','title');

        $categoryParams = [
            'prompt' => 'Укажите категорию!'
        ];

        return $this->render('create', [
            'categoryItems' => $categoryItems,
            'categoryParams' => $categoryParams,
        ]);

    }

    public function actionDelete()
    {
        $idProduct = (Yii::$app->request->get()['id'] > 0 ? intval(Yii::$app->request->get()['id']) : 0 );
        $product = Product::find()->where(['id' => $idProduct])->one();

        if ($product->delete()){
            Yii::$app->session->setFlash('message', 'Продукт удален успешно!');
        }

        return $this->redirect(['/']);

    }

    public function actionEdit()
    {

        if (Yii::$app->request->isPost){
            $idProduct = (Yii::$app->request->get()['id'] > 0 ? intval(Yii::$app->request->get()['id']) : 0 );
            $product = Product::find()->where(['id' => $idProduct])->one();

            $model = new ProductForm();
            if($model->load(Yii::$app->request->post()) && $model->saveProduct($product)){
                Yii::$app->session->setFlash('message', 'Продукт отредактирован успешно!');

                return $this->redirect(['/']);
            }
        }

        $idProduct = (Yii::$app->request->get()['id'] > 0 ? intval(Yii::$app->request->get()['id']) : 0 );
        $product = Product::find()->where(['id' => $idProduct])->one();

        $categories = Category::find()->all();
        $categoryItems = ArrayHelper::map($categories,'id','title');

        $categoryParams = [
            'prompt' => 'Укажите категорию!',
            'options' => [$product['category_id'] => ['Selected'=>'selected']],
        ];

        return $this->render('edit', [
            'product' => $product,
            'categoryItems' => $categoryItems,
            'categoryParams' => $categoryParams,
        ]);
    }

}
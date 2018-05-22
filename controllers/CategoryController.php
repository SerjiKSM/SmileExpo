<?php

namespace app\controllers;

use app\models\CategoryForm;
use yii\web\Controller;
use app\models\Category;
use app\models\Product;
use Yii;

class CategoryController extends Controller
{

    public function actionIndex()
    {
        $categories = Category::find()->all();
        $products = Product::find()->all();

        return $this->render('index', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function actionEdit()
    {

        if (Yii::$app->request->isPost){

            $idCategory = (Yii::$app->request->get()['id'] > 0 ? intval(Yii::$app->request->get()['id']) : 0 );
            $category = Category::find()->where(['id' => $idCategory])->one();

            $model = new CategoryForm();
            if($model->load(Yii::$app->request->post()) && $model->saveCategory($category)){
                Yii::$app->session->setFlash('message', 'Категория отредактированная успешно!');

                return $this->redirect(['/']);

            }

        }

        $category = Category::find()->where(['id' => intval(Yii::$app->request->get()['id'])])->one();

        return $this->render('edit', [
            'category' => $category,
        ]);

    }

    public function actionDelete()
    {
        $idCategory = (Yii::$app->request->get()['id'] > 0 ? intval(Yii::$app->request->get()['id']) : 0 );
        $category = Category::find()->where(['id' => $idCategory])->one();

        if ($category->delete()){
            Yii::$app->session->setFlash('message', 'Категория удалена успешно!');
        }

        return $this->redirect(['/']);

    }

    public function actionCreate()
    {
        if (Yii::$app->request->isPost){

            $category = new Category();
            $category->title = htmlspecialchars(Yii::$app->request->post()['CategoryForm']['name']);
            $category->description = htmlspecialchars(Yii::$app->request->post()['CategoryForm']['description']);

            if ($category->save()){
                Yii::$app->session->setFlash('message', 'Создана новая категория!');
            }

            return $this->redirect(['/']);

        }

        return $this->render('create');
    }

    public function actionCategoryProducts()
    {
        $idCategory = (Yii::$app->request->get()['id'] > 0 ? intval(Yii::$app->request->get()['id']) : 0 );
        $productsCategory = Product::find()->where(['category_id' => $idCategory])->all();
        $categories = Category::find()->all();

        return $this->render('index', [
            'categories' => $categories,
            'products' => $productsCategory,
        ]);
    }

}



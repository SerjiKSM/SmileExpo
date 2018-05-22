<?php


namespace app\controllers;

use app\models\Comment;
use app\models\CommentForm;
use app\models\Product;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;

class CommentController extends Controller
{
    public function actionCreateComment()
    {
        if (Yii::$app->request->isPost){
            $productForm = new CommentForm();
            $productForm->createComment();

            return $this->redirect(['/']);
        }

        $products = Product::find()->all();
        $productItems = ArrayHelper::map($products,'id','title');

        $productParams = [
            'prompt' => 'Укажите продукт!'
        ];

        return $this->render('create', [
            'productItems' => $productItems,
            'productParams' => $productParams,
        ]);

    }

    public function actionViewComment()
    {
        $comments = Comment::find()->all();

        return $this->render('index', [
            'comments' => $comments,
        ]);
    }

    public function actionDelete()
    {
        $idComment = (Yii::$app->request->get()['id'] > 0 ? intval(Yii::$app->request->get()['id']) : 0 );
        $comment = Comment::find()->where(['id' => $idComment])->one();

        if ($comment->delete()){
            Yii::$app->session->setFlash('message', 'Комментарий удален успешно!');
        }

        return $this->redirect(['/']);

    }

    public function actionEdit()
    {

        if (Yii::$app->request->isPost){
            $idComment = (Yii::$app->request->get()['id'] > 0 ? intval(Yii::$app->request->get()['id']) : 0 );
            $comment = Comment::find()->where(['id' => $idComment])->one();

            $model = new CommentForm();
            if($model->load(Yii::$app->request->post()) && $model->saveComment($comment)){
                Yii::$app->session->setFlash('message', 'Комментарий отредактирован успешно!');

                return $this->redirect(['/']);
            }
        }

        $idComment = (Yii::$app->request->get()['id'] > 0 ? intval(Yii::$app->request->get()['id']) : 0 );
        $comment = Comment::find()->where(['id' => $idComment])->one();

        $products = Product::find()->all();
        $productItems = ArrayHelper::map($products,'id','title');

        $productParams = [
            'prompt' => 'Укажите категорию!',
            'options' => [$comment['product_id'] => ['Selected'=>'selected']],
        ];

        return $this->render('edit', [
            'comment' => $comment,
            'productItems' => $productItems,
            'productParams' => $productParams,
        ]);
    }

}
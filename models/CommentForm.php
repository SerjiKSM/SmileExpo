<?php

namespace app\models;

use yii\base\Model;
use Yii;

class CommentForm extends Model
{
    public $fieldDate;
    public $user;
    public $email;
    public $comment;
    public $product;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

            [['fieldDate', 'user', 'email', 'comment', 'product'], 'required'],
            ['email', 'email'],
            [['fieldDate'], 'date', 'format' => 'Y-m-d'],
        ];
    }

    public function createComment()
    {
        $post = Yii::$app->request->post()['CommentForm'];
        $commemt = new Comment();
        $commemt->date = $post['fieldDate'];
        $commemt->user = $post['user'];
        $commemt->email = $post['email'];
        $commemt->comment = htmlspecialchars($post['comment']);
        $commemt->product_id = $post['product'];

        if ($commemt->save()){
            Yii::$app->session->setFlash('message', 'Создан новый комментарий!');
        }

        return $this;
    }

    public function saveComment($comment)
    {



        if($this->validate()){
            $comment->date = $this->fieldDate;
            $comment->user = $this->user;
            $comment->email = $this->email;
            $comment->product_id = $this->product;
            $comment->comment = $this->comment;

            $comment->save();

            return true;
        } else {
            return false;
        }
    }


}
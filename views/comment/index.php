<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'Комментарии';

?>

<div class="site-comment">

    <div class="jumbotron">
        <h1>Комментарии!</h1>

    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Дата</th>
            <th scope="col">Пользователь</th>
            <th scope="col">Email</th>
            <th scope="col">Комментарий</th>
            <th scope="col" colspan="2">Продукт</th>
        </tr>
        </thead>
        <tbody>
            <?php if (count($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <tr>
                        <th scope="row"><?= Html::encode("$comment->date")?></th>
                        <td><?= Html::encode("$comment->user")?> </td>
                        <td><?= Html::encode("$comment->email")?></td>
                        <td><?= Html::encode("$comment->comment")?></td>
                        <td><?= Html::encode($comment->getProduct()->one()['title'])?></td>
                        <td>
                            <a id="modalButton" href="/comment/edit?id=<?= Html::encode("$comment->id")?>" title="Update" aria-label="Update" data-pjax="0">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        </td>
                        <td>
                            <a href="/comment/delete?id=<?= Html::encode("$comment->id")?>" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info">
                    <span>Комментариев нет!</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </tbody>
    </table>

</div>
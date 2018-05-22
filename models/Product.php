<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'products';
    }

    public function getComments()
    {
        return $this->hasMany(Comment::class(), ['product_id' => 'id']);
    }
}
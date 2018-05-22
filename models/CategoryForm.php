<?php

namespace app\models;

use yii\base\Model;

class CategoryForm extends Model
{
    public $name;
    public $description;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

            [['name', 'description'], 'required'],

        ];
    }

    public function saveCategory($category)
    {
        if($this->validate()){
            $category->title = $this->name;
            $category->description = $this->description;

            $category->save();

            return true;
        } else {
            return false;
        }
    }

}
<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ProductForm extends Model
{
    public $name;
    public $description;
    public $cost;
    public $category;
    public $image;
    public $imageFile;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

            [['name', 'category', 'description', 'cost', 'image'], 'required'],
            ['cost', 'number'],
            ['name', 'match', 'pattern' => '/^[a-z].+\w*$/i'],
            [['image'], 'file', 'extensions' => 'png, jpg'],

        ];
    }

    public function createProduct()
    {

        $this->uploadImage();

        $post = Yii::$app->request->post()['ProductForm'];
        $product = new Product();
        $product->title = htmlspecialchars($post['name']);
        $product->description = htmlspecialchars($post['description']);
        $product->cost = $post['cost'];
        $product->category_id = intval($post['category']);
        $product->path_photo = "{$this->imageFile->baseName}.{$this->imageFile->extension}";

        if ($product->save()){
            Yii::$app->session->setFlash('message', 'Создан новый продукт!');
        }

        return $this;
    }

    public function uploadImage(){
        $this->imageFile = UploadedFile::getInstance($this, 'image');
        $this->imageFile->saveAs("img/{$this->imageFile->baseName}.{$this->imageFile->extension}");
        $this->image = "{$this->imageFile->baseName}.{$this->imageFile->extension}";
        return $this;
    }

    public function saveProduct($product)
    {

        $this->uploadImage();

        if($this->validate()){
            $product->title = $this->name;
            $product->description = $this->description;
            $product->cost = $this->cost;
            $product->category_id = $this->category;
            $product->path_photo = $this->image;

            $product->save();

            return true;
        } else {
            return false;
        }
    }

}
<?php
namespace api\models;

use api\models\Category;

class Product extends \common\models\Product
{
    public function fields() {
        return [
            'id','description','title', 'categories'
        ];
    }

}
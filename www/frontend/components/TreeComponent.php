<?php

namespace frontend\components;

use yii\base\BaseObject;
use common\models\Category;
use yii\helpers\Html;

class TreeComponent extends BaseObject {

    public function __construct($config = []) {
        parent::__construct($config);
    }

    public function init() {
        parent::init();
    }

    public function printTree($pid=0, $level=0) {
        $categories=Category::find()->where('pid=:pid', ['pid' => $pid])->all();

        echo Html::beginTag('ul')."\n";
        foreach($categories as $n=>$category) {
            echo Html::beginTag('li')."\n";
            echo Html::a($category->title, ['site/catalog', 'id' => $category->id], ['class' => 'profile-link']);
            $this->printTree($category->id, $level++);
            echo Html::endTag('li')."\n";
        }
        echo Html::endTag('ul')."\n";
    }

}
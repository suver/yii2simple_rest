<?php

class User extends \common\models\User
{

    public function getCategories()
    {
        return $this->hasMany(Article::className(), ['author_id' => 'id']);
    }
}
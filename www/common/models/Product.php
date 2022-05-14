<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Product model
 *
 * @property integer $id
 * @property string $description
 * @property string $title
 */
class Product extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    public function rules() {
        return [
            ['title', 'required'],
            ['description', 'required'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'title' => 'Title',
        ];
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'product_id'])
            ->viaTable('product_to_category', ['category_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findId($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
}

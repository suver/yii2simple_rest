<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\Product;

/**
 * Category model
 *
 * @property integer $id
 * @property integer $pid
 * @property string $title
 */
class Category extends ActiveRecord
{
    /**
     * Update categories with the new ones
     * @param  array  products [description]
     * @return null
     */
    public function updateProducts($products = [])
    {
        $this->unlinkAll('products', true);

        if ( ! is_array($products))
            return ;

        foreach ($products as $product_id)
        {
            $product = Product::findOne($product_id);
            $this->link('products', $product);
        }

        // alternative solution

        /*
        $old_categories = $this->getCategories()->asArray()->column(); // get all categories IDs
        if ( ! is_array($categories))
            $categories = [];

        $inserted_categories = array_diff($categories, $old_categories);
        $deleted_categories = array_diff($old_categories, $categories);

        foreach ($inserted_categories as $category_id)
        {
            $category = Category::findOne($category_id);
            $this->link('categories', $category);
        }

        foreach ($deleted_categories as $category_id)
        {
            $category = Category::findOne($category_id);
            $this->unlink('categories', $category, true);
        }
        */
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%categories}}';
    }

    public function rules() {
        return [
            ['title', 'required'],
            ['pid', 'integer'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'pid' => 'PID',
            'title' => 'Title',
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'category_id'])
            ->viaTable('product_to_category', ['product_id' => 'id']);
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

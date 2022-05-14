<?php

namespace api\controllers;

use api\models\ResendVerificationEmailForm;
use api\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use api\models\PasswordResetRequestForm;
use api\models\ResetPasswordForm;
use api\models\SignupForm;
use api\models\ContactForm;
use api\models\Category;
use api\models\Product;
use yii\rest\ActiveController;

/**
 * Category controller
 */
class CategoryController extends ActiveController
{
    public $modelClass = 'api\models\Category';

    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        if (in_array(\Yii::$app->request->method, ['POST', 'PUT'])) {
            $p = Yii::$app->request->post();
            $m = $action->modelClass::findId($result['id']);
            $m->unlinkAll('products', true);
            if ($p['products'] and is_array($p['products'])) {
                foreach($p['products'] as $product) {
                    $m->link('products', Product::findId($product['id']));
                }
            }
            $m->save();
            return $m;
        }
        return $result;
    }
}


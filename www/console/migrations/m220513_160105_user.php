<?php

use yii\db\Migration;
use common\models\User;

/**
 * Class m220513_160105_user
 */
class m220513_160105_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new User();
        $user->username = 'root';
        $user->email = 'root@example.loc';
        $user->setPassword('password');
        $user->status = User::STATUS_ACTIVE;
        $user->generateAuthKey();

        return $user->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220513_160105_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220513_160105_user cannot be reverted.\n";

        return false;
    }
    */
}

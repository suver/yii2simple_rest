<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <?=Yii::$app->tree->printTree();?>
    </div>

    <div class="body-content">
        <?php foreach ($products as $product) { ?>
        <p><?=$product->title?> / <?=$product->description?></p>
        <?php } ?>
    </div>
</div>

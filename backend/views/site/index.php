<?php

/* @var $this yii\web\View */
/* @var $appleList \common\models\AppleFruit[] */

$this->title = 'Манипуляции с яблоками';

$this->registerJs(<<<JS
    $(".btn-generate-apples").click(function() {
      
    });
JS
);

?>
<div class="site-index">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Сгенерировать новые яблоки:</h3>
        </div>
        <div class="panel-body">
            <div style="float: left">
                Количество:
                <label>От <input type="text" id="amount[from]" value="1"></label>
                <label>До <input type="text" id="amount[to]" value="50"></label>
            </div>
            <div style="float: right">
                <button class="btn-generate-apples">Сгенерировать</button>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <?php foreach ($appleList as $apple): ?>
            <div class="apple-panel">
                <?php
                switch ($apple->getCurrentState()->getId()) {
                    case 'OnTree':
                        echo '<img src="/img/apple-on-tree.jpg" alt="">';
                        break;
                    case 'OnGround':
                        echo '<img src="/img/apple-on-ground.jpg" alt="">';
                        break;
                    case 'Rotten':
                        echo '<img src="/img/apple-rotten.jpg" alt="">';
                        break;
                    default:
                        break;
                }
                ?>
                <?= $apple->getCurrentState()->getName() ?>
                <?php foreach ($apple->getCurrentState()->getFunctions() as $func): ?>
                <?php endforeach; ?>
            </div>
            <hr>
        <?php endforeach; ?>
    </div>

</div>

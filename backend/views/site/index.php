<?php

/* @var $this yii\web\View */

/* @var $appleList \common\models\AppleFruit[] */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Манипуляции с яблоками';

/*$this->registerJs(<<<JS
    $(".btn-generate-apples").click(function() {
      
    });
JS
);*/

$this->registerCss(<<<CSS
.apple-panel {
    border-spacing: 10px 0;
    border-collapse: separate;
}
.apple-panel td {
    text-align: center;
    vertical-align: top;
}
CSS
);

?>
<div class="site-index">

    <?php ActiveForm::begin(
        [
            'action' => '/apple/generate-items',
        ]
    ) ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Сгенерировать новые яблоки:</h3>
        </div>
        <div class="panel-body">
            <div style="float: left">
                Количество:
                <label>От <input type="text" name="amount[from]" value="1"></label>
                <label>До <input type="text" name="amount[to]" value="10"></label>
            </div>
            <div style="float: right">
                <button class="btn-generate-apples">Сгенерировать</button>
            </div>
        </div>
    </div>
    <?php ActiveForm::end() ?>

    <div class="panel panel-default">
        <?php foreach ($appleList as $appleId => $apple): ?>
            <table class="apple-panel">
                <tr>
                    <td>
                        <?= $apple->getCurrentState()->getName() ?><br>
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
                    </td>

                    <td>
                        Цвет:<br>
                        <div style="width:50px;height:50px;background-color:<?= $apple->color ?>"></div>
                    </td>

                    <td>
                        Создано:<br>
                        <?= date('Y-m-d H:i:s', $apple->ripen) ?>
                    </td>

                    <td style="vertical-align: middle">
                        <?php foreach ($apple->getCurrentState()->getFunctions() as $funcName => $func): ?>
                            <?php ActiveForm::begin(
                                [
                                    'action' => '/apple/handle-state-function',
                                    'options' => [
                                        'style' => 'margin-bottom: 2em',
                                    ],
                                ]
                            ) ?>

                            <input type="hidden" name="apple-id" value="<?= $appleId ?>">
                            <input type="hidden" name="state-id" value="<?= $apple->getCurrentState()->getId() ?>">
                            <input type="hidden" name="state-function" value="<?= $funcName ?>">

                            <div>
                                <?php if (!empty($func['params'])): ?>
                                    <?= Html::encode($func['params']['description']) ?><br>
                                    <input type="text" name="<?= Html::encode('sfn-' . $funcName) ?>">
                                <?php endif; ?>
                            </div>
                            <input style="margin-top: 7px" type="submit" value="<?= Html::encode($func['name']) ?>">
                            <?php ActiveForm::end() ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
            </table>
            <hr>
        <?php endforeach; ?>
    </div>

</div>

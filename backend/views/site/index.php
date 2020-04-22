<?php

/* @var $this yii\web\View */

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
    </div>

</div>

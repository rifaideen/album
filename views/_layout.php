<?php

use yii\widgets\Menu;
?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-success">
                <div class="panel-heading">Albums Menu</div>
                <div class="panel-body">
                    <?php
                    echo Menu::widget([
                        'items'=>$this->params,
                        'options'=>[
                            'class'=>'nav nav-pills nav-stacked'
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <?php echo $content; ?>
        </div>
    </div>
</div>
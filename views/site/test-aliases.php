<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */

$this->title = 'Text File Content';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="card">
                <div class="card-body">
                    <pre>
                        <?= Html::encode($content) ?>
                    </pre>
                </div>
            </div>
        </div>
    </div>
</div>
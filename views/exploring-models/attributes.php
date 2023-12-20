<?php

use yii\helpers\Html;

$this->title = 'Attributes';
?>

<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model as $name => $value) : ?>
                <tr>
                    <td><?= $name ?></td>
                    <td><?= $value ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
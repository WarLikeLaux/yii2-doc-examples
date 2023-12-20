<?php

use yii\helpers\Html;

$this->title = 'Attribute Labels';
?>

<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Attribute</th>
                <th>Label</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model as $name => $value) : ?>
                <tr>
                    <td><?= $name ?></td>
                    <td><?= $model->getAttributeLabel($name) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
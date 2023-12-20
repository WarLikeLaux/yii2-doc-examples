<?php

use yii\helpers\Html;

$this->title = 'Validation Rules';
?>

<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Attribute</th>
                <th>Error</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($errors as $attribute => $error) : ?>
                <tr>
                    <td><?= $attribute ?></td>
                    <td><?= json_encode($error) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
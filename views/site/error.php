<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;

$this->params['body-class'] = 'bg-light'; // Add a custom class to the body for styling

?>
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 text-center">
            <h1 class="display-4"><?= Html::encode($name) ?></h1>
            <p class="lead"><?= nl2br(Html::encode($message)) ?></p>
            <p class="text-muted">The above error occurred while the web server was processing your request.</p>
            <?= Html::a('Back to Home', ['site/index'], ['class' => 'btn btn-primary mt-4']) ?>
        </div>
    </div>
</div>
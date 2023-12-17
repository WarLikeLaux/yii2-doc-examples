<?php

use yii\helpers\Html;
use yii\web\View;
use app\assets\AnimateCssAsset;

AnimateCssAsset::register($this);

/* @var $this View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;

$this->params['body-class'] = 'bg-light'; // Add a custom class to the body for styling

// Styling and layout enhancements
$containerOptions = ['class' => 'container-fluid d-flex align-items-center justify-content-center min-vh-100'];
$errorContainerOptions = ['class' => 'bg-white p-5 rounded shadow animate__animated animate__pulse'];
$errorContentOptions = ['class' => 'text-center'];
$errorTitleOptions = ['class' => 'display-4 text-danger mb-4'];
$errorMessageOptions = ['class' => 'lead'];
$errorDescriptionOptions = ['class' => 'text-muted mb-4'];
$backButtonOptions = ['class' => 'btn btn-primary btn-lg', 'style' => 'min-width: 200px'];

?>

<?= Html::beginTag('div', $containerOptions) ?>
<?= Html::beginTag('div', $errorContainerOptions) ?>
<?= Html::beginTag('div', $errorContentOptions) ?>
<?= Html::tag('h1', Html::encode($name), $errorTitleOptions) ?>
<?= Html::tag('p', nl2br(Html::encode($message)), $errorMessageOptions) ?>
<?= Html::tag('p', 'The above error occurred while the web server was processing your request.', $errorDescriptionOptions) ?>
<?= Html::a('Back to Home', ['site/index'], $backButtonOptions) ?>
<?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>
<?= Html::endTag('div') ?>
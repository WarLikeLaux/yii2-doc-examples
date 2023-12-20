<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\AnimateCssAsset;

AnimateCssAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Country */

$this->title = 'View Country: ' . $model['name'];
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// Add the "animated" class and Animate.css animation classes for elements
$animationClass = 'animate__bounceIn'; // You can choose any animation from Animate.css

?>
<div class="country-view <?= $animationClass ?>">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="<?= $animationClass ?>">
        <?= Html::a('Update', ['update', 'id' => $model['code']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model['code']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Code',
                'attribute' => 'code',
                'format' => 'text',
            ],
            [
                'label' => 'Name',
                'attribute' => 'name',
                'format' => 'text',
            ],
            [
                'label' => 'Pretty Name',
                'attribute' => 'prettyName',
                'format' => 'text',
            ],
            [
                'label' => 'Population',
                'attribute' => 'populationCount',
                'format' => 'integer',
            ],
        ],
    ]) ?>

</div>
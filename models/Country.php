<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property string $code
 * @property string $name
 * @property int $population
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    public function attributes()
    {
        $attributes = static::getTableSchema()->getColumnNames();
        $valueToDelete = 'population';
        $attributes = array_filter($attributes, function ($item) use ($valueToDelete) {
            return $item !== $valueToDelete;
        });
        array_push($attributes, $valueToDelete);
        return $attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['population'], 'integer'],
            [['code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 52],
            [['code'], 'unique'],
        ];
    }

    public function fields()
    {
        return [
            'code',
            'name',
            'populationCount' => 'population',
        ];
    }

    public function extraFields()
    {
        return [
            'prettyName' => function () {
                return "{$this->code} ({$this->name})";
            },
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'name' => 'Name',
            'population' => 'Population',
        ];
    }
}

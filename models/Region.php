<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property string $region_id Region Id
 * @property string $country Country Id in ISO-2
 * @property string|null $name Region Name
 * @property string|null $code Region Code
 * @property string|null $subdivision Region Subdivision - null, state, Union territory etc
 *
 * @property Country $country0
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'country'], 'required'],
            [['region_id', 'name', 'code', 'subdivision'], 'string', 'max' => 255],
            [['country'], 'string', 'max' => 2],
            [['region_id', 'country'], 'unique', 'targetAttribute' => ['region_id', 'country']],
            [['country'], 'exist', 'skipOnError' => true, 'targetClass' => Country::class, 'targetAttribute' => ['country' => 'country_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'region_id' => 'Region ID',
            'country' => 'Country',
            'name' => 'Name',
            'code' => 'Code',
            'subdivision' => 'Subdivision',
        ];
    }

    /**
     * Gets query for [[Country0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(Country::class, ['country_id' => 'country']);
    }
}

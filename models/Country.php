<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property string $country_id Country Id in ISO-2
 * @property string|null $name Country Name
 * @property string|null $iso2_code Country ISO-2 format
 * @property string|null $iso3_code Country ISO-3
 *
 * @property Region[] $regions
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id'], 'required'],
            [['country_id', 'iso2_code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 255],
            [['iso3_code'], 'string', 'max' => 3],
            [['country_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'country_id' => 'Country ID',
            'name' => 'Name',
            'iso2_code' => 'Iso2 Code',
            'iso3_code' => 'Iso3 Code',
        ];
    }

    /**
     * Gets query for [[Regions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Region::class, ['country' => 'country_id']);
    }
}

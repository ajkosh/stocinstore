<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "store_type".
 *
 * @property int $id
 * @property string $type
 * @property string|null $icon
 *
 * @property Store[] $stores
 */
class StoreType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 50],
            [['icon'], 'string', 'max' => 2048],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'icon' => 'Icon',
        ];
    }

    /**
     * Gets query for [[Stores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStores()
    {
        return $this->hasMany(Store::class, ['store_type_id' => 'id']);
    }
}

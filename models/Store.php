<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "store".
 *
 * @property int $id
 * @property string $code
 * @property string $store_name
 * @property string|null $store_locator_page_url
 * @property int|null $store_type_id
 * @property int $is_active
 * @property int $enable_for_find_in_store
 * @property int $enable_for_store_locator
 * @property string|null $store_image
 * @property string|null $country
 * @property string|null $region_code
 * @property string|null $address_line_1
 * @property string|null $address_line_2
 * @property string|null $city
 * @property string|null $postcode
 *
 * @property StoreType $storeType
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'store_name','store_type_id','city','country','postcode','address_line_1','enable_for_store_locator','region_code'], 'required'],
        //    [['code', 'store_name'], 'required'],
            [['store_image'], 'file', 'extensions' => 'png', 'skipOnEmpty' => true, 'maxSize' => 312000, 'tooBig' => 'File Limit is 300KB'],
            [['code'], 'unique'],
            [['store_type_id', 'is_active', 'enable_for_find_in_store', 'enable_for_store_locator'], 'integer'],
            [['code', 'store_name', 'region_code', 'city'], 'string', 'max' => 50],
            [['store_locator_page_url', 'address_line_1', 'address_line_2'], 'string', 'max' => 255],
            [['country'], 'string', 'max' => 2],
            [['postcode'], 'string', 'max' => 20],
            [['store_locator_page_url'],'url'],
            [['store_image'], 'required', 'when' => function ($model) {
                return $model->enable_for_store_locator == '1';
            }, 'whenClient' => "function (attribute, value) {
                return $('#enable-store').prop('checked') == true;
            }"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'store_name' => 'Store Name',
            'store_locator_page_url' => 'Store Locator Page Url',
            'store_type_id' => 'Store Type ID',
            'is_active' => 'Is Active',
            'enable_for_find_in_store' => 'Enable For Find In Store',
            'enable_for_store_locator' => 'Enable For Store Locator',
            'store_image' => 'Store Image',
            'country' => 'Country',
            'region_code' => 'Region Code',
            'address_line_1' => 'Address Line 1',
            'address_line_2' => 'Address Line 2',
            'city' => 'City',
            'postcode' => 'Postcode',
        ];
    }

    /**
     * Gets query for [[StoreType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreType()
    {
        return $this->hasOne(StoreType::class, ['id' => 'store_type_id']);
    }
    
    /**
     * @return yii\helpers\ArrayHelper
     */
    public function getStoreTypeDropDownData() 
    { 
      return ArrayHelper::map(StoreType::find()->all(), 'id', 'type');
    } 

    /**
     * @return yii\helpers\ArrayHelper
     */
    public function getCountryDropDownData() 
    { 
      return ArrayHelper::map(Country::find()->all(), 'country_id', 'name');
    } 
}

<?php

namespace common\models;

use funson86\blog\models\BlogCatalog;
use funson86\blog\models\BlogPost;
use Yii;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $catalog_id
 * @property string $name
 * @property string $sku
 * @property integer $stock
 * @property string $weight
 * @property string $price
 * @property string $brief
 * @property string $introduction
 * @property string $content
 * @property string $thumb
 * @property string $image
 * @property string $keywords
 * @property string $description
 * @property integer $brand
 * @property integer $sales
 * @property integer $status
 * @property integer $created_at
 * @property integer $endtime_at
 * @property integer $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catalog_id', 'stock','sales', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'sku'], 'required'],
            //[['starttime', 'endtime'], 'date', 'format' => 'dd-MM-yyyy HH:mm:ss'],
            [['weight', 'price'], 'number'],
            [['brief', 'introduction', 'content', 'description', 'brand'], 'string'],
            [['name','brand'], 'string', 'max' => 128],
            [['sku'], 'string', 'max' => 64],
            [['thumb', 'image'], 'file', 'extensions' => 'jpg, png, gif', 'mimeTypes' => 'image/jpeg, image/png, image/gif',],
            [['keywords'], 'string', 'max' => 255]
        ];
    }

    /**
     * created_at, updated_at to now()
     * crate_user_id, update_user_id to current login user id
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'catalog_id' => Yii::t('app', 'Catalog ID'),
            'name' => Yii::t('app', 'Name'),
            'sku' => Yii::t('app', 'Sku'),
            'stock' => Yii::t('app', 'Stock'),
            'weight' => Yii::t('app', 'Weight'),
            'price' => Yii::t('app', 'Price'),
            'brief' => Yii::t('app', 'Brief'),
            'introduction' => Yii::t('app', 'Introduction'),
            'content' => Yii::t('app', 'Content'),
            'thumb' => Yii::t('app', 'Thumb'),
            'image' => Yii::t('app', 'Image'),
            'keywords' => Yii::t('app', 'Keywords'),
            'description' => Yii::t('app', 'Description'),
            'brand' => Yii::t('app', 'Brand'),
            'sales' => Yii::t('app', 'Sales'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'starttime' => Yii::t('app', 'Start Time'),
            'endtime' => Yii::t('app', 'End Time'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasOne(BlogCatalog::className(), ['id' => 'catalog_id']);
    }

}

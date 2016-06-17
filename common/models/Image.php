<?php

namespace common\models;

use funson86\blog\models\Status;
use Yii;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "Images".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $keywords
 * @property string $description
 * @property string $url
 * @property integer $sort_order
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Image extends \yii\db\ActiveRecord
{

    public $_status;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }


    /**
     * create_time, update_time to now()
     * crate_user_id, update_user_id to current login user id
     */
    public function behaviors()
    {
        return [
            'class' => TimestampBehavior::className(),
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'keywords'], 'required'],
            [['id', 'sort_order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['description', 'url'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['group_name'], 'string', 'max' => 32],
            [['image'], 'file', 'extensions' => 'jpg, png, gif', 'mimeTypes' => 'image/jpeg, image/png, image/gif',],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'image' => Yii::t('app', 'Image'),
            'keywords' => Yii::t('app', 'Keywords'),
            'description' => Yii::t('app', 'Description'),
            'url' => Yii::t('app', 'Url'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'group_name' => Yii::t('app', 'group_name'),
        ];
    }

    public function getStatus()
    {
        if ($this->_status === null) {
            $this->_status = new Status($this->status);
        }
        return $this->_status;
    }
}

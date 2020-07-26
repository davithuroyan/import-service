<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "store".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property ImportTask[] $importTasks
 * @property StoreProduct[] $storeProducts
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
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[ImportTasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImportTasks()
    {
        return $this->hasMany(ImportTask::className(), ['store_id' => 'id']);
    }

    /**
     * Gets query for [[StoreProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreProducts()
    {
        return $this->hasMany(StoreProduct::className(), ['store_id' => 'id']);
    }
}

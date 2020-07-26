<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "import_task".
 *
 * @property int $id
 * @property int|null $store_id
 * @property string|null $file
 * @property string $datetime
 * @property int|null $status
 *
 * @property Store $store
 */
class ImportTask extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_DONE = 3;
    
    const STATUS_MAPPING = [
        self::STATUS_NEW => 'New',
        self::STATUS_PROCESSING => 'Processing',
        self::STATUS_DONE => 'Done',
    ];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'import_task';
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_id', 'status'], 'integer'],
            [['datetime'], 'safe'],
            [['file'], 'string', 'max' => 255],
            [
                ['store_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Store::className(),
                'targetAttribute' => ['store_id' => 'id']
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_id' => 'Store ID',
            'file' => 'File',
            'datetime' => 'Datetime',
            'status' => 'Status',
        ];
    }
    
    /**
     * Gets query for [[Store]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'store_id']);
    }
    
    /**
     * Gets query for [[ImportInfo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImportInfo()
    {
        return $this->hasOne(ImportInfo::className(), ['task_id' => 'id']);
    }
    
    public function setStatus(int $status)
    {
        $this->status = $status;
        $this->save();
    }
}

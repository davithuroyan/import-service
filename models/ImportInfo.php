<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "import_info".
 *
 * @property int $id
 * @property int|null $task_id
 * @property int|null $imported_count
 * @property int|null $failed_count
 *
 * @property ImportTask $task
 */
class ImportInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'import_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'imported_count', 'failed_count'], 'integer'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImportTask::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'imported_count' => 'Imported Count',
            'failed_count' => 'Failed Count',
        ];
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(ImportTask::className(), ['id' => 'task_id']);
    }
}

<?php


namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ImportTaskForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;
    
    /**
     * @var int
     */
    public $store_id;
    
    public function rules()
    {
        return [
            [
                ['file'],
                'file',
                'extensions' => 'csv',
                'skipOnEmpty' => false,
                'checkExtensionByMimeType' => false,
                'maxSize' => 5242880
            ],
            [['store_id'], 'integer', 'skipOnEmpty' => false,],
        ];
    }
    
    /**
     * @return bool|string
     */
    public function upload()
    {
        if ($this->validate()) {
            $fileName = $this->generateFileName();
            
            if (!is_dir(\Yii::getAlias('@app/temp/'))) {
                mkdir(\Yii::getAlias('@app/temp'));
            }
            
            $this->file->saveAs(\Yii::getAlias('@app/temp/') . $fileName);
            
            return $fileName;
        } else {
            return false;
        }
    }
    
    /**
     * @return string
     */
    private function generateFileName()
    {
        return $this->file->baseName . '_' . time() . '.' . $this->file->extension;
    }
}
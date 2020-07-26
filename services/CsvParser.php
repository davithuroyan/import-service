<?php


namespace app\services;


class CsvParser implements Parser
{
    protected $file;
    
    public function __construct($file)
    {
        $this->file = $file;
    }
    
    public function parse()
    {
        $list = [];
        $fileName = \Yii::getAlias('@app/temp/') . $this->file;
        if ($handle = fopen($fileName, 'r')) {
            $columnHeaders = fgetcsv($handle);
            
            while ($data = fgetcsv(($handle))) {
                $rowItem = [];
                foreach ($columnHeaders as $key => $columnHeader) {
                    $rowItem[$columnHeader] = $data[$key] ?? 0;
                }
                $list[] = $rowItem;
            }
        }
        
        return $list;
    }
}
<?php

namespace app\services;

use app\models\ImportInfo;
use app\models\ImportTask;
use app\models\StoreProduct;


class Importer
{
    protected $parser;
    
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }
    
    public function import(ImportTask $task)
    {
        $data = $this->parser->parse();
        
        $importedItemsCount = 0;
        $failedToImport = 0;
        $task->setStatus(ImportTask::STATUS_PROCESSING);
        $importInfo = new ImportInfo();
        
        if (!empty($data)) {
            foreach ($data as $item) {
                try {
                    $product = StoreProduct::findOne(['upc' => $item['upc']]);
                    
                    if (!$product) {
                        $product = new StoreProduct();
                    }
                    
                    $product->setAttributes($item);
                    $product->store_id = $task->store_id;
                    $product->save();
                    
                    $importedItemsCount++;
                } catch (\Exception $ex) {
                    $failedToImport++;
                }
            }
            
            $importInfo->imported_count = $importedItemsCount;
            $importInfo->failed_count = $failedToImport;
        }
        
        $task->setStatus(ImportTask::STATUS_DONE);
        
        $importInfo->task_id = $task->id;
        $importInfo->save();
    }
}
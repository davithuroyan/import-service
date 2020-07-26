<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\ImportTask;
use app\services\CsvParser;
use app\services\Importer;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\db\Exception;

class TaskController extends Controller
{
    
    public function actionImport()
    {
        echo("Starting Import Process \r\n");
        
        $maxProcessCount = \Yii::$app->params['max_process_count'];
        
        echo("Checking In Progress Processes \r\n");
        $inProgressTasksCount = ImportTask::find()->where(['status' => ImportTask::STATUS_PROCESSING])->count();
        
        $allowedProcessesCount = $maxProcessCount - $inProgressTasksCount;
        
        if ($allowedProcessesCount <= 0) {
            echo("Allowed max process count");
            return ExitCode::UNAVAILABLE;
        }
        
        echo("Checking Tasks for Import \r\n");
        
        $tasks = ImportTask::find()
            ->where(['status' => ImportTask::STATUS_NEW])
            ->limit($allowedProcessesCount)->all();
        
        if (empty($tasks)) {
            echo("There are not Tasks for importing.");
            return ExitCode::UNAVAILABLE;
        }
        
        foreach ($tasks as $task) {
            echo shell_exec('php yii import/run ' . $task->id);
        }
        
        echo("Import Finished\r\n");
        return ExitCode::OK;
    }
    
    public function actionRun(int $taskId)
    {
        echo("Starting Task task_id: $taskId \r\n");
        $task = ImportTask::findOne($taskId);
        
        $parser = new CsvParser($task->file);
        
        $importer = new Importer($parser);
        $importer->import($task);
        echo("Finished Task task_id: $taskId \r\n");
    }
}

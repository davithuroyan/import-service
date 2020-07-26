<?php

use app\models\ProductImport;
use app\models\ProductImportRow;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Imports Service';

?>

<div class="site-index">
    <h1 class="h1">
        Product imports
    </h1>
    
    <?php echo \app\widgets\Alert::widget() ?>

    <div class="nav text-right">
        <a href="<?php echo Url::to(['site/add-import-task']) ?>"
           class="btn btn-primary"> Add Task </a>
    </div>
    <br/>
    <?php if (count($imports)) { ?>
        <table class="table table-striped table-responsive">
            <thead>
            <tr>
                <th>Store Name</th>
                <th>Import File</th>
                <th>Imported Products</th>
                <th>Failed import</th>
                <th width="100"> Status</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($imports as $item) : ?>
                <tr>
                    <td><?php echo $item->store->title ?></td>
                    <td><?php echo $item->file ?></td>
                    <td><?php echo $item->importInfo ? $item->importInfo->imported_count : 0 ?> </td>
                    <td><?php echo $item->importInfo ? $item->importInfo->failed_count : 0 ?> </td>
                    <td><?php echo \app\models\ImportTask::STATUS_MAPPING[$item->status] ?> </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-warning">
            No imports found
        </div>
    <?php } ?>
</div>

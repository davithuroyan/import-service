<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ImportTask */
/* @var $form ActiveForm */
?>
<?php

$this->title = 'Imports Service';

$storesDropdown = yii\helpers\ArrayHelper::map($stores, 'id', 'title');
//var_dump($storesDropdown);die;
?>
<h1 class="h1">
    Add Import File
</h1>
<?php

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

echo $form->field($model, 'store_id')->dropDownList(
    $storesDropdown,
    ['prompt' => 'Select Store...']
);

echo $form->field($model, 'file')->fileInput();
?>

<button class="btn btn-primary">Submit</button>

<?php ActiveForm::end() ?>

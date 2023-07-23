<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Forms add notes';
?>
<div class="container">
    <?php

    if($resultAdd === true) {
        echo "<p class='text-center'>The $value $type was successfully added</p>";
    }else {
        echo "<p class='alert alert-danger shadow text-center'>Failed to record</p>";
    }

    ?>
    <a href=" <?= Url::to('@web/' . "form/view-add-form") ?> ">Back to Form</a>
</div>
<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'page message delete';
?>
<div class="container">
    <?php

    if($resultDelete === true) {
        echo "<p class='text-center'>the $type has been successfully deleted</p>";
    }else {
        echo "<p class='alert alert-danger shadow text-center'>failed to delete</p>";
    }

    ?>
    <a href="<?= Url::to('@web/' . "site/index") ?>">Back to Home Page</a>
</div>
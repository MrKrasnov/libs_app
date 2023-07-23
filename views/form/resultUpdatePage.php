<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Forms add notes';
?>
<div class="container">
    <?php

    if($resultUpdate === true) {
        echo "<p class='text-center'>The book data has been successfully updated</p>";
    }else {
        echo "<p class='alert alert-danger shadow text-center'>The book data has not been updated</p>";
    }

    ?>
    <a href="<?= Url::to('@web/' . "site/index") ?>">Back to Home Page</a>
</div>
<?php

/** @var yii\web\View $this */

$this->title = 'Forms add notes';
?>
<div class="container">
    <?php

    if($resultDelete === true) {
        echo "<p class='text-center'>the book has been successfully deleted</p>";
    }else {
        echo "<p class='alert alert-danger shadow text-center'>failed to delete the book</p>";
    }

    ?>
    <a href="/form/view-form">Back to Form</a>
</div>
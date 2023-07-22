<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = $title;
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-6">
            <img style="max-height: 750px" src="<?php echo Url::to('@web/'.$img) ?>" alt="Book Img" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2><?php echo $title ?></h2>
            <hr>
            <h4>Description:</h4>
            <p>
               <?php echo $description ?>
            </p>
            <h5>created at:</h5>
            <p>
                <?php echo $created_at ?>
            </p>
            <?php

            if(isset($updated_at)) {
                echo "<h5>updated at:</h5><p>$updated_at</p>";
            }
            ?>
            <button class="btn btn-primary">Change Data</button>
        </div>
    </div>
</div>
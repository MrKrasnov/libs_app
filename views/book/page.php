<?php

/** @var yii\web\View $this */

$this->title = $title;
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo $img ?>" alt="Book Img" class="img-fluid">
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

            if(isset($deleted_at)) {
                echo "<h5>deleted at:</h5><p>$deleted_at</p>";
            }

            ?>
            <button class="btn btn-primary">Change Data</button>
        </div>
    </div>
</div>
</div>

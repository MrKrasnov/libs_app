<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = $title;
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-6">
            <img style="max-height: 750px" src="<?= Url::to('@web/'.$img) ?>" alt="Book Img" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2><?= $title ?></h2>
            <hr>
            <h4>Description:</h4>
            <p>
               <?= $description ?>
            </p>
            <h5>created at:</h5>
            <p>
                <?= $created_at ?>
            </p>
            <?php

            if(isset($updated_at)) {
                echo "<h5>updated at:</h5><p>$updated_at</p>";
            }
            ?>
            <a href="/form/view-update-form?id=<?= $id ?>" class="btn btn-primary" id="changeData">Change Data</a>
            <a class="btn btn-danger" id="removeData">Remove Data</a>
        </div>
    </div>
</div>
<script>
    const removeDataHyperlist = document.getElementById('removeData');

    removeDataHyperlist.addEventListener('click', function(event) {
        event.preventDefault();
        let question = confirm('Are you sure you want to delete the book?');

        if(question === false) {
            return;
        }

        const form = document.createElement("form");
        form.method = "POST";
        form.action = "<?= Url::to(['/form/delete', 'type' => 'book']) ?>";

        const csrfInput = document.createElement("input");
        csrfInput.type = "hidden";
        csrfInput.name = "_csrf";
        csrfInput.value = "<?= $csrf ?>";

        const idInput = document.createElement("input");
        idInput.type = "text";
        idInput.name = "id";
        idInput.value = "<?= $id ?>";

        form.appendChild(csrfInput);
        form.appendChild(idInput);

        document.querySelector('.site-index').appendChild(form);
        form.submit();
    });
</script>
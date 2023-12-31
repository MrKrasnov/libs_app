<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Update Book ".$bookData['title']." Form";
?>

<div class="container">
    <form action="<?= Url::to(['/form/update', 'type' => 'title']) ?>" method="POST">
        <h3>Change Title</h3>
        <div class="form-group">
            <label for="title">Title - <?= $bookData['title'] ?></label>
            <input type="hidden" name="id" value="<?= $bookData['id'] ?>">
            <input type="text" class="form-control shadow" id="title" name="title" placeholder="Enter Title" required>
        </div>
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
        <button type="submit" class="btn btn-primary shadow">Update Title</button>
    </form>

    <form class="mt-5" action="<?= Url::to(['/form/update', 'type' => 'description']) ?>" method="POST">
        <h3>Change Description</h3>
        <div class="form-group">
            <label for="author">Description:</label>
            <input type="hidden" name="id" value="<?= $bookData['id'] ?>">
            <textarea class="form-control shadow" id="bookDescription" name="description" rows="4" placeholder="Enter Description Book" required></textarea>
        </div>
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
        <button type="submit" class="btn btn-primary shadow">Update Description</button>
    </form>

    <form class="mt-5" action="<?= Url::to(['/form/update', 'type' => 'image']) ?>" method="POST" enctype="multipart/form-data">
        <h3>Change Image</h3>
        <div class="mb-3">
            <input type="hidden" name="id" value="<?= $bookData['id'] ?>">
            <input type="file" class="form-control-file" id="img" name="img" required>
            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
        </div>
        <button type="submit" class="btn btn-primary shadow">Change Image</button>
    </form>

    <form class="mt-5" action="<?= Url::to(['/form/delete', 'type' => 'image']) ?>" method="POST">
        <h3>Delete Image</h3>
        <div class="mb-3">
            <input type="hidden" name="id" value="<?= $bookData['id'] ?>">
            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
        </div>
        <button type="submit" class="btn btn-danger shadow">Delete Image</button>
    </form>

    <form class="mt-5" action="<?= Url::to(['/form/update', 'type' => 'categories']) ?>" method="POST">
        <h3>Add Genres</h3>
        <div class="form-group">
            <div class="row">
                <div class='col-md-6'>
                    <label>Genres:</label>
                    <input type="hidden" name="id" value="<?= $bookData['id'] ?>">
                    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
                    <?php
                    if(empty($categoriesNotExistBook)) {
                        echo
                        '
                                <div class="alert alert-danger mt-3 shadow">
                                  error get categories
                                </div>
                            ';
                    } else {
                        echo "<select class='form-control col-md-6 shadow' name='addCategories[]' multiple required>";
                        foreach ($categoriesNotExistBook as $category) {
                            $value = $category['name'];
                            $id    = $category['id'];
                            echo "<option value='$id'>$value</option>";
                        }
                        echo "</select>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary shadow">Add Categories</button>
    </form>

    <form class="mt-5" action="<?= Url::to(['/form/delete', 'type' => 'categories']) ?>" method="POST">
        <h3>Delete Genres</h3>
        <div class="form-group">
            <div class="row">
                <div class='col-md-6'>
                    <label>Genres:</label>
                    <input type="hidden" name="id" value="<?= $bookData['id'] ?>">
                    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
                    <?php
                    if(empty($categoriesBook)) {
                        echo
                        '
                                <div class="alert alert-danger mt-3 shadow">
                                  error get categories
                                </div>
                            ';
                    } else {
                        echo "<select class='form-control col-md-6 shadow' name='removeCategories[]' multiple required>";
                        foreach ($categoriesBook as $category) {
                            $value = $category['name'];
                            $id    = $category['id'];
                            echo "<option value='$id'>$value</option>";
                        }
                        echo "</select>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-danger shadow">Delete Categories</button>
    </form>

    <form class="mt-5" action="<?= Url::to(['/form/update', 'type' => 'authors']) ?>" method="POST">
        <h3>Add Authors</h3>
        <div class="form-group">
            <div class="row">
                <div class='col-md-6'>
                    <label>Authors:</label>
                    <input type="hidden" name="id" value="<?= $bookData['id'] ?>">
                    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
                    <?php
                    if(empty($authorsNotExistBook)) {
                        echo
                        '
                                <div class="alert alert-danger mt-3 shadow">
                                  error get authors
                                </div>
                            ';
                    } else {
                        echo "<select class='form-control col-md-6 shadow' name='addAuthors[]' multiple required>";
                        foreach ($authorsNotExistBook as $author) {
                            $value = $author['name'];
                            $id    = $author['id'];
                            echo "<option value='$id'>$value</option>";
                        }
                        echo "</select>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary shadow">Add Authors</button>
    </form>

    <form class="mt-5" action="<?= Url::to(['/form/delete', 'type' => 'authors']) ?>" method="POST">
        <h3>Delete Authors</h3>
        <div class="form-group">
            <div class="row">
                <div class='col-md-6'>
                    <label>Authors:</label>
                    <input type="hidden" name="id" value="<?= $bookData['id'] ?>">
                    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
                    <?php
                    if(empty($authorsBook)) {
                        echo
                        '
                                <div class="alert alert-danger mt-3 shadow">
                                  error get authors
                                </div>
                            ';
                    } else {
                        echo "<select class='form-control col-md-6 shadow' name='removeAuthors[]' multiple required>";
                        foreach ($authorsBook as $author) {
                            $value = $author['name'];
                            $id    = $author['id'];
                            echo "<option value='$id'>$value</option>";
                        }
                        echo "</select>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-danger shadow">Delete Authors</button>
    </form>

</div>
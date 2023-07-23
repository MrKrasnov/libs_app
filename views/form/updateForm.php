<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = "Update Book ... Form";
?>

<div class="container">
    <form action="/form/update-title" method="POST">
        <h3>Change Title</h3>
        <div class="form-group">
            <label for="title">Title - </label>
            <input type="text" class="form-control shadow" id="title" name="title" placeholder="Enter Title" required>
        </div>
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
        <button type="submit" class="btn btn-primary shadow">Update Title</button>
    </form>

    <form class="mt-5" action="/form/update-description" method="POST">
        <h3>Change Description</h3>
        <div class="form-group">
            <label for="author">Description:</label>
            <textarea class="form-control shadow" id="bookDescription" name="bookDescription" rows="4" placeholder="Enter Description Book" required></textarea>
        </div>
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
        <button type="submit" class="btn btn-primary shadow">Update Description</button>
    </form>

    <form class="mt-5" action="/form/update-image" method="POST" enctype="multipart/form-data">
        <h3>Change Image</h3>
        <div class="mb-3">
            <input type="file" class="form-control-file" id="bookImage" name="bookImage" required>
            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
        </div>
        <button type="submit" class="btn btn-primary shadow">Change Image</button>
    </form>

    <form class="mt-5" action="/form/add-categories-for-book" method="POST">
        <h3>Add Categories</h3>
        <div class="form-group">
            <div class="row">
                <div class='col-md-6'>
                    <label>Categories:</label>
                    <?php
                    /*
                    if(empty($categories)) {
                        echo
                        '
                                <div class="alert alert-danger mt-3 shadow">
                                  You need to add a category
                                </div>
                                ';
                    } else {
                        echo "<select class='form-control col-md-6 shadow' name='categories[]' multiple required>";
                        foreach ($categories as $category) {
                            $value = $category['name'];
                            $id    = $category['id'];
                            echo "<option value='$id'>$value</option>";
                        }
                        echo "</select>";
                    }
                    */
                    ?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary shadow">Add Categories</button>
    </form>

    <form class="mt-5" action="/form/add-categories-for-book" method="POST">
        <h3>Delete Categories</h3>
        <div class="form-group">
            <div class="row">
                <div class='col-md-6'>
                    <label>Categories:</label>
                    <?php
                    /*
                    if(empty($categories)) {
                        echo
                        '
                                <div class="alert alert-danger mt-3 shadow">
                                  You need to add a category
                                </div>
                                ';
                    } else {
                        echo "<select class='form-control col-md-6 shadow' name='categories[]' multiple required>";
                        foreach ($categories as $category) {
                            $value = $category['name'];
                            $id    = $category['id'];
                            echo "<option value='$id'>$value</option>";
                        }
                        echo "</select>";
                    }
                    */
                    ?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary shadow">Delete Categories</button>
    </form>

    <form class="mt-5" action="/form/add-authors-for-book" method="POST">
        <h3>Add Authors</h3>
        <div class="form-group">
            <div class="row">
                <div class='col-md-6'>
                    <label>Authors:</label>
                    <?php
                    /*
                    if(empty($categories)) {
                        echo
                        '
                                <div class="alert alert-danger mt-3 shadow">
                                  You need to add a category
                                </div>
                                ';
                    } else {
                        echo "<select class='form-control col-md-6 shadow' name='categories[]' multiple required>";
                        foreach ($categories as $category) {
                            $value = $category['name'];
                            $id    = $category['id'];
                            echo "<option value='$id'>$value</option>";
                        }
                        echo "</select>";
                    }
                    */
                    ?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary shadow">Add Authors</button>
    </form>

    <form class="mt-5" action="/form/add-authors-for-book" method="POST">
        <h3>Delete Authors</h3>
        <div class="form-group">
            <div class="row">
                <div class='col-md-6'>
                    <label>Authors:</label>
                    <?php
                    /*
                    if(empty($categories)) {
                        echo
                        '
                                <div class="alert alert-danger mt-3 shadow">
                                  You need to add a category
                                </div>
                                ';
                    } else {
                        echo "<select class='form-control col-md-6 shadow' name='categories[]' multiple required>";
                        foreach ($categories as $category) {
                            $value = $category['name'];
                            $id    = $category['id'];
                            echo "<option value='$id'>$value</option>";
                        }
                        echo "</select>";
                    }
                    */
                    ?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary shadow">Delete Authors</button>
    </form>

</div>
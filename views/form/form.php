<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Forms add notes';
?>

<div class="container">
    <form action="/form/add-category" method="POST">
        <h3>Form for Category</h3>
        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" class="form-control shadow" id="category" name="category" placeholder="Enter Category" required>
        </div>
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
        <button type="submit" class="btn btn-primary shadow">Add a Category</button>
    </form>

    <form class="mt-5" action="/form/add-author" method="POST">
        <h3>Form for Author</h3>
        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" class="form-control shadow" id="author" name="author" placeholder="Enter Author" required>
        </div>
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
        <button type="submit" class="btn btn-primary shadow">Add a Author</button>
    </form>

    <!-- Форма для книг -->
    <form class="mt-5">
        <h3>Form for book</h3>
        <div class="form-group">
            <label for="bookTitle">Name Book:</label>
            <input type="text" class="form-control shadow" id="bookTitle" name="bookTitle" placeholder="Enter Name Book" required>
        </div>
        <div class="form-group">
            <label for="bookDescription">Description book:</label>
            <textarea class="form-control shadow" id="bookDescription" name="bookDescription" rows="4" placeholder="Enter Description Book" required></textarea>
        </div>
        <div class="form-group">
            <div class="row">
                <div class='col-md-6'>
                    <label>Choose Categories:</label>
                        <?php
                            if(empty($categories)) {
                                echo
                                '
                                <div class="alert alert-danger mt-3 shadow">
                                  You need to add a category
                                </div>
                                ';
                            } else {
                                echo "<select class='form-control col-md-6 shadow' name='categories' multiple required>";
                                foreach ($categories as $category) {
                                    $value = $category['name'];
                                    $id    = $category['id'];
                                    echo "<option value='$id'>$value</option>";
                                }
                                echo "</select>";
                            }
                        ?>
                </div>
                <div class='col-md-6'>
                    <label>Choose Authors:</label>
                        <?php
                        if(empty($authors)) {
                            echo
                            '
                                <div class="alert alert-danger mt-3 shadow">
                                  You need to add a author
                                </div>
                                ';
                        } else {
                            echo "<select class='form-control col-md-6 shadow' name='authors' multiple required>";
                            foreach ($authors as $author) {
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
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
        <button type="submit" class="btn btn-primary"
            <?php if(empty($categories) || empty($authors)){ echo "disabled";}?>
        >
            Save Book
        </button>
    </form>
</div>
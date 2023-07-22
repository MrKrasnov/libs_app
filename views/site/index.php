<?php

/** @var yii\web\View $this */

$this->title = 'Library';
?>
<div class="container">
    <div class="mt-1 mb-4">
        <div class="col-md-12">
            <form class="form-inline">
                <div class="form-group row">
                    <div class="col-md-9">
                        <input type="text" class="form-control shadow" id="searchInput" placeholder="Type in the name">
                    </div>
                    <div class="col-md-2">
                        <select class="form-control selectpicker shadow" data-live-search="true">
                            <option>Опция 1</option>
                            <option>Опция 2</option>
                            <option>Опция 3</option>
                            <option>Опция 4</option>
                            <option>Опция 5</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary shadow">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <?php
           echo renderBookCards($booksData);
        ?>
    </div>
</div>
<?php

function renderBookCards(array $booksData) : string
{
    if(empty($booksData)) {
        return "";
    }

    $booksCards = "";
    foreach ($booksData as $bookData) {
        $id         = $bookData['book_id'];
        $title      = $bookData['title'];
        $img        = $bookData['img'];
        $authors    = $bookData['authors'];
        $categories = $bookData['categories'];

        $booksCards .=
        "
        <div class='col-md-3 mb-4'>
            <div class='card shadow'>
                <div class='card-body'>
                    <h5 class='card-title'>$title</h5>
                    <img class='card-img' style='height: 420px;' src='$img' alt='book-img'>
                    <p class='card-text'><b>genres:</b> <i>$categories</i></p>
                    <p class='card-text'><b>authors:</b> <i>$authors</i></p>
                    <div class='d-flex justify-content-between align-items-center'>
                         <a href='site/index&id=$id' class='btn btn-outline-secondary btn-sm'>more</a>
                         <span class='small text-right'>#$id</span>
                     </div>
                </div>
            </div>
        </div>
        ";
    }

    return $booksCards;
}
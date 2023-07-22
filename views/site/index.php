<?php

/** @var yii\web\View $this */

$this->title = 'Library';
?>
<div class="container">
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
            <div class='card'>
                <div class='card-body'>
                    <h5 class='card-title'>$title</h5>
                    <img class='card-img' src='$img' alt='book-img'>
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
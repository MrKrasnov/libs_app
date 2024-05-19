<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Library';
?>
<div class="container">
    <div class="mt-1 mb-4">
        <div class="col-md-12">
            <form action="/site/index" class="form-inline">
                <div class="form-group row">
                    <div class="col-md-8 mb-1">
                        <input type="text" name='name-search'
                               value="<?php
                               $request = Yii::$app->request;
                               $recentSearch = $id = $request->get('name-search', '');
                               echo $recentSearch;
                               ?>"
                               class="form-control shadow" id="searchInput"
                               placeholder="Type in the name" required>
                    </div>
                    <div class="col-md-3 mb-1">
                        <select name="category" class="form-control selectpicker shadow" data-live-search="true">
                            <option>Name Book</option>
                            <option>Genre</option>
                            <option>Author</option>
                        </select>
                    </div>
                    <div class="col-md-1 mb-1">
                        <button id="submit-search" type="submit" class="btn btn-primary shadow">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <?php echo renderBookCards($booksData); ?>
    </div>
</div>
<?php

function renderBookCards(array $booksData) : string
{
    if(empty($booksData)) {
        return "<p>You don't have any books in your web library yet</p>";
    }

    $booksCards = "";
    foreach ($booksData as $bookData) {
        $id         = $bookData['book_id'];
        $title      = $bookData['title'];
        $img        = Url::to('@web/' . $bookData['img']);
        $authors    = $bookData['authors'];
        $categories = $bookData['categories'];
        $href       = Url::to('@web/' . "book/page?id=$id");

        $booksCards .=
        "
        <div class='col-xl-3 col-lg-4 col-md-6 col-12 mb-2'>
            <div class='card shadow'>
                <div class='card-body'>
                    <h5 class='card-title'>$title</h5>
                    <img class='card-img' style='height: 420px;' src='$img' alt='book-img'>
                    <p class='card-text'><b>genres:</b> <i>$categories</i></p>
                    <p class='card-text'><b>authors:</b> <i>$authors</i></p>
                    <div class='d-flex justify-content-between align-items-center'>
                         <a href='$href' class='btn btn-outline-secondary btn-sm'>more</a>
                         <span class='small text-right'>#$id</span>
                     </div>
                </div>
            </div>
        </div>
        ";
    }

    return $booksCards;
}
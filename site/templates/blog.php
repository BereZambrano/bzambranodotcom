<div id="main-content" class="blog" pw-append>

    <div class="posts-container uk-margin-large-top uk-container-large uk-container">
        <div class="uk-grid uk-grid-small" uk-grid="masonry:true;">
            <?php
            $limit = 6;
            $posts = $page->children("sort=sort, limit={$limit}");
            $total = ceil($posts->getTotal() / $limit);
            ?>
            <?php foreach ($posts as $post): ?>
            <?php $image = $post->getPostImage(500);?>
                <div class="uk-width-1-2 uk-width-1-3@m">
                    <div class="">
                        <a class="uk-link-reset" href="<?= $post->url ?>">
                            <img alt="<?= $image->description ?>"
                                 class="uk-width-1-1" width="500"
                                 src="<?= $image->url ?>" loading="lazy" uk-img>
                            <!-- <div class="uk-margin-small uk-text-center">
                                <h4><? /*= $post->title */ ?></h4>
                            </div>-->
                        </a>
                    </div>
                    <?php if (($input->pageNum + 1 <= $total) && $post == $posts->last()): ?>
                        <div class="uk-width-1-1 trigger"
                             hx-get="./page<?= $input->pageNum + 1 ?>"
                             hx-trigger="revealed"
                             hx-indicator="#spinner"
                             hx-target=".posts-container .uk-grid > div:last-child"
                             hx-select=".posts-container .uk-grid > div"
                             hx-swap="afterend">
                        </div>
                    <?php endif ?>
                </div>
            <?php endforeach ?>
        </div>
        <div id="spinner" class="htmx-indicator uk-text-center">
            <div uk-spinner></div>
        </div>
    </div>

</div>

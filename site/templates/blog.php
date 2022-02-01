<div id="main-content" class="blog" pw-append>

    <div class="posts-container uk-margin-large-top uk-container">
        <div class="uk-grid" uk-grid>
            <?php
            $limit = 6;
            $posts = $page->children("sort=sort, limit={$limit}");
            $total = ceil($posts->getTotal() / $limit);
            ?>
            <?php foreach($posts as $post):?>
            <div class="uk-width-1-3@m">
                <div class="">
                    <a class="uk-link-reset" href="<?=$post->url?>">
                    <img alt="<?=$post->getPostImage()->description?>"
                         class="uk-width-1-1" width="500"  height="500"
                         data-src="<?=$post->getPostImage()->size(500,500)->url?>" uk-img>
                    <div class="uk-margin-small uk-text-center">
                        <h4><?= $post->title ?></h4>
                    </div>
                    </a>
                </div>
            </div>
            <?php endforeach ?>
            <?php if($input->pageNum + 1 <= $total):?>
            <div class="uk-width-1-1 trigger"
                hx-get="./page<?=$input->pageNum + 1?>"
                hx-trigger="revealed"
                hx-indicator="#spinner"
                hx-select=".posts-container .uk-grid > div"
                hx-swap="afterend">
            </div>
            <?php endif ?>
        </div>
        <div id="spinner" class="htmx-indicator uk-text-center">
            <div uk-spinner></div>
        </div>
    </div>

</div>

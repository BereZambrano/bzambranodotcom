<div id="main-content" pw-append>
    <div class="uk-container uk-container-small uk-margin uk-margin-top">

        <?php if($page->content->count >= 1): ?>
        <?php foreach ($page->content as $item): ?>


            <?php if ($item->type == "headline"): ?>
                <div class="uk-flex uk-flex-right uk-margin-large-top">
                    <div class="uk-margin uk-width-3-5@m">
                        <h2><?= $item->title; ?></h2>
                    </div>
                </div>
                <hr class="">
            <?php endif ?>


            <?php if ($item->type == "text_modulo"): ?>
                <div class="">
                    <div class="">
                        <?= $item->text; ?>
                    </div>
                </div>
                <hr class="">
            <?php endif ?>


            <?php if ($item->type == "galeria_modulo"): ?>
                <?php if($item->galeria->count):?>
                    <div class="uk-margin-large-top uk-width-1-1@m">
                        <div uk-slideshow>
                            <ul class="uk-slideshow-items">
                                <?php foreach ($item->galeria as $image): ?>
                                    <li>
                                        <img src="<?= $image->url ?>" alt="<?= $image->description ?>"
                                             loading="lazy" uk-cover>
                                        <div class="uk-overlay uk-overlay-primary uk-position-bottom-center uk-text-center">
                                            <p class="uk-margin-remove"><?= $image->description ?></p>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <a class=" uk-position-small" href="#" uk-slidenav-previous
                               uk-slideshow-item="previous"></a>
                            <a class=" uk-position-small" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
                        </div>
                    </div>
                    <hr class="">
                <?php endif ?>
            <?php endif ?>
        <?php endforeach; ?>

        <?php else: ?>
            <?= $page->text ?>

        <?php endif; ?>

    </div>
</div>

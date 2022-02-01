<section class="uk-margin uk-width-1-1">
    <div class="uk-grid uk-child-width-1-<?= $page->columnas->title ?>@m" uk-grid>
        <?php foreach ($page->galeria as $img): ?>
            <div class="">
                <div class="uk-position-relative">
                    <a class="gallery-item" data-caption="<?= $img->description ?>" href="<?= $img->url ?>">
                        <?php if($img->ext == "gif"): ?>
                            <img width="<?=$img->width?>"
                                 height="<?=$img->height?>"
                                 data-src="<?=$img->url?>" alt="<?= $img->description ?>" uk-img>
                        <?php else: ?>
                        <img data-src="<?= $img->url ?>"
                             width="<?=$img->width?>"
                             height="<?=$img->height?>"
                             alt="<?= $img->description ?>"
                             data-srcset="<?= $img->srcset ?>"
                             uk-img>
                        <?php endif ?>
                    </a>
                    <p class="caption"><?= $img->description ?></p>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</section>

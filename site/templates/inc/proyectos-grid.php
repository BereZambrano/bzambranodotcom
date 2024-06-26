<?php namespace ProcessWire;?>

<section class="projects">
    <div class="uk-container uk-margin-medium-top">
        <?php
        $slices = array_chunk($projects, 4);
        ?>
        <?php foreach ($slices as $grid): ?>
            <div class="uk-grid uk-child-width-1-2@m" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 300" uk-grid>
                <?php foreach ($grid as $i => $item): ?>
                    <div class="<?= ($i + 1) % 2 == 0 ? "even" : "odd"; ?> uk-cover-container">
                        <a href="<?= $item->url ?>">
                            <?php
                            $header_image = $item->getHeaderImage();

                            if ($header_image):
                                ?>
                                <img width="500" height="333" class="uk-width-1-1"
                                     data-src="<?= $header_image->size(600, 433)->url ?>"
                                     uk-img>
                            <?php endif ?>
                        </a>
                        <div class="uk-margin-small project-name">
                            <a class="uk-link-reset" href="<?= $item->url ?>">
                                <h4 class="uk-h5 uk-text-bold uk-margin-remove"><?= $item->title ?></h4>
                            </a>
                            <p class="uk-margin-remove uk-text-primary uk-text-small">
                                <?php echo $item->servicios->implode(', ', 'title'); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endforeach ?>

    </div>
</section>

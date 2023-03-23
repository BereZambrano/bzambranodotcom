<?php namespace ProcessWire; ?>

<div id="main-content" class="proyecto uk-light uk-background-secondary" pw-append>
    <div class="">
            <section class="uk-container">
                <div class="uk-margin-large-top" uk-grid>
                    <div class="uk-width-4-5@m uk-margin-large-top">
                        <h2><?= $page->title ?></h2>
                    </div>

                    <div class="uk-margin-small-bottom uk-width-1-5@m uk-flex uk-flex-right uk-flex-bottom">
                        <?php echo $modules->MarkupSocialShareButtons->render(); ?>
                    </div>
                </div>

                <hr class="uk-margin-bottom">

                <div class="uk-container uk-margin-large-top">
                    <div class="uk-child-width-1-2 uk-flex uk-flex-column " uk-grid>
                        <div class="">
                            <h5 class="uk-margin-remove"><?= __("Cliente") ?>:</h5>
                            <h3 class="uk-margin-remove"><?= $page->cliente->title ?></h3>
                        </div>

                        <div class="">
                            <h5 class="uk-margin-remove"><?= __("Research tactics") ?>:</h5>
                            <h3 class="uk-margin-remove"><?= $page->research_tactics ?></h3>
                        </div>

                        <div class="">
                            <h5 class="uk-margin-remove"><?= __("Año") ?>:</h5>
                            <h3 class="uk-margin-remove"><?= $page->year ?></h3>
                        </div>
                    </div>
                </div>

                <div class="uk-flex uk-flex-right uk-margin-large-top">
                    <div class="uk-margin uk-width-3-5@m">
                        <?= $page->text ?>
                    </div>
                </div>

                <hr class="uk-margin-large-top uk-margin-large-bottom">

                <?php foreach ($page->content as $item): ?>
                    <?php if ($item->type == "text_modulo"): ?>
                        <div class="uk-flex uk-flex-right uk-margin-large-top">
                            <div class="uk-margin uk-width-3-5@m">
                                <?= $item->text; ?>
                            </div>
                        </div>
                    <?php endif ?>

                    <hr class="">

                    <?php if ($item->type == "galeria_modulo"): ?>
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
                    <?php endif ?>
                <?php endforeach; ?>
            </section>
    </div>

    <?php echo wireRenderFile('inc/other-case-studies.php'); ?>

    <hr>

    <?php echo wireRenderFile('inc/portfolio-projects-slider.php'); ?>

</div>



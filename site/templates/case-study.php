<?php namespace ProcessWire; ?>

<div id="main-content" class="proyecto " pw-append>
    <div class="uk-light uk-background-secondary">
        <div class="uk-container uk-container-small">
            <section class="">
                <h1 class="uk-padding uk-padding-remove-left uk-margin-remove">
                    <?= $page->title ?>
                </h1>

                <div class="">
                    <div class="uk-child-width-1-2 uk-text-small uk-flex uk-flex-column " uk-grid>
                        <div class="">
                            <h5 class="uk-text-small uk-text-bold uk-margin-remove"><?= __("Cliente") ?>:</h5>
                            <?= $page->cliente->title ?>
                        </div>

                        <div class="">
                            <h5 class="uk-text-small uk-text-bold uk-margin-remove"><?= __("Research tactics") ?>:</h5>
                            <?= $page->research_tactics ?>
                        </div>

                        <div class="">
                            <h5 class="uk-text-small uk-text-bold uk-margin-remove"><?= __("Año") ?>:</h5>
                            <?= $page->year ?>
                        </div>
                    </div>
                </div>

                <div class="uk-flex uk-flex-right">
                    <div class="uk-margin uk-width-3-5@m">
                        <?= $page->text ?>
                    </div>
                </div>
                <hr class="uk-divider">
            </section>

            <section class="">
                <?php foreach ($page->content as $item): ?>
                    <?php if ($item->type == "text_modulo"): ?>
                        <div class="uk-flex uk-flex-right">
                            <div class="uk-margin uk-width-3-5@m">
                                <?= $item->text; ?>
                            </div>
                        </div>
                    <?php endif ?>
                    <?php if ($item->type == "galeria_modulo"): ?>
                        <div class="uk-margin uk-width-1-1@m">
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
    </div>

    <?php echo wireRenderFile('inc/other-case-studies.php'); ?>

    <hr>

    <?php echo wireRenderFile('inc/portfolio-projects-slider.php'); ?>

</div>



<?php namespace ProcessWire; ?>

<div id="main-content" class="proyecto" pw-append>
    <div class="uk-light uk-background-secondary">
        <section class="uk-container">

            <div class="uk-margin-large-top">
                <a href="<?= $page->parent()->url ?>">
                    <img src="/site/templates/img/Arrow1.png" alt="Arrow1">
                </a>
            </div>

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
                            <h5 class="uk-margin-remove"><?= __("Research tactics & Methodologies") ?>:</h5>
                            <ul class="uk-list">
                                <?php foreach($page->research_tags as $item) {

                                    $url = $page->parent->url([
                                        'data' => [
                                            'tag' => $item->name
                                        ]
                                    ]);

                                    echo "<li><a href='$url'>$item->title</a></li>";
                                }
                                ?>
                            </ul>
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
                <hr class="uk-margin-large-top uk-margin-large-bottom">

                <?php foreach ($page->content as $item): ?>
                    <?php if ($item->type == "text_modulo"): ?>
                        <div class="uk-flex uk-flex-right uk-margin-large-top">
                            <div class="uk-margin uk-width-3-5@m">
                                <?= $item->text; ?>
                            </div>
                        </div>
                        <hr class="">
                    <?php endif ?>



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
                        <hr class="">
                    <?php endif ?>
                <?php endforeach; ?>


            <div class="tags-search uk-margin-large-bottom uk-margin-large-top">
                <div>
                    <p>TAG SEARCH</p>
                    <ul class="uk-subnav">
                        <?php foreach ($pages->find('template=research_tag') as $research_tags): ?>
                            <?php
                            $active_tag = ''; // initialize as empty
                            if ($input->get->tag) {
                                $active_tag = $input->get->tag; // set to tag name from URL parameter
                            }
                            $isActive = "";

                            if ($research_tags->name == $active_tag) {
                                $isActive = 'uk-active';
                            }
                            ?>
                            <li class="<?=$isActive?>">
                                <?php
                                $url = $page->parent->url([
                                    'data' => [
                                        'tag' => $research_tags->name
                                    ]
                                ]);
                                ?>
                                <a href="<?= $url; ?>">
                                    <?= $research_tags->title; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            </section>
    </div>

        <section class="uk-dark uk-background-muted">
        <?php echo wireRenderFile('inc/other-case-studies.php'); ?>
        </section>
</div>



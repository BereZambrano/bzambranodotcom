<?php namespace ProcessWire;
//if($page->content->count()
$header_image = $page->getHeaderImage();
?>
<div id="main-content" class="proyecto uk-background-secondary" pw-append>
    <section class="uk-margin">
        <div class="uk-light uk-container">

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
        </div>

        <div class="project-container uk-light  uk-margin uk-container">

            <!-- Project intro and info -->

            <div class="uk-margin-large">
                <img src="<?= $page->portada_proyecto->url ?>" alt="<?= $page->portada_proyecto->description ?>">

                <div class="uk-margin-medium uk-padding-small">
                    <div class="uk-margin-small-bottom">
                        <h5 class="uk-margin-remove"><?= __("Cliente") ?>:</h5>
                        <h3 class="uk-margin-remove"><?= $page->cliente->title ?></h3>
                    </div>

                    <div class="uk-margin-small-bottom">
                        <h5 class="uk-margin-remove"><?= __("Servicios") ?>:</h5>
                        <h3 class="uk-margin-remove">
                            <?php echo $page->servicios->implode("<br>", function ($item) {
                                //bd($item->title);
                                return "<a href='$item->url'>$item->title</a>";
                            }); ?>
                        </h3>
                    </div>

                    <div class="uk-margin-small-bottom">
                        <h5 class="uk-margin-remove"><?= __("Lugar") ?>:</h5>
                        <h3 class="uk-margin-remove"><?= $page->lugar ?></h3>
                    </div>

                    <div class="uk-margin-small-bottom">
                        <h5 class="uk-margin-remove"><?= __("Año") ?>:</h5>
                        <h3 class="uk-margin-remove"><?= $page->year ?></h3>
                    </div>

                </div>

                    <div class="uk-flex uk-flex-right">
                        <div class="uk-width-3-5@m">
                            <?= $page->text ?>
                        </div>

                    </div>

            </div>



            <div>
                <?php if($page->content->count()):?>
                    <?php echo $page->render('content');?>
                <?php else: ?>
                    <div class="uk-hidden@m uk-margin-top mobile-main-text">
                        <?=$page->text?>
                    </div>
                    <div class="uk-width-1-1"  uk-lightbox>
                        <div uk-grid>
                            <?php foreach ($images as $i => $image): ?>
                                <?php $i++; ?>
                                <div class="uk-width-1-1">
                                    <div class="uk-position-relative">
                                        <a data-caption="<?= $image->description ?>" href="<?= $image->url ?>">
                                            <?php if($image->ext == "gif"): ?>
                                                <img width="<?=$image->width?>" height="<?=$image->height?>"  data-src="<?= $image->url ?>"
                                                     alt="<?= $image->description ?>" uk-img>
                                            <?php else: ?>
                                                <img width="<?=$image->width?>" height="<?=$image->height?>"  data-src="<?= $image->url ?>"
                                                     alt="<?= $image->description ?>"
                                                     data-srcset="<?= $image->srcset ?>"
                                                     uk-img>
                                            <?php endif ?>
                                        </a>
                                        <p class="caption"><?= $image->description ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif ?>

                <div class="uk-grid uk-margin-large-top uk-child-width-1-<?= $page->columnas->title ?>@m" uk-grid
                     uk-lightbox>
                    <?php foreach ($page->galeria as $img): ?>
                        <div class="">
                            <div class="uk-position-relative">
                                <a data-caption="<?= $img->description ?>" href="<?= $img->url ?>">
                                    <img data-src="<?= $img->url ?>"
                                         alt="<?= $img->description ?>"
                                         data-srcset="<?= $img->srcset ?>"
                                         uk-img>
                                </a>
                                <p class="caption"><?= $img->description ?></p>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

            <!--<div class="uk-flex uk-flex-right">
                <div class="uk-width-3-5@m uk-margin-top">
                    <?php /*= $page->text_large */?>
                </div>
            </div>-->

        </div>
        <div class="uk-background-muted">
            <div class="proyectos-relacionados uk-container">
                <h3><?php echo __("Más proyectos")?></h3>
                <div class="uk-slider" uk-slider="autoplay:true;">
                    <div class="uk-position-relative">
                        <div class="uk-slider-container">
                            <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-4@m uk-grid uk-grid-small">
                                <?php foreach ($pages->find("template=proyecto, id!=$page") as $p): ?>
                                    <?php
                                    $related_header_image = $p->getHeaderImage();
                                    if(!$related_header_image) continue;
                                    ?>
                                    <li>
                                        <div class="uk-position-relative">
                                            <a href="<?=$p->url?>">
                                                <img class="uk-width-1-1"
                                                     data-src="<?= $related_header_image->size(300, 300)->url ?>"
                                                     alt="" uk-img>
                                                <div class="uk-position-cover uk-overlay slider-overlay uk-overlay-default ">
                                                    <div class="project-name uk-position-bottom-left uk-position-small">
                                                        <h4 class="uk-text-bold uk-margin-remove"><?= $p->title ?></h4>
                                                        <p class="uk-margin-remove uk-text"><?php echo $p->servicios->implode(', ', 'title'); ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                <?php endforeach ?>
                            </ul>

                            <!--<ul class="uk-slider-nav uk-flex-center uk-margin  uk-hidden@s uk-dotnav"></ul>-->


                        </div>
                        <a class="uk-position-center-left uk-light uk-hidden@m" href="#" uk-slidenav-previous  uk-slider-item="previous"></a>
                        <a class="uk-position-center-right uk-light uk-hidden@m"  href="#" uk-slidenav-next uk-slider-item="next" ></a>

                        <div class="uk-margin uk-flex-right uk-visible@m uk-slidenav-container">
                            <a href="#" uk-slidenav-previous  uk-slider-item="previous"></a>
                            <a href="#" uk-slidenav-next uk-slider-item="next" ></a>
                        </div>

                        <!--<div class="uk-visible@s">
                            <a class="uk-position-center-left-out uk-position-small" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                            <a class="uk-position-center-right-out uk-position-small" href="#" uk-slidenav-next uk-slider-item="next"></a>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>



<!--

<hr>
<div class="uk-margin-small-bottom">
    <p>¿Te gusta este proyecto? Compártelo en tus redes :)</p>
    <?php echo $modules->MarkupSocialShareButtons->render(); ?>
</div>
-->
<?php namespace ProcessWire;?>
<div id="main-content" class="proyecto" pw-append>

    <div class="post-container uk-margin-large-top uk-container">
        <!--<div>
            <div>
                <h1><?php /*= $page->title */?></h1>
            </div>
            <div>
                <?php /*echo $page->render('content');*/?>
            </div>
        </div>-->

        <div class=" uk-margin-top">
            <div class="uk-grid-collapse uk-child-width-1-2@m" uk-grid>
                <div class="uk-background-secondary blog-post-wrapper uk-light ">
                    <div class="uk-position-relative uk-height-1-1" uk-slideshow="animation: fade; " >
                        <ul class="uk-slideshow-items uk-cover-container uk-height-1-1">
                            <?php foreach ($page->content->findOne("type=galeria_modulo")->galeria as $image): ?>
                                <?php
                                // If smaller than 1, means its portrait, larger than 1 is landscape ;)
                                $adjust_class = $image->ratio() < 1 ? "uk-height-1-1" : "uk-width-1-1";
                                ?>
                                <li class="uk-flex uk-flex-middle uk-flex-center">
                                    <img loading="lazy"
                                         class="<?=$adjust_class?> uk-margin-auto uk-display-block"
                                         src="<?= $image->width(400)->url ?>"
                                         alt="<?= $image->description ?>" >
                                    <?php if($image->description):?>
                                        <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom">
                                            <p><?= $image->description ?></p>
                                        </div>
                                    <?php endif ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <a class="uk-position-center-left uk-position-small " href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small r" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
                        <!-- Slideshow Navigation -->
                    </div>

                </div>

                <!-- Right Column for Text and Social Media Links -->
                <div class="uk-background-default uk-height-large uk-overflow-auto uk-padding section-white">
                    <div>
                        <h4><?= $page->title ?></h4>
                        <!-- <p><?= $page->text ?></p> -->
                        <?php echo $page->content->findOne("type=text_modulo")->text ?>
                        <hr>
                        <!-- Social Media Links -->
                        <div class="uk-margin-top">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $page->httpUrl ?>" target="_blank" class="uk-icon-button uk-margin-small-right" uk-icon="facebook"></a>
                            <a href="https://twitter.com/intent/tweet?url=<?= $page->httpUrl ?>" target="_blank" class="uk-icon-button uk-margin-small-right" uk-icon="twitter"></a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $page->httpUrl ?>" target="_blank" class="uk-icon-button uk-margin-small-right" uk-icon="linkedin"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div div class="uk-grid uk-visible@m uk-flex-between uk-child-width-1-2" uk-grid>
            <?php if($page->prev()->id):?>
            <div class=" uk-child-width-1-3@m uk-flex-left uk-grid-small" uk-grid>
                <div>
                <a class="uk-link-reset" href="<?=$page->prev()->url?>">
                    <img alt="<?=$page->prev()->getPostImage()->description?>"
                         class="uk-width-1-1" width="360"  height="300"
                         data-src="<?=$page->prev()->getPostImage(400,340)->url?>"
                         uk-img>
                </a>
                </div>
                <div class="uk-margin-small uk-text-left">
                    <p><?= $page->prev()->title ?></p>
                </div>

            </div>
            <?php endif ?>

            <?php if($page->next()->id):?>
            <div class="uk-child-width-1-3@m uk-flex-right uk-grid-small uk-margin-remove-top" uk-grid>
                <div class="uk-margin-small uk-text-right">
                    <p><?= $page->next()->title ?></p>
                </div>
                <div>
                <a class="uk-link-reset" href="<?=$page->next()->url?>">
                    <img alt="<?=$page->next()->getPostImage()->description?>"
                         class="uk-width-1-1" width="360"  height="300"
                         data-src="<?=$page->next()->getPostImage(400,340)->url?>" uk-img>
                </a>
                </div>
            </div>
            <?php endif ?>
        </div>

        <div class="uk-hidden@m uk-grid uk-child-width-1-4@m uk-flex-between uk-child-width-1-2" uk-grid>
            <?php if($page->prev()->id):?>
                <div class="">
                    <a class="uk-link-reset" href="<?=$page->prev()->url?>">
                        <img alt="<?=$page->prev()->getPostImage()->description?>"
                             class="uk-width-1-1" width="400" height="340"
                             data-src="<?=$page->prev()->getPostImage(400,340)->url?>"
                             uk-img>
                        <div class="uk-margin-small uk-text-center">
                            <h5><?= $page->prev()->title ?></h5>
                        </div>
                    </a>
                </div>
            <?php endif ?>

            <?php if($page->next()->id):?>
                <div class="">
                    <a class="uk-link-reset" href="<?=$page->next()->url?>">
                        <img alt="<?=$page->next()->getPostImage()->description?>"
                             class="uk-width-1-1" width="400" height="340"
                             data-src="<?=$page->next()->getPostImage(400,340)->url?>" uk-img>
                        <div class="uk-margin-small uk-text-center">
                            <h5><?= $page->next()->title ?></h5>
                        </div>
                    </a>
                </div>
            <?php endif ?>
        </div>

    </div>

</div>

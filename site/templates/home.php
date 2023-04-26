<div id="main-content" pw-append>
    <!--Home_profile -->
    <section class="bio-section uk-height-large">
        <div class="uk-container uk-margin-large-top">
            <div class="uk-grid-small uk-flex-right@m uk-flex-center uk-grid" uk-grid>
                <div class="uk-flex uk-flex-right bio-pic uk-width-1-3 ">
                    <div>
                        <img src="<?= $home->image->size(150)->url ?>">
                    </div>
                </div>

                <div class="uk-width-2-3@m">
                    <div class="bio">
                        <?= $home->quien_home ?>
                    </div>
                </div>
            </div>
        </div>
    </section>



        <?php foreach($page->home_repeater as $item): ?>
                <div class="uk-container">
                    <div class="uk-margin-large-bottom uk-margin-large-top uk-width-1-3@m">
                        <?php if ($item->home_titles || $item->home_subtitles ): ?>
                            <div>
                                <?= $item->home_titles ?: ""; ?>
                                <?= $item->home_subtitles ?: ""; ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="uk-container uk-container-large uk-padding-remove">
                    <?php if($item->home_images): ?>
                            <div>
                            <picture>
                                <source media="(max-width:959px)" srcset="<?= $item->home_images->size(800, 600)->url ?>">
                                <source media="(min-width:960px)" srcset="<?= $item->home_images->size(1800, 900)->url ?>">
                                <img alt="<?= $item->home_images->description ?>" class="uk-width-1-1" src='<?= $item->home_images->url ?>' loading="lazy">
                            </picture>
                        </div>
                    <?php endif ?>
                </div>
                <?php if($item->home_texts): ?>
                <div class="uk-container uk-flex-column">
                    <div class="uk-flex uk-margin-large-top uk-flex-right">
                        <div class=" uk-width-2-5@m  ">
                            <div class="">
                                <?= $item->home_texts; ?>
                                <div class="uk-margin-medium-top uk-margin-large-bottom">
                                    <a class="button uk-button" href="">Services</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
            <hr class="uk-margin-large-top">
        <?php endforeach; ?>

    </div>
</div>

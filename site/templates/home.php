<div id="main-content" pw-append>
    <!--Home_profile -->
    <section class="bio-section uk-height-large">
        <div class="uk-container uk-container-small uk-margin-large-top">
            <div class="uk-grid-small uk-grid" uk-grid>
                <div class="uk-flex uk-flex-right bio-pic uk-width-1-3 ">
                    <img src="<?= $home->image->size(150)->url ?>">
                </div>

                <div class="">
                    <div class="bio uk-flex">
                        <?= $home->quien_home ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="uk-container uk-flex-column">
        <!--First repeater-->
        <?php foreach($page->home_repeater as $item): ?>
            <div class="uk-container-small">
                <div class="uk-margin-large-bottom uk-margin-large-top uk-width-1-3@ " uk-grid>
                    <div>
                        <?= $item->home_titles; ?>
                        <?= $item->home_subtitles; ?>
                    </div>
                </div>
            </div>
            <div class="">
                <?php if($item->home_images): ?>
                    <div class="uk-flex-right">
                        <picture>
                            <source media="(max-width:959px)" srcset="<?= $item->home_images->size(800, 600)->url ?>">
                            <source media="(min-width:960px)" srcset="<?= $item->home_images->size(1800, 900)->url ?>">
                            <img alt="<?= $item->home_images->description ?>" class="uk-width-1-1" src='<?= $item->home_images->url ?>' loading="lazy">
                        </picture>
                    </div>
                <?php endif ?>

                <div class="uk-flex uk-margin-large uk-flex-right uk-height-large">
                    <div class="uk-flex uk-width-4-5@m uk-flex-center uk-flex-wrap">
                        <div class="uk-width-3-5@m">
                            <?= $item->home_texts; ?>

                            <div class="uk-margin-medium-top">
                                <a class="button uk-button" href="">Services</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
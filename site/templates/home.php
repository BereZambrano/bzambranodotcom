<div id="main-content" pw-append>
    <!--Home_profile -->
    <section  class="uk-margin-large uk-margin-xlarge-top bio-section">
        <div class="uk-container uk-margin-large-top">
            <div uk-scrollspy="cls: uk-animation-slide-top-small; target: > div; delay: 300; repeat: true"
                 class="uk-grid-small uk-flex-middle uk-flex-right@m uk-flex-center uk-grid" uk-grid>
                <div class="uk-flex uk-flex-right bio-pic uk-width-2-5 ">
                    <div>
                        <img class="uk-margin-right" src="<?= $home->image->url ?>">
                    </div>
                </div>

                <div class="uk-width-3-5@m">
                    <div class="bio">
                        <?= $home->quien_home ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div>
        <?php
        $last = $page->home_repeater->last();
        foreach($page->home_repeater as $item): ?>
                <div class="uk-container uk-container-large">
                    <div class="uk-margin-large-bottom uk-margin-large-top uk-width-1-2@m">
                        <?php if ($item->home_titles || $item->home_subtitles ): ?>
                            <div>
                                <?= $item->home_titles ?: ""; ?>
                                <?= $item->home_subtitles ?: ""; ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <?php if($item->home_images): ?>
                    <div class="uk-container uk-container-large uk-margin-large-bottom ">
                        <div>
                            <picture>
                                <source media="(max-width:959px)" srcset="<?= $item->home_images->size(800, 600)->url ?>">
                                <source media="(min-width:960px)" srcset="<?= $item->home_images->size(1800, 900)->url ?>">
                                <img alt="<?= $item->home_images->description ?>" class="uk-width-1-1 uk-border-rounded" src='<?= $item->home_images->url ?>' loading="lazy">
                            </picture>
                        </div>
                    </div>
                <?php endif ?>

            <?php if($item->home_texts): ?>
                <div class="uk-container uk-container-large uk-flex-column">
                    <div class="uk-flex uk-flex-right">
                        <div class="text-column-wrapper">
                            <div class="">
                                <?= $item->home_texts; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($item !== $last):?>
                    <div class="uk-container uk-container-large uk-margin-large-top">
                        <hr>
                    </div>
                <?php endif ?>
            <?php endif ?>
        <?php endforeach; ?>
    </div>
</div>

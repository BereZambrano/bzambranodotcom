<?php namespace ProcessWire;?>

<section class="testimonials uk-container uk-container-large uk-margin-xlarge-top">

        <div class="uk-width-3-5@m">
            <h2>
                <?=__("Testimonials and mentions")?>
            </h2>
        </div>

        <?php foreach($pages->find("template=servicios") as $project): ?>

            <div class="uk-width-4-5@m uk-margin-auto uk-margin-large-top">

                <div class="uk-flex">
                    <div class="uk-margin-top uk-width-1-1 uk-slider" uk-slider="autoplay: true">

                        <div class="uk-position-relative">

                            <a class="uk-visible@l uk-position-small uk-position-center-left-out" href="#"
                               uk-slider-item="previous">
                                <span class="uk-icon-button" uk-icon="icon: chevron-left; ratio:1.2;"></span>
                            </a>
                            <a class="uk-visible@l uk-position-small uk-position-center-right-out" href="#"
                               uk-slider-item="next">
                                <span class="uk-icon-button" uk-icon="icon: chevron-right; ratio:1.2;"></span>
                            </a>


                            <div class="uk-slider-container">

                                <div class="uk-position-top-right uk-position-small uk-position-z-index">
                                    <div class="uk-flex-right uk-hidden@l uk-slidenav-container">
                                        <a class="uk-margin-small-right" href="#" uk-slider-item="previous">
                                            <span class="uk-icon-button"
                                                  uk-icon="icon: chevron-left; ratio:1.2;"></span>
                                        </a>
                                        <a class="" href="#" uk-slider-item="next">
                                            <span class="uk-icon-button"
                                                  uk-icon="icon: chevron-right; ratio:1.2;"></span>
                                        </a>
                                    </div>
                                </div>

                                <ul class="uk-grid uk-slider-items">
                                    <?php foreach ($project->testimonial as $item): ?>
                                        <li class="uk-width-1-1">
                                            <div class="uk-card testimonial-card uk-card-body uk-card-large uk-card-default">
                                                <div class="uk-width-1-1@m uk-margin-auto">
                                                    <div class="uk-card-title">
                                                        <?= $item->testimonial_name ?>
                                                    </div>
                                                    <hr class="uk-margin-small">
                                                    <div>
                                                        <?= $item->testimonial_detail ?>
                                                    </div>
                                                    <div class="testimonial-card-main-text">
                                                        <?= $item->testimonial_tweet ?>
                                                    </div>
                                                    <?php if ($item->mention_link): ?>
                                                        <div class="uk-margin-auto">
                                                            <a href="<?= $item->mention_link ?>">
                                                                <button class="uk-button uk-button-text"><?= $item->mention_link ?></button>
                                                            </a>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        <?php endforeach; ?>
</section>

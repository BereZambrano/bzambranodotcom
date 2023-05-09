

<section class="testimonials uk-container uk-margin-large-top">

        <div class="uk-width-3-5@m">
            <h2>Testimonials and mentions.</h2>
        </div>

        <?php foreach($pages->find("template=servicios") as $project): ?>

            <div class="uk-margin-large-top">

                <div class="uk-slider" uk-slider="autoplay: true">

                    <div class="uk-position-relative">
                        <div style="top: -50px;" class="uk-position-top-right">
                            <div class="uk-slidenav-container">
                                <a class="" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                                <a class="" href="#" uk-slidenav-next uk-slider-item="next"></a>
                            </div>
                        </div>
                        <div class="uk-slider-container">
                            <ul class="uk-grid uk-slider-items">
                                <?php foreach($project->testimonial as $item): ?>
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

                                                <div class="uk-margin-auto">
                                                    <a href="<?= $item->mention_link ?>">
                                                        <button class="uk-button uk-button-text"><?= $item->mention_link ?></button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        <?php endforeach; ?>
</section>
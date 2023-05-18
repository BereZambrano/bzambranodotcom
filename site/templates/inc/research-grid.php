<div class="uk-margin uk-container">

    <ul class="uk-list uk-list-divider uk-list-large">
        <?php foreach($case_studies as $study): ?>
            <?php $content_gallery=$study->content->get("type=galeria_modulo, galeria.count>0"); ?>
            <li>
                <div class="testimonials-wrapper uk-margin-auto">
                    <div class="testimonial-card" uk-grid>
                        <div class="uk-width-3-5@m">

                                <div class="uk-card-title">
                                    <a class="uk-link-reset"
                                       href="<?=$study->url?>">
                                        <h3 class="uk-h4"><?=$study->title?></h3>
                                    </a>
                                </div>

                                <div class="">
                                    <p>
                                        <?= $sanitizer->truncate($study->text_large, [
                                          'type'      => 'punctuation',
                                          'maxLength' => 180,
                                          'visible'   => true,
                                          'more'      => '…'
                                        ]); ?>
                                    </p>
                                </div>

                        </div>

                        <?php if($content_gallery->id): ?>
                            <div class="uk-width-2-5@m">
                                <a class="uk-link-reset"
                                   href="<?=$study->url?>">
                                    <img class="uk-width-1-1" src="<?= $content_gallery->galeria->first->size(250, 250)->url ?>" loading="lazy" alt="">
                                </a>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
</div>


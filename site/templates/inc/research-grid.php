<div class="uk-margin uk-container">

    <ul class="uk-list uk-list-divider uk-list-large">
        <?php foreach($case_studies as $study): ?>
            <?php $content_gallery=$study->content->get("type=galeria_modulo, galeria.count>0"); ?>
            <li>
                <div class="testimonials-wrapper uk-margin-auto">
                    <div class="testimonial-card" uk-grid>
                        <div class="uk-width-3-5@m">
                            <div class="uk-card-title">
                                <h3><?=$study->title?></h3>
                            </div>

                            <div class="">
                                <p><?=$study->text_large?></p>
                            </div>
                        </div>

                        <?php if($content_gallery->id): ?>
                            <div class="uk-width-2-5@m uk-flex uk-flex-right">
                                <img class="uk-width-1-1" src="<?= $content_gallery->galeria->first->size(250, 250)->url ?>" loading="lazy" alt="">
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
</div>


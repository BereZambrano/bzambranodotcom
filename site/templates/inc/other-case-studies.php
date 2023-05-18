<?php namespace ProcessWire;?>
<div class="uk-margin-large-bottom uk-margin-large-top uk-container">
    <div class="uk-margin-large-bottom">
        <h2><?=__("More case studies")?></h2>
    </div>

    <ul class="uk-list uk-list-divider uk-list-large">
        <?php foreach($pages->find("template=case-study, id!={$page->id}") as $study): ?>
        <?php
            /** @var RepeaterMatrixPage $content_gallery */
            $content_gallery = $study->content->get("type=galeria_modulo, galeria.count>0");
        ?>
            <li>
                <div class="testimonials-wrapper uk-margin-auto">
                    <div class="testimonial-card" uk-grid>
                        <div class="uk-width-3-5@m">
                            <div class="uk-link-reset uk-card-title">
                                <a href="<?=$study->url?>">
                                    <h3 class="uk-h4"><?=$study->title?></h3>
                                </a>
                            </div>

                            <div class="large-paragraph">
                                <p>
                                <?= $sanitizer->truncate($case->text_large, [
                                  'type'      => 'punctuation',
                                  'maxLength' => 130,
                                  'visible'   => true,
                                  'more'      => '…'
                                ]); ?>
                                </p>
                            </div>
                        </div>
                        <?php if($study->thumbnail):?>
                            <div class="uk-width-2-5@m uk-flex uk-flex-right">
                                <img class="uk-width-1-1" src="<?= $study->thumbnail->size(250, 250)->url ?>" loading="lazy" alt="<?= $study->thumbnail->description ?>">
                            </div>
                        <?php else:?>
                            <?php if($content_gallery->id):?>
                                <div class="uk-width-2-5@m uk-flex uk-flex-right">
                                    <img class="uk-width-1-1" src="<?= $content_gallery->galeria->first->size(250, 250)->url ?>" loading="lazy" alt="">
                                </div>
                            <?php endif ?>
                        <?php endif ?>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
</div>


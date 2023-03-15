<region id="main-content" pw-append>

    <section class="uk-container-large uk-flex uk-flex-center">
            <div class="uk-margin-large-left uk-margin-large-bottom uk-margin-large-top">
                <div>
                    <?= $page->first_intro; ?>
                </div>
            </div>
    </section>

    <hr class="uk-divider">

    <section class="uk-container uk-margin-large-top">
        <div class="uk-grid" uk-grid>
            <div class="uk-width-2-3@m">
             <?php
             $case_studies = $pages->find('template=case-study, limit=3');
             ?>
             <?php
             foreach($case_studies as $case): ?>
                 <?php $case->content->find("type=galeria_modulo, galeria.count>0");
                 $content_gallery=$case->content->get("type=galeria_modulo, galeria.count>0");
                 ?>
                 <div class="uk-flex uk-flex-center">
                     <div class="uk-width-2-3@m uk-margin-large">
                         <div class="uk-grid uk-grid-small uk-flex uk-flex-middle uk-child-width-expand@s" uk-grid>
                             <div class="uk-width-1-2@m uk-flex uk-flex-column uk-text-small" uk-height-match>
                                 <div class="uk-text-small">
                                     <?= $case->title; ?>
                                 </div>
                                 <div>
                                     <?= $case->text_large; ?>
                                 </div>
                             </div>

                             <?php if($content_gallery->galeria->first()): ?>
                             <div class="uk-width-1-2@m">
                                 <div>
                                     <picture class="uk-height-match">
                                         <source media="(max-width:959px)" srcset="<?= $content_gallery->galeria->first()->size(500, 500)->url ?>">
                                         <source media="(min-width:960px)" srcset="<?= $content_gallery->galeria->first()->size(500, 500)->url ?>">
                                         <img src='<?= $content_gallery->galeria->first->size(500, 500)->url ?>' loading="lazy">
                                     </picture>
                                 </div>
                             </div>
                             <?php endif ?>
                         </div>
                     </div>
                     <hr class="uk-divider">
                 </div>
                <?php endforeach; ?>

            </div>

            <div class="uk-width-1-3@m">
                <div uk-sticky="offset: 100; end:true">
                <h2>Prueba de espacio</h2>
                </div>
            </div>
        </div>

            <!--For social projects-->
        <div class="uk-container uk-flex-center uk-flex uk-flex-column">
                <div class="uk-container-small">
                    <div class="uk-margin-large-left uk-margin-large-top uk-width-1-3@ " uk-grid>
                        <div>
                            <?= $page->second_intro; ?>
                        </div>
                    </div>
                </div>
                    <div class="uk-flex uk-margin-large uk-flex-right uk-height-large">
                        <div class="uk-flex uk-width-4-5@m uk-flex-center uk-flex-wrap">
                            <div class="uk-width-3-5@m">
                                <?= $page->text_large; ?>
                                <div class="uk-margin-medium-top">
                                    <a class="button uk-button" href="">Services</a>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>


    </section>


</region>








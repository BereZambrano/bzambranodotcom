<?php namespace ProcessWire; ?>
<div id="main-content" class="uk-light about-me-wrapper uk-background-secondary" pw-append>
    <div class="uk-container uk-container-small">
        <div class="uk-grid uk-flex-between uk-grid-small" uk-grid>
            <div class="uk-width-2-5@m">
                <?= $page->text ?>
            </div>

            <div class="uk-flex-1">
                <div class="uk-flex uk-flex-center uk-flex-wrap">
                    <div class="uk-text-center uk-width-1-1 bio-pic">
                        <img src="<?= $home->image->width(200)->url ?>">
                    </div>
                    <ul class="uk-margin-top uk-iconnav">
                        <?php foreach ($home->social_media as $icon): ?>
                            <li>
                                <a target="_blank" href="<?= $icon->url_address ?>"
                                   uk-icon="icon: <?= $icon->title ?>"></a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="uk-margin-large">
        <div class="uk-child-width-1-2@m done-work uk-grid" uk-grid>
            <div>
                <div class="experiencia uk-margin-remove-last-child">
                    <h3>Experiencia</h3>
                    <?php foreach ($page->experiencia as $e): ?>
                        <div class="uk-margin uk-margin-remove-last-child">
                            <?= $e->text ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
           <div class="uk-hidden@m">
               <hr class="uk-margin-large ">
           </div>
            <div>
                <div class="publicaciones uk-margin-remove-last-child">
                    <h3>Publicaciones</h3>
                    <?php foreach ($page->publicaciones as $e): ?>
                        <div class="uk-margin uk-margin-remove-last-child">
                            <?= $e->text ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <hr class="uk-margin-large">
        <?php $clientes_parent = $pages->get('/clientes/'); ?>
        <div class="">
            <h3><?php echo __("Client*s destacad*s"); ?></h3>
            <div class="uk-child-width-1-3@m uk-child-width-1-2 uk-grid-small uk-grid " uk-grid>
                <!--
                <?php foreach ($clientes_parent->clientes_logos as $logo): ?>
                    <div>
                        <?php if ($logo->url_address): ?>
                            <a href="<?= $logo->url_address ?>">
                                <img width="<?= $logo->width ?>" height="<?= $logo->height ?>"
                                     data-src="<?= $logo->url ?>" uk-img>
                            </a>
                        <?php else: ?>
                            <img width="<?= $logo->width ?>" height="<?= $logo->height ?>" data-src="<?= $logo->url ?>"
                                 uk-img>
                        <?php endif ?>
                    </div>
                <?php endforeach; ?>
                -->
                <?php
                $clientes = $clientes_parent->children();
                bd($clientes);
                ?>
                <?php foreach ($clientes as $cliente): ?>
                    <div>
                        <?php if ($cliente->url_address): ?>
                            <a href="<?= $cliente->url_address ?>">
                                <?= $cliente->title ?>
                            </a>
                        <?php else: ?>
                            <?= $cliente->title ?>
                        <?php endif ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="uk-margin-large">
            <h3><?php echo __("Colaborador*s") ?></h3>

            <div class="uk-child-width-1-3@m  uk-grid-small uk-grid" uk-grid>

                <?php foreach ($clientes_parent->colaboradores as $colaborador): ?>
                    <div>
                        <?php if ($colaborador->url_address): ?>
                            <a href="<?= $colaborador->url_address ?>">
                                <?= $colaborador->name ?>
                            </a>
                        <?php else: ?>
                            <?= $colaborador->name ?>
                        <?php endif ?>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

    </div>

</div>

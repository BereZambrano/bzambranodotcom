<?php

namespace ProcessWire;

$clientes_parent = $pages->get('/clientes/');

?>
<div id="main-content" class="uk-light about-me-wrapper uk-background-secondary" pw-append>

    <!-- Intro 1 -->
    <div class="uk-container">

        <div class="uk-grid uk-flex-center uk-grid-large" uk-grid>
            <div class="uk-flex-left uk-width-expand">
                <?= $page->text ?>
            </div>

            <div class="uk-flex uk-flex-wrap uk-width-2-5@m">
                <div class="uk-width-1-1 uk-flex uk-flex-center">
                    <img class="uk-width-1-1" src="<?= $page->image_about1->width(368)->height(471)->url ?>">
                </div>
            </div>
        </div>

        <!-- Intro 2-->
        <div class="uk-flex uk-margin-large uk-flex-right">

            <div class="uk-flex uk-width-4-5@m uk-flex-center uk-flex-wrap">
                <div class="uk-width-1-1">
                    <img class="uk-width-1-1" src="<?= $page->image_about2->width(806)->height(537)->url ?>">
                </div>
                <div class="uk-margin-medium top uk-width-3-5@m">
                    <?= $page->text_secondary_about ?>
                </div>
            </div>
        </div>

        <!-- Experience title-->
        <div class="uk-margin-large">
            <?= $page->experience_title ?>
        </div>


        <div class="uk-flex uk-margin-large uk-flex-right">

            <div class="uk-flex uk-width-4-5@m uk-flex-center uk-flex-wrap">

                <div class="uk-margin-medium top uk-width-3-5@m">
                    <?= $page->experience_intro ?>


                    <!-- Experiencia -->
                    <div class="uk-child-width-1-2@m done-work uk-grid uk-margin-large" uk-grid>
                        <div>
                            <div class="experiencia uk-margin-remove-last-child">
                                <h3 class="uk-h5">Experiencia</h3>
                                <?php foreach ($page->experiencia as $e) : ?>
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
                                <h3 class="uk-h5" >Publicaciones</h3>
                                <?php foreach ($page->publicaciones as $e) : ?>
                                    <div class="uk-margin uk-margin-remove-last-child">
                                        <?= $e->text ?>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>

                    <!-- Last grid with research, clients and collaborators in it-->

                    <div class="uk-grid uk-child-width-1-2" uk-grid>
                        <div>
                            <div class="uk-grid uk-child-width-1-1" uk-grid>

                                <!-- Research -->
                                <div class="research uk-margin-large">
                                    <h3 class="uk-h5">Research</h3>
                                    <div class="uk-grid uk-child-width-1-1 uk-grid-small" uk-grid>
                                        <?php foreach ($page->research as $e) : ?>
                                            <div class="uk-margin-remove-last-child">
                                                <?= $e->text ?>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>

                                <!-- Colaboradores -->
                                <div class="uk-margin-large">
                                    <h3 class="uk-h5"><?php echo __("Colaborador*s") ?></h3>
                                    <div class="uk-grid-small uk-child-width-1-1 uk-grid" uk-grid>
                                        <?php foreach ($clientes_parent->colaboradores as $colaborador) : ?>
                                            <div class="">
                                                <?php if ($colaborador->url_address) : ?>
                                                    <a href="<?= $colaborador->url_address ?>">
                                                        <?= $colaborador->name ?>
                                                    </a>
                                                <?php else : ?>
                                                    <?= $colaborador->name ?>
                                                <?php endif ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Clientes -->
                        <div>
                            <h3 class="uk-h5"><?php echo __("Client*s destacad*s"); ?></h3>

                            <div class="uk-grid uk-grid-small uk-child-width-1-1" uk-grid>
                                <?php
                                $clientes = $clientes_parent->children();
                                ?>
                                <?php foreach ($clientes as $cliente) : ?>
                                    <div>
                                        <?php if ($cliente->url_address) : ?>
                                            <a href="<?= $cliente->url_address ?>">
                                                <?= $cliente->title ?>
                                            </a>
                                        <?php else : ?>
                                            <?= $cliente->title ?>
                                        <?php endif ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
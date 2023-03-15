<?php

namespace ProcessWire;

$clientes_parent = $pages->get('/clientes/');

?>
<div id="main-content" class="about-me-wrapper" pw-append>
    <!-- First container -->
    <!-- Intro 1 -->
    <div class="uk-container">
        <div class="uk-grid uk-flex-center" uk-grid>
            <div class="">
                <?= $page->first_intro ?>
            </div>

            <div class="uk-flex uk-flex-wrap uk-flex-right uk-width-2-5@m">
                <div class="uk-width-1-1 uk-flex uk-flex-center">
                    <img class="uk-width-1-1" src="<?= $page->about_pic1->width(368)->height(471)->url ?>">
                </div>
            </div>
        </div>

        <!-- Intro 2-->
        <div class="uk-flex uk-margin-large uk-flex-right">

            <div class="uk-flex uk-width-4-5@m uk-flex-center uk-flex-wrap">
                <div class="uk-width-1-1">
                    <img class="uk-width-1-1" src="<?= $page->about_pic2->width(806)->height(537)->url ?>">
                </div>
                <div class="uk-text-left uk-width-1-1@m">
                    <?= $page->about_pic2->description ?>
                </div>
            </div>
        </div>

        <!-- Intro text-->

        <div class="uk-flex uk-margin-large uk-flex-right">

            <div class="uk-flex uk-width-4-5@m uk-flex-center uk-flex-wrap">

                <div class=" uk-width-3-5@m ">

                    <div class="uk-margin-large-bottom">
                        <?= $page->experiencia_intro ?>
                    </div>

                    <!-- Service section -->
                    <div class="uk-child-width-1-1@m uk-margin-medium-top " >
                        <p class="uk-text-bold">Things I do</p>
                        <?= $page->text ?>
                    </div>

                    <!-- Service button -->
                    <div class="">
                        <a class="button uk-button" href="">Services</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second container-->
    <!--second text-->
    <div class="uk-container">
        <div class="uk-flex uk-flex-center">
            <div class="uk-container-small uk-margin-large-top">
                <div class="">
                    <?= $page->second_intro ?>
                </div>
            </div>
        </div>
        <div class="uk-grid uk-grid-large" uk-grid>
            <!-- Experiencia -->
            <div class="uk-flex uk-margin-large uk-flex-right">
                <div class="uk-flex uk-width-4-5@m uk-flex-center uk-flex-wrap">
                    <div class=" uk-width-3-5@m ">

                        <div class="uk-child-width-1-2@m done-work uk-grid uk-margin-large-top" uk-grid>
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

                        <div class="uk-margin-large-top">
                            <a class="button uk-button" href="">Case Studies</a>
                            <div class="uk-margin-top">
                                <a class="button uk-button" href="">Portfolio</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!--
<ul class="uk-margin-top uk-iconnav">
    <?php foreach ($home->social_media as $icon): ?>
        <li>
            <a target="_blank" href="<?= $icon->url_address ?>"
               uk-icon="icon: <?= $icon->title ?>"></a>
        </li>
    <?php endforeach ?>
</ul>
-->
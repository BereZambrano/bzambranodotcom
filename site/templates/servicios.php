<?php namespace ProcessWire; ?>


<div id="main-content" class=" uk-margin-top uk-flex uk-flex-center" pw-append> 
    <div class="service_intro uk-container uk-container-small uk-flex uk-flex-column">
        
            <div class="first_title uk-margin-top uk-width-2-3@m">
                <?= $page->first_title?>
            </div>

           
            <div class="first_title uk-width-2-3 uk-margin-auto-left">
                <?= $page->second_title?>
            </div>

            <div class="service_section uk-margin-top">
                <div class="uk-margin-top">
                    <?= $page->text?>
                </div>  
            </div>

            <ul class="uk-list-divider" uk-accordion>
                <?php foreach($page->children as $child) : ?>
                <li>
                    <a class="uk-accordion-title" href="#">
                        <?= $child->title ?>
                    </a>
                    <div class="uk-accordion-content">
                        <?= $child->text ?>
                    </div>
                    <?php $proyectos_por_servicio = $pages->find("template=proyecto, servicios=$child, limit=6") ?>
                <?php endforeach; ?>
                </li>
            </ul>
    </div> 
</div>

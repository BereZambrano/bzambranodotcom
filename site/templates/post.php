<?php namespace ProcessWire;?>
<div id="main-content" class="proyecto" pw-append>

    <div class="post-container uk-margin-large-top uk-container-small uk-container">
        <div>
            <div>
                <h1><?= $page->title ?></h1>
            </div>
            <div>
                <?php echo $page->render('content');?>
            </div>
        </div>
        <hr>
        <div div class="uk-grid uk-child-width-1-4@m uk-flex-between uk-child-width-1-2" uk-grid>
            <?php if($page->prev()->id):?>
            <div class="">
                <a class="uk-link-reset" href="<?=$page->prev()->url?>">
                    <img alt="<?=$page->prev()->getPostImage()->description?>"
                         class="uk-width-1-1" width="400"  height="340"
                         data-src="<?=$page->prev()->getPostImage(400,340)->url?>"
                         uk-img>
                    <div class="uk-margin-small uk-text-center">
                        <h4><?= $page->prev()->title ?></h4>
                    </div>
                </a>
            </div>
            <?php endif ?>

            <?php if($page->next()->id):?>
            <div class="">
                <a class="uk-link-reset" href="<?=$page->next()->url?>">
                    <img alt="<?=$page->next()->getPostImage()->description?>"
                         class="uk-width-1-1" width="400"  height="340"
                         data-src="<?=$page->next()->getPostImage(400,340)->url?>" uk-img>
                    <div class="uk-margin-small uk-text-center">
                        <h4><?= $page->next()->title ?></h4>
                    </div>
                </a>
            </div>
            <?php endif ?>
        </div>
    </div>

</div>

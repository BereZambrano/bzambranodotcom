<div id="main-content" pw-append>

    <section class="bio-section uk-margin-top">
        <div class="uk-container uk-container-xsmall">
            <div class="uk-flex-middle uk-grid-small uk-flex-center uk-child-width-1-3@m uk-grid" uk-grid>
                <div class="uk-text-center bio-pic">
                    <img src="<?= $home->image->width(200)->url ?>">
                </div>
                <div>
                    <div class="bio">
                        <?= $home->quien_home ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php echo  wireRenderFile('inc/proyectos-grid', ['projects' => $pages->find('template=proyecto, sort=sort')->getArray()]);?>

</div>

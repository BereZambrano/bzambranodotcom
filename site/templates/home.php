<div id="main-content" pw-append>


    <section class="bio-section uk-margin-top">


        <ul uk-accordion>
            <li class="uk-open">
                <a class="uk-accordion-title" href="#">Item 1</a>
                <div class="uk-accordion-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </li>
            <li>
                <a class="uk-accordion-title" href="#">Item 2</a>
                <div class="uk-accordion-content">
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor reprehenderit.</p>
                </div>
            </li>
            <li>
                <a class="uk-accordion-title" href="#">Item 3</a>
                <div class="uk-accordion-content">
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat proident.</p>
                </div>
            </li>
        </ul>

        <div class="uk-container uk-container-xsmall">
            <div class="uk-flex-middle uk-grid-small uk-flex-center uk-grid" uk-grid>
                <div class="uk-text-center bio-pic uk-width-1-5">
                    <img src="<?= $home->image->width(120)->url ?>">
                </div>

                <div class="bio uk-width-1-2">
                    <p> <?= $home->text ?> </p>
                </div>

            </div>
            <div class="">
                <div class="bio uk-flex uk-flex-center">
									<?= $home->quien_home ?>
                </div>
            </div>
        </div>
    </section>
	<?php // echo  wireRenderFile('inc/proyectos-grid', ['projects' => $pages->find('template=proyecto, sort=sort')->getArray()]);?>

	<?php $projects = $pages->find('template=proyecto, limit=5, sort=sort'); ?>
    <div class="home-portfolio">
        <?php foreach ($projects as $i => $project): ?>
          <div class="">
              <a href="<?= $project->url ?>">
                  <img class="uk-width-1-1"
                       src="<?= $project->images->first()->url ?>"
                       loading="lazy">
                  <div class="uk-position-cover uk-overlay uk-overlay-default ">
                      <div class="project-name uk-position-bottom-left uk-position-small">
                          <h4 class="uk-text-bold uk-margin-remove"><?= $project->title ?></h4>
                          <p class="uk-margin-remove text-white uk-text">
														<?php echo $project->servicios->implode(', ',
															'title'); ?></p>
                      </div>
                  </div>
              </a>
          </div>
	    <?php endforeach ?>
    </div>

</div>

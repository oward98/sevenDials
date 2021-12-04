<div id="overlay-welcome" class="overlay-welcome">
  <div>
    <div>
      <h1><?php the_field('welcome_title','option');?></h1>
      <?php the_field('welcome_message','option');?>
      <?php

      if( have_rows('welcome_links','option') ):?>

          <div class="welcome-links">

          <?php while ( have_rows('welcome_links','option') ) : the_row();?>
            <div>
            <a href="<?php the_sub_field('page');?>"><?php the_sub_field('display_text');?></a>
            </div>
          <?php endwhile;?>

          </div>
      <?php endif;?>
      <div>
          <span class="close-welcome icons8-delete"></span>
      </div>
    </div>
  </div>
</div>

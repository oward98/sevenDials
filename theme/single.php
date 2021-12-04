<?php 

get_header();

?>

	<!-- main -->

	<main role="main">
		<div class="wrapper">

			<header class='ow-page-header'>
				<?php
					global $post;
					$category = get_the_category()[0];
					$parent = get_category($category->parent);
					$building_id = $post->ID;
				?>
				<h1 id='ow-building-title'><?=the_title()?></h1>
				<span id="breadcrumb"><?php echo $parent->name; ?> > <a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a> > <?php the_title();?></span>
			</header>
			<section class="clear">
				<?php

				$buildings = get_field('buildings','category_' . $category->term_id);
				if( $buildings ): ?>
				<div class="section-panorama">
					<div id ="todate-view" class="todate-view">
						<!--
						<?php foreach( $buildings as $key => $building): // variable must be called $post (IMPORTANT) ?>

							<?php if($building->ID == $building_id) $active = $key;?>

							<?php $image = get_field('building_view', $building->ID);?>

						--><div class="<?php if($building->ID == $building_id) echo 'active-building';?>">
							 	<img src="<?php echo $image['sizes']['building-m'];?>">
							 	<div class="building-layer"></div>
						   </div><!--

						<?php endforeach; ?>
						-->
					</div>
				</div>
					<?php
						$numbuidlings = count($buildings);
						if($active != 0): $previous = $buildings[$active-1]->ID;?>
						<a href="<?php echo get_permalink($previous);?>"><span class="previous-building icons8-back"></span></a>
					<?php endif;?>
					<?php
						if(($active+1) < $numbuidlings): $next = $buildings[$active+1]->ID;?>
						<a href="<?php echo get_permalink($next);?>"><span class="next-building icons8-forward"></span></a>
					<?php endif;?>
				<?php endif; ?>

			</section>
			<section>
				<div class="clear">
					<div class="col-2">
							<div class="description">
								<h2>Appraisal</h2>
								<?php the_field('description') ?>
							</div>
							<div class="icons">
								<h2>More Information</h2>
								<?php 
								$icons = (array) get_field('icons');
								$override_icons = (array) get_field( 'override_icons' );
								?>
							 	<i id="cleaning-icon">
									<a <?php if( $icons && in_array('cleaning', $icons)):?> href="<?php if ( ! empty( $override_icons['cleaning'] ) ) echo $override_icons['cleaning']; else the_field('cleaning','option');?>"<?php endif;?>>
										<img src="<?php echo get_template_directory_uri();?>/img/icons/cleaning<?php if( empty( $icons ) || !in_array('cleaning', $icons) ) echo 'off';?>.svg" alt="cleaning icon" />
									</a>
								</i>
								<i id="windows-icon">
									<a <?php if( $icons && in_array('windows', $icons)):?> href="<?php if ( ! empty( $override_icons['windows'] ) ) echo $override_icons['windows']; else the_field('window','option');?>"<?php endif;?>>
										<img src="<?php echo get_template_directory_uri();?>/img/icons/windows<?php if( empty( $icons ) || !in_array('windows', $icons) ) echo 'off';?>.svg" alt="windows icon" />
									</a>
								</i>
								<i id="shopfront-icon">
									<a <?php if( $icons && in_array('shopfront', $icons)):?> href="<?php if ( ! empty( $override_icons['shopfront'] ) ) echo $override_icons['shopfront']; else the_field('shopfront','option');?>"<?php endif;?>>
										<img src="<?php echo get_template_directory_uri();?>/img/icons/shopfront<?php if( empty( $icons ) || !in_array('shopfront', $icons) ) echo 'off';?>.svg" alt="shopfront icon" />
									</a>
								</i>
								<i id="painting-icon">
									<a <?php if( $icons && in_array('painting', $icons)):?> href="<?php if ( ! empty( $override_icons['painting'] ) ) echo $override_icons['painting']; else the_field('painting','option');?>"<?php endif;?>>
									 <img src="<?php echo get_template_directory_uri();?>/img/icons/painting<?php if( empty( $icons ) || !in_array('painting', $icons) ) echo 'off';?>.svg" alt="painting icon" />
									</a>
								</i>
								<i id="lighting-icon">
									<a <?php if( $icons && in_array('lighting', $icons)):?> href="<?php if ( ! empty( $override_icons['lighting'] ) ) echo $override_icons['lighting']; else the_field('lighting','option');?>"<?php endif;?>>
										<img src="<?php echo get_template_directory_uri();?>/img/icons/lighting<?php if( empty( $icons ) || !in_array('lighting', $icons) ) echo 'off';?>.svg" alt="lighting icon" />
									</a>
								</i>
								<i id="planting-icon">
									<a <?php if( $icons && in_array('planting', $icons)):?> href="<?php if ( ! empty( $override_icons['planting'] ) ) echo $override_icons['planting']; else the_field('planting','option');?>"<?php endif;?>>
										<img src="<?php echo get_template_directory_uri();?>/img/icons/planting<?php if( empty( $icons ) || !in_array('planting', $icons) ) echo 'off';?>.svg" alt="planting icon" />
									</a>
								</i>
								<i id="doors-icon">
									<a <?php if( $icons && in_array('doors', $icons)):?> href="<?php if ( ! empty( $override_icons['doors'] ) ) echo $override_icons['doors']; else the_field('doors','option');?>"<?php endif;?>>
										<img src="<?php echo get_template_directory_uri();?>/img/icons/doors<?php if( empty( $icons ) || !in_array('doors', $icons) ) echo 'off';?>.svg" alt="doors icon" />
									</a>
								</i>
								<i id="hangingsign-icon">
									<a <?php if( $icons && in_array('hangingsign', $icons)):?> href="<?php if ( ! empty( $override_icons['hangingsign'] ) ) echo $override_icons['hangingsign']; else the_field('hangingsign','option');?>"<?php endif;?>>
										<img src="<?php echo get_template_directory_uri();?>/img/icons/hangingsign<?php if( empty( $icons ) || !in_array('hangingsign', $icons) ) echo 'off';?>.svg" alt="hangingsign icon" />
									</a>
								</i>
							</div>
							<div class="links">
								<h2>Navigation</h2>
								<div>
									<a href="<?php echo get_category_link($category->term_id); ?>">Back to <?php echo $parent->name; ?> <?php echo $category->name; ?></a>
								</div>
								<div>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to home page</a>
								</div>
							</div>
					</div>
					<div class="col-2">
						<h2>Photographs</h2>
						<?php $images = get_field('gallery');
						if( $images ): ?>
						<div class="gallery">
						    <ul>
						        <?php foreach( $images as $index => $image ): ?>
						            <li>
						                	<img src="<?php echo $image['sizes']['thumbnail']; ?>"
															     alt="<?php echo $image['alt']; ?>"
																	 class="gallery-img"
																	 data-width="<?php echo $image['width'];?>"
																	 data-height="<?php echo $image['height'];?>"
																	 data-url="<?php echo $image['url'];?>"
																	 data-index="<?php echo $index;?>"
																	 data-caption="<?php echo $image['caption'];?>" />
						                	<span><?php echo $image['caption']; ?></span>
						            </li>
						        <?php endforeach; ?>
						    </ul>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
		</div>
	</main>


	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">

        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    	</div>
		</div>

<?php get_footer(); ?>

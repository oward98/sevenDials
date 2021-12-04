<?php 

get_header();

?>

<?php $index = 0;?>

	<!--sidebar-->
	

		<!--main-->

		<main role="main">
		<div class="wrapper">
		<div class='ow-text-wrapper'>
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<?php

				// check if the flexible content field has rows of data
				if( have_rows('content_block') ):

				     // loop through the rows of data
				    while ( have_rows('content_block') ) : the_row();?>
								<section>
					        <?php if( get_row_layout() == 'full_width' ):?>
					        <div class="full-width">

										<?php $content_type = get_sub_field('content_type');

										if($content_type == 'text'):

											the_sub_field('text');

										elseif($content_type == 'image'):

											$image = get_sub_field('image');

											if($image): ?>

												<img 	src="<?php echo $image['url'];?>"
															class="gallery-img"
															data-width="<?php echo $image['width'];?>"
															data-height="<?php echo $image['height'];?>"
															data-url="<?php echo $image['url'];?>"
															data-index="<?php echo $index;?>"
															data-caption="<?php echo $image['caption'];?>"
															alt=" <?php echo $image['alt']; ?>">
												<p class="caption"><?php echo $image['caption']; ?></p>
												<?php $index++;?>
											<?php endif;

										elseif($content_type == 'gallery'):

											$images = get_sub_field('gallery');

											if($images): ?>

												<div class="acf-gallery">
												            <?php foreach( $images as $image ): ?>
												                    <img src="<?php echo $image['url']; ?>"/>
												                    <p class="caption"><?php echo $image['caption']; ?></p>
												            <?php endforeach; ?>
										        </div>
											<?php endif;

										elseif($content_type == 'video'):?>

											<div class="embed-container">
												<?php the_sub_field('video'); ?>
											</div>

										<?php elseif($content_type == 'street'):?>

											<?php

											$location = get_sub_field('street_view');

											if( ! empty($location) ):
											?>
											<div class="acf-map">
											    <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
											</div>
											<?php endif; ?>

										<?php elseif($content_type == 'links'):

											if( have_rows('links') ):?>

													<div class="links">

											   	<?php  while ( have_rows('links') ) : the_row();?>
													<div>

											        <?php $link_type = get_sub_field('link_type');?>
															<?php if($link_type == 'building'):?>
																<a href="<?php the_sub_field('building'); ?>"><?php the_sub_field('text');?></a>
															<?php elseif($link_type == 'page'):?>
																<a href="<?php the_sub_field('page'); ?>"><?php the_sub_field('text');?></a>
															<?php elseif($link_type == 'external_url'):?>
																<a href="<?php the_sub_field('external_url'); ?>"><?php the_sub_field('text');?></a>
															<?php elseif($link_type == 'file'):

																$file = get_sub_field('file');

																	if( $file ): ?>
																		<a href="<?php echo $file['url']; ?>"><span class="icons8-download"></span><?php the_sub_field('text');?></a>

																	<?php endif;
															endif;?>
														</div>
											   <?php  endwhile;?>
												</div>
										</div>
											<?php endif;
										endif;

					        elseif( get_row_layout() == 'two_columns' ):?>
										<div class="clear">
											<div class="acf-flex">
											<div class="col-2-flex">
												<?php $content_type = get_sub_field('left_content_type');

												if($content_type == 'text'):

													the_sub_field('left_text');

												elseif($content_type == 'image'):

													$image = get_sub_field('left_image');

													if($image): ?>

														<img 	src="<?php echo $image['url'];?>"
																	class="gallery-img"
																	data-width="<?php echo $image['width'];?>"
																	data-height="<?php echo $image['height'];?>"
																	data-url="<?php echo $image['url'];?>"
																	data-index="<?php echo $index;?>"
																	data-caption="<?php echo $image['caption'];?>"
																	alt=" <?php echo $image['alt']; ?>">
														<p class="caption"><?php echo $image['caption']; ?></p>
														<?php $index++;?>
													<?php endif;

												elseif($content_type == 'video'):?>

													<div class="embed-container">
														<?php the_sub_field('left_video'); ?>
													</div>

												<?php elseif($content_type == 'street'):

													$location = get_sub_field('left_street_view');

													if( ! empty($location) ):
													?>
													<div class="acf-map">
													    <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
													</div>
													<?php endif; ?>

												<?php elseif($content_type == 'links'):

													if( have_rows('left_links') ):?>

															<div class="links">
																<div>
													   <?php  while ( have_rows('left_links') ) : the_row();

													        $link_type = get_sub_field('link_type');?>
																	<?php if($link_type == 'building'):?>
																		<a href="<?php the_sub_field('building'); ?>"><?php the_sub_field('text');?></a>
																	<?php elseif($link_type == 'page'):?>
																		<a href="<?php the_sub_field('page'); ?>"><?php the_sub_field('text');?></a>
																	<?php elseif($link_type == 'external_url'):?>
																		<a href="<?php the_sub_field('external_url'); ?>"><?php the_sub_field('text');?></a>
																	<?php elseif($link_type == 'file'):

																		$file = get_sub_field('file');

																			if( $file ): ?>
																				<a href="<?php echo $file['url']; ?>"><span class="icons8-download"></span><?php the_sub_field('text');?></a>

																			<?php endif;
																	endif;?>
													   <?php  endwhile;?>
													 		</div>
														</div>
													<?php endif;

												endif;?>
											</div>
											<div class="col-2-flex">
												<?php $content_type = get_sub_field('right_content_type');

												if($content_type == 'text'):

													the_sub_field('right_text');

												elseif($content_type == 'image'):

													$image = get_sub_field('right_image');

													if($image): ?>

														<img 	src="<?php echo $image['url'];?>"
																	class="gallery-img"
																	data-width="<?php echo $image['width'];?>"
																	data-height="<?php echo $image['height'];?>"
																	data-url="<?php echo $image['url'];?>"
																	data-index="<?php echo $index;?>"
																	data-caption="<?php echo $image['caption'];?>"
														     	alt=" <?php echo $image['alt']; ?>">
														<p class="caption"><?php echo $image['caption']; ?></p>
														<?php $index++;?>
													<?php endif;

												elseif($content_type == 'video'):?>

													<div class="embed-container">
														<?php the_sub_field('right_video'); ?>
													</div>

												<?php elseif($content_type == 'street'):

													$location = get_sub_field('right_street_view');

													if( ! empty($location) ):
													?>
													<div class="acf-map">
													    <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
													</div>
													<?php endif; ?>

												<?php elseif($content_type == 'links'):

													if( have_rows('right_links') ):?>

															<div class="links">
													   <?php  while ( have_rows('right_links') ) : the_row();?>
														 <div>

													        <?php $link_type = get_sub_field('link_type');?>
																	<?php if($link_type == 'building'):?>
																		<a href="<?php the_sub_field('building'); ?>"><?php the_sub_field('text');?></a>
																	<?php elseif($link_type == 'page'):?>
																		<a href="<?php the_sub_field('page'); ?>"><?php the_sub_field('text');?></a>
																	<?php elseif($link_type == 'external_url'):?>
																		<a href="<?php the_sub_field('external_url'); ?>"><?php the_sub_field('text');?></a>
																	<?php elseif($link_type == 'file'):

																		$file = get_sub_field('file');

																			if( $file ): ?>
																				<a href="<?php echo $file['url']; ?>"><span class="icons8-download"></span><?php the_sub_field('text');?></a>

																			<?php endif;
																	endif;?>
															</div>
													   <?php  endwhile;?>
														</div>

													<?php endif;


												endif;?>
											</div>
										</div>
									</div>
									<?php elseif( get_row_layout() == 'bibliography' ):?>
										<?php if( have_rows('bibliography') ):?>
											<div class="biblio">
												<?php  while ( have_rows('bibliography') ) : the_row();?>
												<div class="clear">
													<div class="biblio-col">
														<p>
															<?php the_sub_field('left_text'); ?>
														</p>
													</div>
													<div class="biblio-col">
														<p>
															<?php the_sub_field('right_text'); ?>
														</p>
													</div>
												</div>
												<?php endwhile;?>
											</div>
										<?php endif;?>

									<?php elseif( get_row_layout() == 'table' ):

										$table = get_sub_field( 'table' );

										if ( $table ):

												echo '<div class="flex-table">';

										    echo '<table>';

										        if ( $table['header'] ) {

										            echo '<thead>';

										                echo '<tr>';

										                    foreach ( $table['header'] as $th ) {

										                        echo '<th>';
										                            echo $th['c'];
										                        echo '</th>';
										                    }

										                echo '</tr>';

										            echo '</thead>';
										        }

										        echo '<tbody>';

										            foreach ( $table['body'] as $tr ) {

										                echo '<tr>';

										                    foreach ( $tr as $td ) {

										                        echo '<td>';
										                            echo $td['c'];
										                        echo '</td>';
										                    }

										                echo '</tr>';
										            }

										        echo '</tbody>';

										    echo '</table>';

												echo '</div>';

										endif;

									elseif( get_row_layout() == 'comparator' ):
										$image_top = get_sub_field('image_top');
										$image_bottom = get_sub_field('image_bottom');

										if($image_top && $image_bottom): ?>

										<div class='twentytwenty-container'>
										 <img src='<?php echo $image_bottom['url'];?>' />
										 <img src='<?php echo $image_top['url'];?>' />
										</div>

										<?php endif;

					        endif;?>
								</section>
				    <?php endwhile;

				else :

				    // no layouts found

				endif;

				?>
		<?php endwhile;?>
		<?php endif; ?>
			<?php if(get_field('previous_page_link')||get_field('next_page_link')):?>
				<div class="nextprevious clear">
					<?php if(get_field('previous_page_link')):?>
					<div class="previous">
						<a href="<?php the_field('previous_page_link');?>">< Previous page</a>
					</div>
					<?php endif;?>
					<?php if(get_field('next_page_link')):?>
					<div class="next">
						<a href="<?php the_field('next_page_link');?>">Next page ></a>
					</div>
					<?php endif;?>
				</div>
			<?php endif;?>
			</div>
			</div>
		</main>

		<!--random other stuff tbc-->

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

	</div>

<?php get_footer(); ?>

<?php

function building_by_building_header() {
    //Hierarchy is organised via categories and parent categories. E.g. Dryden Street is a category and 2-12 Dryden Street is a subcategory
    //the following variables are declared in header.php
        global $post;
		global $category;
		global $parent;
		global $building_id;
    ?>
        
			<section class="dropdowns">
				<div class="wrapper">
					<div class="clear">
						<div class="col-4 small-1">
							<div>
								<div id="street-dropdown-button" class="icons8-sort-down button" >
									<?php if(is_category() || is_single()):?>
									<?php echo $parent->name;?>
								<?php else: the_field('street_dropdown','option');?>
									<?php endif;?>
								</div>
								<div id="street-dropdown" class="dropdown" hidden>
									<?php $streets = get_field('streets','option');?>
									<?php if($streets): ?>
									<ul>
										<?php foreach($streets as $street): ?>
											<?php $term = get_term( $street); ?>
										<li data-id="<?php echo $street;?>">
											<?php echo $term->name;?>
										</li>
									<?php endforeach; ?>
									</ul>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="col-4 small-1">
							<div>
								<div id="section-dropdown-button" class="icons8-sort-down button">
									<?php if(is_category() || is_single()):?>
									<?php echo $category->name;?>
									<?php else: the_field('section_dropdown','option');?>
									<?php endif;?>
								</div>
								<div id="section-dropdown" class="dropdown" hidden>
									<ul>
										<?php if(is_category() || is_single()):?>
											<?php $children = get_term_children( $parent->term_id, 'category' );
											// var_dump($children);
											foreach ($children as $key => $value) :?>
										    <?php $section = get_term( $value); ?>
												<a href="<?php echo get_category_link($section->term_id);?>">
													<li data-id="<?php echo $value;?>">
														<?php echo $section->name;?>
													</li>
												</a>
											<?php endforeach;?>
										<?php endif;?>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-4 small-1">
							<div>
								<div id="building-dropdown-button" class="icons8-sort-down button">
									<?php the_field('building_dropdown','option');?>
								</div>
								<div id="building-dropdown" class="dropdown" hidden>
									<ul>
										<?php if(is_category() || is_single()):?>
											<?php $posts= get_field('buildings','category_' . $category->term_id);
											foreach ($posts as $key => $value) :?>
												<a href="<?php echo get_permalink($value->ID); ?>">
													<li data-id="<?php echo $value->ID;?>">
														<?php the_field('title', $value->ID);?>
													</li>
												</a>
											<?php endforeach;?>
										<?php endif;?>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-4 small-1">
							<div>
								<?php if(get_field('historical_image', 'category_' . ($category ? $category->term_id : ''))):?>
									<div id="historic-view-button" class="only-section icons8-plus button">
										<?php the_field('historic_view','option');?>
									</div>
								<?php else:?>
									<div class="only-section button">
										</br>
									</div>
                                <?php endif;?>
							</div>
						</div>
					</div>
				</div>
			</section>

    <?php
}
<?php 

get_header(); 

?>
	<!-- main -->		
	<main role="main">
		<div class="wrapper">
			<header id="ow-category-header">

				<?php
					$category = get_category( get_query_var( 'cat' ) );
					$parent = get_category($category->parent);
				?>

				<h1><?php echo $parent->name; ?> > <?php echo single_cat_title(); ?></h1>
				<span>Click on a building below to learn more about it</span>
			</header>
		</div>
				<?php

				$buildings = get_field('buildings','category_' . $category->term_id);
				if( $buildings ): ?>
				<div class="section-panorama">
					<div class="todate-view">
						<!--
						<?php foreach( $buildings as $building): // variable must be called $post (IMPORTANT) ?>

							<?php $image = get_field('building_view', $building->ID);?>
						--><div class="<?php if($building->ID == $building_id) echo 'active-building';?>">
							 	<a href="<?php echo get_permalink($building->ID);?>">
									<img src="<?php echo $image['sizes']['building-m'];?>">
								 	<div class="building-layer section-color-background">
									</div>
									<div class="building-layer-text">
										<span><?php the_field('title', $building->ID);?></span>
									</div>
								</a>
						   </div><!--

						<?php endforeach; ?>
						-->
					</div>
					<div id="historic-view" class="historic-view" hidden>
						<?php $image = get_field('historical_image', 'category_' . $category->term_id); ?>
						<?php if($image):?>
							<div><img src="<?php echo $image['sizes']['building-m']; ?>"></div>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
		<div class="wrapper ow-category-wrapper">
			<section id='ow-category-info'>
				<div class="clear">
					<div class="col-2">
						<h2>History</h2>
						<?php echo term_description( $category->term_id, 'category' ) ?>
					</div>
					<div id='ow-category-map' class="col-2">
						<?php $image = get_field('map', 'category_' . $category->term_id); ?>
						<?php if($image):?>
							<img src="<?php echo $image['url']; ?>">
							<p class="caption"><?php echo $image['caption']; ?></p>
						<?php endif; ?>

					</div>
				</div>
			</section>
			<div class='ow-map-wrapper'>
				<h2>Navigation Map</h2>
				<span>Click below to visit another street</span> 
				<?php map()?>
			</div>
		</div>
	</main>

	<style type="text/css">
	.section-color-background {
		background-color: <?php the_field('color', 'category_' . $category->term_id); ?>;
	}
	.section-color{
		color: <?php the_field('color', 'category_' . $category->term_id); ?>;
	}
	</style>

<?php get_footer(); ?>

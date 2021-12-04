<?php get_header(); ?>

	<main role="main">
		<div class="wrapper">
			<div class="ow-text-wrapper">
				<section>
						<div class="clear">
							<div class="full-width">
								<h1><?php the_field('title');?></h1>
							</div>
							<div class="full-width">
								<?php the_field('description');?>
							</div>
						</div>
					</section>
				<section>
			</div>	
		</div>
	</main>
	<?php
	if (!isset($_COOKIE["7dials-cookie-welcome"])){
		get_template_part( 'templates/parts/overlay', 'welcome' );
	}
	?>
<?php get_footer(); ?>

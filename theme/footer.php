			<footer id="footer" class="footer" role="contentinfo">
				<div class="ow-page-wrapper clear">
						<div class="col-4 footer-title">
							<h2>The Seven Dials Trust</h2>
						</div>
						<div class="col-4">
							<ul>
								<li><span><a href="https://sevendials.com" target="_blank">sevendials.com</a></span></li>
								<li><span>info@sevendials.com</span></li>
							</ul>
						</div>
						<div class="col-4">
							<ul>
								<li><span>Registered Charity No. 297350</span></li>
								<li><span>Company No. 2125701</span></li>
							</ul>
						</div>
						<div class="col-4">
							<ul>
								<li><span>68 Dean Street</span></li>
								<li><span>W1D 4QJ</span></li>
							</ul>
						</div>
				</div>
			</footer>
			<span class="scrollup icons8-sort-up"></span>

		<?php
		if (!isset($_COOKIE["7dials-cookie-disclaimer"])){
			get_template_part( 'templates/parts/overlay', 'disclaimer' );
		}
		?>

		<?php wp_footer(); ?>

	</body>
</html>

<footer id="footer"  style="background-image: url(<?=get_field('footer_background', 18)?>);">
	<div class="wrapper">
		<nav>
    		<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
		</nav>
		<div class="footer-contact">
			<p>Kontakt</p>
			<address>
				<?php echo get_field('footer_contact', 18); ?>
			</address>
		</div>
		<ul class="social-sharing">
			<li><a href="<?php echo get_field('instagram_url', 18); ?>"><span class="icon-instagram"></span></a></li>
			<li><a href="<?php echo get_field('twitter_url', 18); ?>"><span class="icon-twitter"></span></a></li>
			<li><a href="<?php echo get_field('facebook_url', 18); ?>"><span class="icon-facebook"></span></a></li>
		</ul>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
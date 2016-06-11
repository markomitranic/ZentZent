<section class="sidebar-magazine-content">

<?php $posts = get_field('clanci_sa_strane');
if( $posts ): 
	foreach( $posts as $post):  setup_postdata($post);?>

		<article>
			<a href="<?php the_permalink(); ?>">
				<header>
					<h2><?php the_title(); ?></h2>
				</header>
				<p><?php echo get_field('autor_teksta'); ?></p>
			</a>
		</article>	
	<?php endforeach; wp_reset_postdata(); endif; ?>
</section>






        
		

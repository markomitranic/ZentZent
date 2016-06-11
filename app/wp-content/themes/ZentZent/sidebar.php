<section class="sidebar-related">

<?php
$otvorenipoziv = get_post(52);
$slika = get_field('hero_slika', 52);
 ?>

		<article>
			<a href="<?php echo get_post_permalink(52); ?>">
				<img src="<?php echo $slika['url']; ?>" srcset="<?php the_srcset($slika, 'sidebar_thumb2x'); the_srcset($slika, 'sidebar_thumb'); ?>" alt="<?php echo $slika['alt']; ?>">
				<header>
					<h2><?php echo $otvorenipoziv->post_title; ?></h2>
				</header>
			</a>
		</article>


	<?php
		$args = array(
			'posts_per_page'   => 1,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'otvoreni_pozivi',
			'post_status'      => 'publish'
		);
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) :
				$the_query->the_post(52);
				$slika = get_field('hero_slika');	
	?>
		<article>
			<a href="<?php the_permalink(); ?>">
				<img src="<?php echo $slika['url']; ?>" srcset="<?php the_srcset($slika, 'sidebar_thumb2x'); the_srcset($slika, 'sidebar_thumb'); ?>" alt="<?php echo $slika['alt']; ?>">
				<header>
					<h2><?php the_title(); ?></h2>
				</header>
			</a>
		</article>
	<?php endwhile; endif; wp_reset_postdata(); ?>


	<?php
		$args = array(
			'posts_per_page'   => 2,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'post',
			'post_status'      => 'publish'
		);
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) :
				$the_query->the_post(52);
				$slika = get_field('hero_slika');	
	?>
		<article>
			<a href="<?php the_permalink(); ?>">
				<img src="<?php echo $slika['url']; ?>" srcset="<?php the_srcset($slika, 'sidebar_thumb2x'); the_srcset($slika, 'sidebar_thumb'); ?>" alt="<?php echo $slika['alt']; ?>">
				<header>
					<p><?php echo get_field('autor_teksta'); ?></p>
					<h2><?php the_title(); ?></h2>
				</header>
			</a>
		</article>
	<?php endwhile; endif; wp_reset_postdata(); ?>
</section>
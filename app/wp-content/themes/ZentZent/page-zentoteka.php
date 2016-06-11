<?php 
/*
Template Name: Kategorija Zentoteka Template
*/

// Template name must be unique and filled in. The template will automatically be shown as a Page Template.

get_header(); 

the_post(); 

?>
<div id="body">
	<section id="sidebar">
		<?php include ('sidebar.php'); ?>
	</section>
	<main role="main" id="main">
		<section  class="category-small">
			<?php

				$args = array(
					'posts_per_page'   => -1,
					'post_type'        => 'post',
					'post_status'      => 'publish'
				);

				// The Query
				$the_query = new WP_Query( $args );

				// The Loop
				if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) :
						$the_query->the_post();
						$slika = get_field('hero_slika');	
			?>

				<article>
					<a href="<?php the_permalink(); ?>">
						<?php if (get_field('hero_slika') && get_field('prikazivanje_hero_slike')) : 
							$slika = get_field('hero_slika');
						?>
							<img src="<?php echo $slika['url']; ?>" srcset="<?php the_srcset($slika, 'sidebar_thumb2x'); the_srcset($slika, 'sidebar_thumb'); ?>" alt="<?php echo $slika['alt']; ?>">
						<?php endif; ?>
						<header>
							<h2><?php echo get_field('autor_teksta'); ?></h2>
							<p><?php the_title(); ?></p>
						</header>
					</a>
				</article>

			<?php
					endwhile;
				 else :
					echo 'Nema članaka u traženoj kategoriji.';
				endif;
				// Restore original Post Data
				wp_reset_postdata();

			?>
		</section>
	</main>
</div>
<?php get_footer(); ?>
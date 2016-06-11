<?php 
/*
Template Name: Sva izdanja Zenta Template
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
		<section  class="category-big">


			<?php

				$args = array(
					'posts_per_page'   => -1,
					'offset'           => 0,
					'orderby'          => 'date',
					'order'            => 'DESC',
					'post_type'        => 'page',
					'post_parent'      => '31',
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
							<img src="<?php echo $slika['url']; ?>" srcset="<?php the_srcset($slika, 'casopis'); the_srcset($slika, 'casopis2x'); ?>" alt="<?php echo $slika['alt']; ?>">
						<header>
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
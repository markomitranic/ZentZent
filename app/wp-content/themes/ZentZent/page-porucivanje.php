<?php 
/*
Template Name: Porucivanje Zenta Template
*/

get_header(); 

the_post(); 

if (isset($_POST["stage"])) {
	$request = $_POST;
} else {
	$request = array();
	$request["stage"] = "0";
}

?>



<div id="body">
	<section id="sidebar"></section>
	<main role="main" id="main">
		<section class="full-magazine-content">

		<?php 
			switch ($request["stage"]) {
				case '0':
					$url = 'form-slices/paketi.php';
					break;
				case '1':
					$url = 'form-slices/podaci.php';
					break;
				case '2':
					$url = 'form-slices/potvrda.php';
					break;
				default:
					$url = 'form-slices/paketi.php';
					break;
			}
			include($url);
		 ?>
		</section>
	</main>
</div>








<?php get_footer(); ?>
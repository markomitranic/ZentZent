<?php 
/*
Template Name: ThankYou za kupovinu Zenta Template
*/


// If session is not set or not 3, this is error. Redirect to the ordering page.
if ($_SESSION['zentOrderData']['stage'] == 3) {
	$orderData = $_SESSION['zentOrderData'];
} else {
	$location = get_permalink(35);
	$satus = 500;
	wp_redirect( $location, $status );
	exit;
}

get_header(); 

the_post(); 

?>

<div id="body">
	<section id="sidebar"></section>
	<main role="main" id="main">
		<section class="full-magazine-content">
		
			<?php the_content(); ?>



		</section>
	</main>
</div>

<?php 
function textHtmlFilter() { return 'text/html'; }
add_filter('wp_mail_content_type', 'textHtmlFilter');
$to = 'marko.mitranic@gmail.com'; //zentmagazine@gmail.com
$subject = 'Subjekt';
$message = '';







wp_mail($to, $subject, $message);
remove_filter('wp_mail_content_type', 'textHtmlFilter');




get_footer(); 


?>


salje email
upisuje u fajl

brise sesiju
//$_SESSION['zentOrderData'] = false;
// session_destroy ();



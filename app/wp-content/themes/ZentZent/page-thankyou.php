<?php 
/*
Template Name: ThankYou za kupovinu Zenta Template
*/

// If session is not set or not 3, this is error. Redirect to the ordering page.
if ((!isset($_SESSION['zentOrderData'])) || $_SESSION['zentOrderData']['stage'] !== 3) {
	// wp_safe_redirect( get_permalink(2), 500 ); // Not working?
	echo '<script>window.location.replace("'.get_permalink(35).'");</script>';
	die;
} 


$orderData = $_SESSION['zentOrderData'];

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
$to = 'zentmagazine@gmail.com'; //zentmagazine@gmail.com
$subject = "Zent Payment from: ".$orderData["email"];;
$message = '<table><thead><tr><td style="border: 1px solid black; padding: 0px 5px; font-weight: 700; text-transform: capitalize; background-color: #cadece; color: black;">Field Name</td><td style="border: 1px solid black; padding: 0px 5px; font-weight: 700; text-transform: capitalize; background-color: #cadece; color: black;">Value</td></tr></thead><tbody>';



	foreach ($orderData as $key => $value) : 
		$message .= '
			<tr>
				<td style="border: 1px solid black; padding: 0px 5px; font-weight: 700; text-transform: capitalize; background-color: #bbb; color: rgb(68, 68, 68);">'.$key.'</td>
				<td style="border: 1px solid black; padding: 0px 5px; background-color: #f5f5f5; color: rgb(68, 68, 68);">'.$value.'</td>
			</tr>';
		endforeach;
$message .= '</tbody></table>';

wp_mail($to, $subject, $message);
remove_filter('wp_mail_content_type', 'textHtmlFilter');

// Brise sesiju
$_SESSION['zentOrderData'] = false;
session_destroy ();

get_footer(); 
?>





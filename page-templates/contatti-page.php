<?php
/**
 * Template Name: Contatti Page
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package understrap
 */

// Exit if accessed directly.

defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="page-wrapper">

	<div class="container coming-soon-container">
	<div class="row">
		<div class="col-md-6">
		<div>
			<img src="/wp-content/themes/understrap-child/img/AYLM_logo_classic_black.svg" alt="logo" class="logo-contact">
		</div>
		<h2>Abbate Y La Mantia</h2>
		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis minus placeat ea et harum aspernatur facere quibusdam voluptatum, deleniti, molestiae itaque praesentium temporibus quod amet id error dicta. Illum, et?</p>
		</div>
		<div class="col-md-6">
			<div>
				<h2>Contattaci</h2>
				<?php echo get_field('contact_form'); ?>
			</div>	
		</div>
	</div>
	</div>

</div><!-- #page-wrapper -->

<?php get_footer(); ?>

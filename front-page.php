<?php
/**
 * Front page template.
 *
 * Ja sākumlapa veidota ar Elementor, tiek rādīts Elementor saturs.
 * Citādi sekcijas tiek ielādētas no template-parts/front/.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

if ( latvijai_is_elementor_page() ) :
	?>
	<main id="primary" class="site-main latvijai-elementor">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</main>
	<?php
else :
	?>
	<main id="primary" class="site-main">
		<?php
		foreach ( latvijai_front_sections() as $latvijai_section => $latvijai_label ) {
			get_template_part( 'template-parts/front/' . $latvijai_section );
		}
		?>
	</main>
	<?php
endif;

get_footer();

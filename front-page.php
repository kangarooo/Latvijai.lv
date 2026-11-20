<?php
/**
 * Front page template.
 *
 * @package Latvijai_Futura
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$hero_title_1 = latvijai_get( 'hero_title_1' );
$hero_title_2 = latvijai_get( 'hero_title_2' );
$hero_title_3 = latvijai_get( 'hero_title_3' );
$hero_full    = trim( $hero_title_1 . ' ' . $hero_title_2 . ' ' . $hero_title_3 );

$projects_url = get_post_type_archive_link( 'projekts' );
if ( ! $projects_url ) {
	$projects_url = home_url( '/#projekti' );
}

$journal_url = get_permalink( (int) get_option( 'page_for_posts' ) );
if ( ! $journal_url ) {
	$journal_url = home_url( '/#zurnals' );
}

$topics = array(
	__( 'Kultūra', 'latvijai-futura' ),
	__( 'Tehnoloģijas', 'latvijai-futura' ),
	__( 'Daba', 'latvijai-futura' ),
	__( 'Izglītība', 'latvijai-futura' ),
	__( 'Sabiedrība', 'latvijai-futura' ),
	__( 'Valoda', 'latvijai-futura' ),
	__( 'Rīga', 'latvijai-futura' ),
	__( 'Kurzeme', 'latvijai-futura' ),
	__( 'Zemgale', 'latvijai-futura' ),
	__( 'Vidzeme', 'latvijai-futura' ),
	__( 'Latgale', 'latvijai-futura' ),
	__( 'Nākotne', 'latvijai-futura' ),
);

$latvia_regions = array(
	array(
		'name'      => __( 'Rīga', 'latvijai-futura' ),
		'direction' => __( 'Centrs', 'latvijai-futura' ),
	),
	array(
		'name'      => __( 'Kurzeme', 'latvijai-futura' ),
		'direction' => __( 'Rietumi', 'latvijai-futura' ),
	),
	array(
		'name'      => __( 'Zemgale', 'latvijai-futura' ),
		'direction' => __( 'Dienvidi', 'latvijai-futura' ),
	),
	array(
		'name'      => __( 'Vidzeme', 'latvijai-futura' ),
		'direction' => __( 'Ziemeļi', 'latvijai-futura' ),
	),
	array(
		'name'      => __( 'Latgale', 'latvijai-futura' ),
		'direction' => __( 'Austrumi', 'latvijai-futura' ),
	),
);

$demo_projects = array(
	array(
		'title'        => __( 'Runā Latviski', 'latvijai-futura' ),
		'field'        => __( 'Valoda', 'latvijai-futura' ),
		'status'       => __( 'Aktīvs', 'latvijai-futura' ),
		'status_class' => 'active',
		'location'     => __( 'Visa Latvija', 'latvijai-futura' ),
		'excerpt'      => __( 'Ikdienas sarunas latviski — bez bailēm kļūdīties. Projekts, kas valodu atgriež ielās, kafejnīcās un mājās.', 'latvijai-futura' ),
		'url'          => 'https://runalatviski.latvijai.lv/',
		'glyph'        => 'R',
		'tone'         => 'ember',
	),
	array(
		'title'        => __( 'Nākotnes darbnīcas', 'latvijai-futura' ),
		'field'        => __( 'Izglītība', 'latvijai-futura' ),
		'status'       => __( 'Izstrādē', 'latvijai-futura' ),
		'status_class' => 'progress',
		'location'     => __( 'Reģioni', 'latvijai-futura' ),
		'excerpt'      => __( 'Praktiskas darbnīcas jauniešiem par tehnoloģijām, uzņēmējdarbību un kopienu veidošanu.', 'latvijai-futura' ),
		'url'          => '#pieteikties',
		'glyph'        => 'N',
		'tone'         => 'ice',
	),
	array(
		'title'        => __( 'Zaļā infrastruktūra', 'latvijai-futura' ),
		'field'        => __( 'Vide', 'latvijai-futura' ),
		'status'       => __( 'Ideja', 'latvijai-futura' ),
		'status_class' => 'idea',
		'location'     => __( 'Latvija', 'latvijai-futura' ),
		'excerpt'      => __( 'Koku stādīšana, pilsētu zaļās zonas un ilgtspējīgi risinājumi katrai kopienai.', 'latvijai-futura' ),
		'url'          => '#pieteikties',
		'glyph'        => 'Z',
		'tone'         => 'violet',
	),
);
?>

<main id="primary" class="site-main">

	<section class="hero" data-hero>
		<canvas class="hero-canvas" data-particles aria-hidden="true"></canvas>
		<div class="hero-glow" aria-hidden="true"></div>

		<div class="container hero-inner">
			<div class="hero-copy">
				<p class="hero-eyebrow"><span class="lv-flag" aria-hidden="true"></span><?php echo esc_html( latvijai_get( 'hero_eyebrow' ) ); ?></p>

				<h1 class="hero-title" aria-label="<?php echo esc_attr( $hero_full ); ?>">
					<?php if ( '' !== $hero_title_1 ) : ?>
						<span class="hero-line" aria-hidden="true"><span><?php echo esc_html( $hero_title_1 ); ?></span></span>
					<?php endif; ?>
					<?php if ( '' !== $hero_title_2 ) : ?>
						<span class="hero-line hero-line--outline" aria-hidden="true"><span><?php echo esc_html( $hero_title_2 ); ?></span></span>
					<?php endif; ?>
					<?php if ( '' !== $hero_title_3 ) : ?>
						<span class="hero-line" aria-hidden="true"><span><?php echo esc_html( $hero_title_3 ); ?><em class="hero-dot">.</em></span></span>
					<?php endif; ?>
				</h1>

				<p class="hero-text"><?php echo esc_html( latvijai_get( 'hero_text' ) ); ?></p>

				<div class="hero-actions">
					<a class="btn btn-primary btn-lg" href="<?php echo esc_url( latvijai_get( 'hero_primary_url' ) ); ?>">
						<?php echo esc_html( latvijai_get( 'hero_primary_label' ) ); ?>
						<?php latvijai_icon_e( 'arrow-up-right' ); ?>
					</a>
					<a class="btn btn-ghost btn-lg" href="<?php echo esc_url( latvijai_get( 'hero_secondary_url' ) ); ?>">
						<?php echo esc_html( latvijai_get( 'hero_secondary_label' ) ); ?>
					</a>
				</div>

				<div class="hero-meta">
					<span class="hero-status">
						<span class="pulse" aria-hidden="true"></span>
						<?php echo esc_html( latvijai_get( 'hero_status' ) ); ?>
					</span>
					<span class="hero-coords"><?php echo esc_html( latvijai_get( 'contact_coords' ) ); ?></span>
				</div>
			</div>

			<div class="hero-visual" aria-hidden="true">
				<div class="orb">
					<span class="orb-ring orb-ring--1"></span>
					<span class="orb-ring orb-ring--2"></span>
					<span class="orb-ring orb-ring--3"></span>
					<span class="orb-chip orb-chip--1"><?php esc_html_e( 'Kultūra', 'latvijai-futura' ); ?></span>
					<span class="orb-chip orb-chip--2"><?php esc_html_e( 'Tehnoloģijas', 'latvijai-futura' ); ?></span>
					<span class="orb-chip orb-chip--3"><?php esc_html_e( 'Daba', 'latvijai-futura' ); ?></span>
					<span class="orb-chip orb-chip--4"><?php esc_html_e( 'Sabiedrība', 'latvijai-futura' ); ?></span>
					<span class="orb-core">
						<span class="orb-monogram">LV</span>
					</span>
				</div>
				<span class="hero-readout"><?php esc_html_e( 'Latvijai.lv / Sabiedriskie projekti', 'latvijai-futura' ); ?></span>
			</div>
		</div>

		<a class="scroll-cue" href="#misija">
			<span><?php esc_html_e( 'Ritini', 'latvijai-futura' ); ?></span>
			<span class="scroll-line" aria-hidden="true"></span>
		</a>
	</section>

	<div class="ticker" aria-hidden="true">
		<div class="ticker-track">
			<?php for ( $loop = 0; $loop < 2; $loop++ ) : ?>
				<?php foreach ( $topics as $topic ) : ?>
					<span class="ticker-item">
						<?php echo esc_html( $topic ); ?>
						<span class="ticker-star">✦</span>
					</span>
				<?php endforeach; ?>
			<?php endfor; ?>
		</div>
	</div>

	<section id="misija" class="section mission">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow"><span class="eyebrow-index">01</span> <?php esc_html_e( 'Misija', 'latvijai-futura' ); ?></span>
				<span class="section-line" aria-hidden="true"></span>
			</div>

			<div class="mission-grid">
				<div class="mission-title reveal">
					<h2>
						<?php esc_html_e( 'Latvija nav tikai vieta.', 'latvijai-futura' ); ?>
						<span class="accent"><?php esc_html_e( 'Tā ir mūsu kopīgais projekts.', 'latvijai-futura' ); ?></span>
					</h2>
				</div>

				<div class="mission-body">
					<p class="lead reveal"><?php esc_html_e( 'Mēs ticam, ka valsts nākotni veido nevis viena ideja, bet tūkstošiem mazu darbu, kas notiek blakus.', 'latvijai-futura' ); ?></p>
					<p class="reveal"><?php esc_html_e( 'Latvijai.lv apkopo sabiedriskos projektus, savieno cilvēkus ar līdzdomātājiem un palīdz idejām pārvērsties darbos — no Rīgas līdz mazākajam novadam.', 'latvijai-futura' ); ?></p>

					<div class="stats-grid">
						<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
							<?php
							$stat_number = latvijai_get( 'stat_' . $i . '_number' );
							$stat_label  = latvijai_get( 'stat_' . $i . '_label' );
							$is_numeric  = (bool) preg_match( '/^\d+$/', $stat_number );
							?>
							<div class="stat reveal" style="--delay: <?php echo esc_attr( ( $i - 1 ) * 0.08 ); ?>s;">
								<span class="stat-number<?php echo $is_numeric ? '' : ' stat-number--accent'; ?>"<?php echo $is_numeric ? ' data-count="' . esc_attr( $stat_number ) . '"' : ''; ?>><?php echo esc_html( $is_numeric ? '0' : $stat_number ); ?></span>
								<span class="stat-label"><?php echo esc_html( $stat_label ); ?></span>
							</div>
						<?php endfor; ?>
					</div>

					<a class="link-arrow mission-link reveal" href="#projekti">
						<?php esc_html_e( 'Skatīt, ko būvējam', 'latvijai-futura' ); ?>
						<?php latvijai_icon_e( 'arrow-right' ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>

	<section id="latvija" class="section latvia">
		<div class="container">
			<div class="latvia-panel reveal">
				<div class="latvia-copy">
					<p class="eyebrow"><span class="eyebrow-index">LV</span> <?php esc_html_e( 'Latvija / Reģioni', 'latvijai-futura' ); ?></p>

					<h2 class="latvia-title">
						<?php esc_html_e( 'Viena Latvija.', 'latvijai-futura' ); ?>
						<span class="text-outline"><?php esc_html_e( 'Pieci novadi.', 'latvijai-futura' ); ?></span>
					</h2>

					<p class="latvia-text"><?php esc_html_e( 'No Rīgas līdz Latgalei, no Kurzemes līdz Vidzemei. Mēs savienojam cilvēkus, kas savu novadu pārvērš par vietu, kur gribas palikt.', 'latvijai-futura' ); ?></p>

					<div class="latvia-meta">
						<span class="lv-flag" aria-hidden="true"></span>
						<span><?php esc_html_e( 'Latvija · 64 589 km²', 'latvijai-futura' ); ?></span>
						<span><?php echo esc_html( latvijai_get( 'contact_coords' ) ); ?></span>
					</div>

					<a class="link-arrow latvia-link" href="#projekti">
						<?php esc_html_e( 'Skatīt projektus', 'latvijai-futura' ); ?>
						<?php latvijai_icon_e( 'arrow-right' ); ?>
					</a>
				</div>

				<div class="latvia-regions" role="list" aria-label="<?php esc_attr_e( 'Latvijas reģioni', 'latvijai-futura' ); ?>">
					<?php foreach ( $latvia_regions as $region_index => $region ) : ?>
						<div class="latvia-region" role="listitem">
							<span class="latvia-region-index"><?php echo esc_html( str_pad( (string) ( $region_index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
							<strong><?php echo esc_html( $region['name'] ); ?></strong>
							<em><?php echo esc_html( $region['direction'] ); ?></em>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<section id="projekti" class="section projects">
		<div class="container">
			<div class="section-top">
				<div class="reveal">
					<span class="eyebrow"><span class="eyebrow-index">02</span> <?php esc_html_e( 'Projekti', 'latvijai-futura' ); ?></span>
					<h2 class="section-title"><?php esc_html_e( 'Idejas, kas jau', 'latvijai-futura' ); ?><br><span class="text-outline"><?php esc_html_e( 'strādā Latvijai.', 'latvijai-futura' ); ?></span></h2>
				</div>
				<a class="link-arrow" href="<?php echo esc_url( $projects_url ); ?>">
					<?php esc_html_e( 'Visi projekti', 'latvijai-futura' ); ?>
					<?php latvijai_icon_e( 'arrow-up-right' ); ?>
				</a>
			</div>

			<div class="projects-grid">
				<?php
				$showing_demos = false;
				$projects      = new WP_Query(
					array(
						'post_type'           => 'projekts',
						'posts_per_page'      => 3,
						'ignore_sticky_posts' => true,
						'no_found_rows'       => true,
					)
				);

				if ( $projects->have_posts() ) :
					$index = 0;
					while ( $projects->have_posts() ) :
						$projects->the_post();
						get_template_part(
							'template-parts/project-card',
							null,
							array(
								'post_id' => get_the_ID(),
								'index'   => $index,
							)
						);
						$index++;
					endwhile;
					wp_reset_postdata();
				else :
					$showing_demos = true;
					foreach ( $demo_projects as $index => $demo ) :
						get_template_part(
							'template-parts/project-card',
							null,
							array(
								'demo'  => $demo,
								'index' => $index,
								'url'   => $demo['url'],
							)
						);
					endforeach;
				endif;
				?>
			</div>

			<?php if ( $showing_demos ) : ?>
				<p class="projects-note"><?php esc_html_e( 'Rādīti parauga projekti. Pievieno savus projektus WordPress administrācijā.', 'latvijai-futura' ); ?></p>
			<?php endif; ?>
		</div>
	</section>

	<section id="fokuss" class="section spotlight">
		<div class="container">
			<div class="spotlight-panel reveal">
				<div class="spotlight-content">
					<p class="eyebrow"><?php echo esc_html( latvijai_get( 'spotlight_eyebrow' ) ); ?></p>
					<?php
					$spotlight_title = latvijai_get( 'spotlight_title' );
					$spotlight_words = preg_split( '/\s+/u', trim( $spotlight_title ) );
					$spotlight_last  = array_pop( $spotlight_words );
					$spotlight_first = implode( ' ', $spotlight_words );
					?>
					<h2 class="spotlight-title">
						<?php if ( '' !== $spotlight_first ) : ?>
							<?php echo esc_html( $spotlight_first ); ?>
						<?php endif; ?>
						<span><?php echo esc_html( $spotlight_last ); ?></span>
					</h2>
					<p class="spotlight-text"><?php echo esc_html( latvijai_get( 'spotlight_text' ) ); ?></p>
					<div>
						<a class="btn btn-light" href="<?php echo esc_url( latvijai_get( 'spotlight_url' ) ); ?>">
							<?php echo esc_html( latvijai_get( 'spotlight_label' ) ); ?>
							<?php latvijai_icon_e( 'arrow-up-right' ); ?>
						</a>
					</div>
				</div>

				<div class="spotlight-visual" aria-hidden="true">
					<span class="spotlight-orbit"></span>
					<span class="spotlight-glyph">Ā</span>
					<span class="spotlight-coords"><?php echo esc_html( latvijai_get( 'contact_coords' ) ); ?></span>
				</div>
			</div>
		</div>
	</section>

	<section id="zurnals" class="section journal">
		<div class="container">
			<div class="section-top">
				<div class="reveal">
					<span class="eyebrow"><span class="eyebrow-index">04</span> <?php esc_html_e( 'Žurnāls', 'latvijai-futura' ); ?></span>
					<h2 class="section-title"><?php esc_html_e( 'Stāsti no', 'latvijai-futura' ); ?><br><span class="text-outline"><?php esc_html_e( 'Latvijas nākotnes.', 'latvijai-futura' ); ?></span></h2>
				</div>
				<a class="link-arrow" href="<?php echo esc_url( $journal_url ); ?>">
					<?php esc_html_e( 'Visi ieraksti', 'latvijai-futura' ); ?>
					<?php latvijai_icon_e( 'arrow-up-right' ); ?>
				</a>
			</div>

			<div class="journal-grid">
				<?php
				$journal = new WP_Query(
					array(
						'post_type'           => 'post',
						'posts_per_page'      => 3,
						'ignore_sticky_posts' => true,
						'no_found_rows'       => true,
					)
				);

				if ( $journal->have_posts() ) :
					$index = 0;
					while ( $journal->have_posts() ) :
						$journal->the_post();
						get_template_part(
							'template-parts/content-card',
							null,
							array(
								'post_id' => get_the_ID(),
								'index'   => $index,
							)
						);
						$index++;
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<div class="empty-state reveal" style="grid-column: 1 / -1;">
						<p class="eyebrow"><?php esc_html_e( 'Tukšs signāls', 'latvijai-futura' ); ?></p>
						<h2><?php esc_html_e( 'Pirmie stāsti jau ceļā.', 'latvijai-futura' ); ?></h2>
						<p><?php esc_html_e( 'Žurnāls tiks atvērts pavisam drīz. Tikmēr pievienojies kustībai vai ieskaties projektos.', 'latvijai-futura' ); ?></p>
						<div class="empty-actions">
							<a class="btn btn-primary" href="#pieteikties"><?php esc_html_e( 'Pievienoties', 'latvijai-futura' ); ?></a>
							<a class="btn btn-ghost" href="#projekti"><?php esc_html_e( 'Projekti', 'latvijai-futura' ); ?></a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section id="pieteikties" class="cta-section">
		<div class="container">
			<div class="cta-panel reveal">
				<p class="eyebrow"><?php echo esc_html( latvijai_get( 'cta_eyebrow' ) ); ?></p>
				<h2 class="cta-title">
					<?php echo esc_html( latvijai_get( 'cta_title' ) ); ?>
					<span class="text-outline"><?php echo esc_html( latvijai_get( 'cta_title_2' ) ); ?></span>
				</h2>
				<p class="cta-text"><?php echo esc_html( latvijai_get( 'cta_text' ) ); ?></p>
				<div class="cta-actions">
					<a class="btn btn-primary btn-lg" href="<?php echo esc_url( latvijai_get( 'cta_primary_url' ) ); ?>">
						<?php echo esc_html( latvijai_get( 'cta_primary_label' ) ); ?>
						<?php latvijai_icon_e( 'arrow-up-right' ); ?>
					</a>
					<a class="btn btn-ghost btn-lg" href="<?php echo esc_url( latvijai_get( 'cta_secondary_url' ) ); ?>">
						<?php echo esc_html( latvijai_get( 'cta_secondary_label' ) ); ?>
						<?php latvijai_icon_e( 'heart' ); ?>
					</a>
				</div>
				<p class="cta-meta"><?php echo esc_html( latvijai_get( 'cta_meta' ) ); ?></p>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();

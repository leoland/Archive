<?php
/**
 * Block template file: template-parts/blocks/team/team.php
 *
 * Team Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'team-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-team';
if( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$bbgc = get_field( 'bbgc' ); 
if( !empty( $bbgc ) ) {
    $classes .= ' bg-' . $bbgc;
}
$classes .= ' helio-block';
?>




<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<div class="inner-block-wrapper wrap">
		<div class="intro">
			<h2>
				<?php the_field( 'headline' ); ?>
			</h2>
			<div class="copy">
				<?php the_field( 'copy' ); ?>
			</div>

		</div>





		<?php $selected_staff = get_field( 'selected_staff' ); ?>
		<?php if ( $selected_staff ): ?>
		<div class="staff-list">


			<?php foreach ( $selected_staff as $p ): ?>
			<div class="single-team-member">
				<div class="member-photo" style="background-image: url(<?php  echo get_the_post_thumbnail_url( $p);?>)">

				</div>
				<!--<a href="<?php echo get_permalink( $p ); ?>">
</a>
			-->
				<div class="member-details">


					<p class='name'><?php the_field( 'first_name', $p  ); ?>
						<?php the_field( 'last_name', $p  ); ?></p>

					<?php $title = get_field( 'title', $p  );
						if ($title){?>

					<div class="title"><?php echo $title ?></div>

					<?php	} ?>

					<?php $blurb = get_field( 'mini_blurb', $p  );
						if ($blurb){?>

					<div class="blurb">
						<?php echo $blurb ?>
					</div>

					<?php	} ?>
				</div>

			</div>
			<?php endforeach; ?>
		</div>


		<?php endif; ?>
	</div>
</div>
</div>
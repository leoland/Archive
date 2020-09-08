<?php
        /**
        * Template part for displaying a Team.
        */
        ?>
<section class="block team">
    <div class="outer-block-wrapper">
        <!-- extend with needed container -->
        <div class="inner-block-wrapper">
            <!-- probably extend with row or -->
            <!-- Stuff goes here -->

            <?php $heading =  get_sub_field( 'heading' );
if ($heading){
    ?>
            <h1 class="block-heading">
                <?php echo $heading ?>
            </h1>
            <?php
}
	     ?>


            <?php $members = get_sub_field( 'members' ); ?>
            <?php if ( $members ): ?>
            <div class="members">
                <div class="inner">

                
                <?php foreach ( $members as $post ):  ?>
                <?php setup_postdata ( $post ); ?>
                <div class="member">
                    <a href="<?php the_permalink(); ?>">
                        <?php $member_photo = get_field( 'member_photo' ); ?>
                        <?php if ( $member_photo ) { ?>
                        <img src="<?php echo $member_photo['url']; ?>" alt="<?php echo $member_photo['alt']; ?>" />
                        <?php } ?>
                        <div class="details">
                        <h3><?php the_title()?></h3>
                        <p><?php the_field( 'Position name' ); ?></p>
                        </div>
                       
                    </a>
                </div>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            </div></div>
            <?php endif; ?>
        </div>
    </div>
</section>
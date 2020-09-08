 <?php
/**
 * Template part for displaying a Logo block.
 */
?>

 <?php $style = get_sub_field('block_style');?>

 <section class="block logo_block <?php echo $style; ?> background-<?php the_sub_field('block_background_color');?>">

     <div class="outer-block-wrapper">
         <!-- extend with needed container -->
         <div class="inner-block-wrapper">
             <!-- probably extend with row or -->


             <h1><?php the_sub_field('heading');?></h1>

             <?php $logos = get_sub_field('logos');?>

             <?php if (is_array($logos)) {?>
             <?php /* shuffle($logos); */?>
             <div class="logos <?php
if ('slider' == $style) {echo 'logo-slider';}?>">
                 <?php foreach ($logos as $logo) {?>
                 <a class="logo-wrapper" href="<?php echo $logo['link']; ?>" target="_blank">
                     <img src="<?php echo $logo['logo']['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
                 </a>
                 <?php }?>
                 <?php }?>

             </div>
         </div>
     </div>
 </section>
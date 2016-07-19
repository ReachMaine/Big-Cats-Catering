<?php
/**
 * The main template file.
 *
 */
 /* mods 
  * replace tl_fetch_welcomenote with reach_fetch_welcomenote
  */
  $tlset = get_option( 'tlset' );

  get_header();  
  
   
/********** Code Index
 *
 * -01- FETCH SLIDESHOW
 * -02- FETCH TAGLINE
 * -03- TOP CAROUSEL
 * -04- MAIN PART		
 */

?>


<!--
 * -01- FETCH SLIDESHOW
-->
<?php echo cro_fetch_slider(); ?>


<!--
 * -04- MAIN PART
-->
<div class="main">
	<div class="row">
		
		
		
<!--
 * -03- TOP CAROUSEL
-->

<?php if ( is_active_sidebar( 'tlicartop' ) ) { ?>	
	<div class="carousellerout">
		<div class="carouseller">
			<ul class="slides">			
				<?php dynamic_sidebar( 'tlicartop' ); ?>
			</ul>
		</div>
	</div>	
<?php } else{
	echo '<div class="carouselspaceholder">&nbsp;</div>';
} ?>		
		

<?php 
if (isset($tlset['cro_showbanindex']) && $tlset['cro_showbanindex'] == 1 && isset($tlset['cro_showbanpos']) && $tlset['cro_showbanpos'] == 1) {
 echo cro_fetch_banner();
}
?>
		

<!--
 * -03- MAIN PART
-->		
				
		<div class="eight columns cro_maincolumns">


			<?php if ($tlset['blog_frontpage'] == 2) { ?>


			<?php 
				while ( have_posts() ) : the_post();
				get_template_part( 'public/tparts/content', get_post_format() ); 
				endwhile; 
			?>
			<?php cro_paging(); ?>	


			<?php } else { ?>


			<?php if (isset($tlset['index-pagelink']) && $tlset['index-pagelink'] >= 1){
							
				echo reach_fetch_welcomenote($tlset['index-pagelink']);			/* zig */	
			} ?>
			
			<div class="six columns fpwidg" style="padding-left: 0px;">
				<?php if ( is_active_sidebar( 'trifronttop' ) ) { 
					echo '<ul class="mainwidget">';
					dynamic_sidebar( 'trifronttop' );
					echo '</ul>';
				} ?>		
			
			</div> <!-- .c-4 -->	

			<div class="six columns fpwidg" style="padding-right: 0px;">
				<?php if ( is_active_sidebar( 'tcifronttop' ) ) { 
					echo '<ul class="mainwidget">';
					dynamic_sidebar( 'tcifronttop' );
					echo '</ul>';
				} ?>			
			</div> <!-- .c-4 -->	


			<?php } ?>
								
			

						
		</div> <!-- .c-8 -->
		
		
		<div class="four columns">

			<?php if ( is_active_sidebar( 'tlifronttop' ) ) { 
				echo '<ul class="mainwidget">';
				dynamic_sidebar( 'tlifronttop' );
				echo '</ul>';
			} ?>		
			
		</div> <!-- .c-4 -->

		<div class="clearfix"></div>

<?php 
if (isset($tlset['cro_showbanindex']) && $tlset['cro_showbanindex'] == 1 && isset($tlset['cro_showbanpos']) && $tlset['cro_showbanpos'] == 2) {
 echo cro_fetch_banner();
}
?>	
			
<?php get_footer(); ?>

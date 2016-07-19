<?php 
function year_shortcode() {
    $year = date('Y');
    return $year;
}

add_shortcode('current_year', 'year_shortcode');

// add widget area at bottom of page content.
	if ( function_exists('register_sidebar') ){
		// Banner Ad
		 register_sidebar(array(
			'name' => 'Under Content',
			'id' => 'undercontent',
			'description' => 'Widget area under content.',
			'before_widget' => '<li id="%1$s" class="widget-container %2$s clear">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		)); 
	} //function_exists('register_sidebar')	

// function to replace bistro's function tl_fetch_welcomenote() s.t. we can display a caption with the image.
	
function reach_fetch_welcomenote($id){
	
	$tlset = get_option( 'tlset' );
	$bt = get_post($id); 
	$op = '<div class="post welcomepost" style="margin-bottom: 15px;">'; // container 
	$op .= '<div class="welcomeimg">';
	/****
	$op .=  	get_the_post_thumbnail( $id, 'medium', array('class'	=> "align-left") ); // zig add 
	$op .= 		'<div class="welcomecaption">';
	$thumb_img = get_post_thumbnail_id($id);
	$caption = get_post($thumb_img)->post_excerpt;
	$op .= 			$caption;
	//$op .= 			get_post(get_post_thumbnail_id($id))->post_excerpt ->post_excerpt;
	$op .= 		'</div>'; //end of caption 
	****/
	/* *** */ $thumb_img = get_post_thumbnail_id($id);
	$caption = get_post($thumb_img)->post_excerpt;
	$op .= do_shortcode('[caption width="290" align="alignleft"]'.get_the_post_thumbnail( $id, 'medium', array('class'	=> "align-left") ).$caption.'[/caption]');

	/* *** */
	$op .= '</div>'; // end of welcomeimg 
	$op .= '<div class="entry-title">';
	
	$op .= '<h2>' . $bt->post_title . '</h2>';
	
	$op .= '</div>'; // end title
	
	$op .= wpautop($bt->post_content);
	
	$op .= '<div class="clearfix"></div></div>';
	
	
	return $op;
}
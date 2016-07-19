<?php
/**
 * THEME SETTINGS AND EXECUTION FOR THE banners
 *
 */
/* mods 
 *    23Dec15 zig - put background on left side (instead of whole event) & position it center center
 */
/********** Code Index
 *
 * -01- FETCH THE BANNERS
 */



/* 
 * -01- UPCOMMING EVENTS
 * 
 * */

function cro_fetch_banner() {

	$tlset = get_option( 'tlset' );
	$op = $pp = ''; 
	$ap = get_upcomming_arr(1);


	if (isset($tlset['cro_showbanwhat']) && $tlset['cro_showbanwhat'] == 1 || $tlset['cro_showbanwhat'] == 3){
		if (isset($ap) && !empty($ap)){
			$phot = wp_get_attachment_image_src( get_post_thumbnail_id($ap[0]['id']), 'banner' );
			$img = $phot[0];
			if (!$img) {
				$img  =  get_template_directory_uri() . '/public/styles/images/imgcommingsoon2.jpg';
			}
			$apdate = $ap[0]['date'] - (get_option('gmt_offset') * 3600) ;
			$banmess = get_post_meta( $ap[0]['id'], 'cro_bannerline' , true );

			$pp .= '<div class="cro_bannerouter">';
			$pp .= '<div class="cro_baninner">';
			$pp .= '<div class="banleft banleftcal"  style="background: url('  . $img  . ') no-repeat center center;">';
			$pp .= '<a href="' .   get_permalink($ap[0]['id'])   . '">' . __('More info','localize') . '</a>';
			$pp .= '</div>';
			$pp .= '<div class="banright">';
			$pp .= '<h4><a href="' .   get_permalink($ap[0]['id'])   . '">' .  get_the_title($ap[0]['id']) . '</a></h4>';
			if ($banmess) {
				$pp .= '<h5>' .  $banmess  . '</h5>';
			}
			$pp .= '<ul class="timervalue" rel="' .  $apdate . '">';
			$pp .= '<li class="cro_timerday"><span class="daynumber dsec">00</span><span class="dayname">' . __('Days','localize') . '</span></li>';
			$pp .= '<li class="cro_timerday"><span class="hournumber dsec">00</span><span class="dayname">' . __('Hour','localize') . '</span></li>';
			$pp .= '<li class="cro_timerday"><span class="minutenumber dsec">00</span><span class="dayname">' . __('Min','localize') . '</span></li>';
			$pp .= '<li class="cro_timerday"><span class="secondnumber dsec">00</span><span class="dayname">' . __('Sec','localize') . '</span></li>';
			$pp .= '</ul>';
			$pp .= '<div class="clearfix"></div>';
			$pp .= '</div>';
			$pp .= '</div></div>';
		}
		if ($tlset['cro_showbanwhat'] == 3){
			$pp .= fetch_front_promos('banner');
		}
	} elseif (isset($tlset['cro_showbanwhat']) && $tlset['cro_showbanwhat'] == 2 ) {
		$pp .= fetch_front_promos('banner');
	}
	
	if ($pp) {
		$op .= '<div class="twelve column bannercover">';
		$op .= $pp;
		$op .= '</div>';
	}

	return $op;
}


?>
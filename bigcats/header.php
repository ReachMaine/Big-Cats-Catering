<?php
/**
 * The Header for our theme.
 */ 
/* mods 
 *  22Dec15 zig - add GTM function call.
 * 				- in logopartadd spot for site title
 *				- Add google font Bowlby One
 *  7Jan16 zig - add favicon
 *  12jan16 zig - modify columns in header, add tag line
 */
   
/********** Code Index
 *
 * -01- HEADER STUFF
 * -02- START BODY
 * -03- GET TOPBAR
 * -04- LOGO & SOCIAL
 * -05- START THE MAINBODY
 * -06- MENU
 * 
 */
 
// ARRAYS CONSISTING OF COLOR SETTINGS OF THE THEME AND THEME OPTIONS
$tlset = get_option( "tlset" );
$tlcol = 'cromacol' . $tlset['primcolor'] . $tlset['secpcolor'];


/**
 * -01- HEADER STUFF
 */ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" /> <?php /* zig */ ?> 
<link href='https://fonts.googleapis.com/css?family=Bowlby+One' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Chivo:400,900' rel='stylesheet' type='text/css'>
<?php
echo '<title>' .  wp_title('-' , 0, 'right' ) . '</title>';

$ap = get_mapstack();
if ($ap != '') {echo $ap;}

wp_head();
?>


<!--
 * -02- START BODY
 * 
-->
</head>
<?php 
	if ($ap != '') { ?>
		<body <?php body_class('cromacol11'); ?> onload="initialize()">
	<?php } else { ?>
		<body <?php body_class('cromacol11'); ?>>
	<?php } 
?>
<?php if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) { gtm4wp_the_gtm_tag(); } ?>
<!--
 * -03- GET TOPBAR
 * 
-->


<div id="tbar">
	<div class="row">
		<div class="twelve columns">					
		<?php						
			if ( has_nav_menu('topbar' ) ) {
				wp_nav_menu( array( 'container_class' => 'topbar-header', 'theme_location' => 'topbar') );
			} 		
		?>		
		</div>	
	</div>	
</div>




<!--
 * -04- LOGO & SOCIAL
 * 
-->
<div class="logopart">
	<div class="row logopart">
		<div class="four columns mobile-four logoside"> 
			<?php 

				if (defined('CROCSH') && CROCSH == '1') {
					if (isset($_COOKIE['cro_cssb']) && $_COOKIE['cro_cssb'] == '2'){
						echo '<a href="'. esc_url( home_url( '/' ) ) .'" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home"><img class="tllogo" title="' .  esc_attr( get_bloginfo( 'name', 'display' )) . '" src="' . get_template_directory_uri() . '/public/styles/images/darklogo.png" /></a>';
					} else {
						echo '<a href="'. esc_url( home_url( '/' ) ) .'" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home"><img class="tllogo" title="' .  esc_attr( get_bloginfo( 'name', 'display' )) . '" src="' .  $tlset['logo'] . '" /></a>';
					}
				} else {
					if(isset($tlset['logo']) && $tlset['logo'])  {
						echo '<a href="'. esc_url( home_url( '/' ) ) .'" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home"><img class="tllogo" title="' .  esc_attr( get_bloginfo( 'name', 'display' )) . '" src="' .  $tlset['logo'] . '" /></a>';
					} else {
						echo '&nbsp;';
					}
				}
			?>
		</div>
		<div class="seven columns mobile-four logocenter">
			<?php /* zig - add this div */ ?>
			<h5 class="bigcats-site-preamble">Chef Alex Grant&#39;s </h5>
			<h1 class="bigcats-site-title"><?php echo get_bloginfo( 'name', 'display' ); ?></h1>
			<h3 class="bigcats-tagline"><?php echo get_bloginfo( 'description', 'display' ); ?></h3>
		</div>
		<div class="one columns mobile-four">
			<div class="socinner">
				<?php echo ntfetch_social(); ?>
			</div>
		</div>
	</div>

	<?php 
	if(isset($tlset['tagline']) && $tlset['tagline'])  {
		echo  wpautop(html_entity_decode(stripslashes($tlset['tagline']))); 
	}
	?>


</div>



<!--
 * -05- START THE MAINBODY
-->
<div class="mbod">
	
	
	
<!--
 * -06- MENU
-->

<div id="mainmen">
	<div class="row">
		<?php if ( has_nav_menu('secondnav' ) ) { ?>
			<div id="access" class="cro_hassecond">	
		<?php } else { ?>
			<div id="access">	
		<?php } ?>

		<?php 
		if ( has_nav_menu('primary' ) ) {
			wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'menu_id'  => 'cro-menu' ) ); 
		} 

		?>

		</div>
		<?php 
			if ( has_nav_menu('secondnav' ) ) {
				wp_nav_menu( array( 'container_class' => 'secondnav', 'theme_location' => 'secondnav' ) );
			}
		?>	
	</div>
</div>

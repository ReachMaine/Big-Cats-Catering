<?php
	require_once(get_stylesheet_directory().'/custom/language.php');
	require_once(get_stylesheet_directory().'/custom/reach.php');

	add_action('after_setup_theme', 'ea_setup');
	/**  ea_setup
	*  init stuff that we have to init after the main theme is setup.
	*
	*/
	function ea_setup() {
	 /* do stuff ehre. */
	 add_action( 'wp_enqueue_scripts', 'croma_fetch_mystyle' );
	}
	add_image_size('reach_featured_image', 750, 350, false);
	function ea_custom_sizes( $sizes ) {
	    return array_merge( $sizes, array(
	        'reach_featured_image' => __( 'Reach Blog Featured' ),
	    ) );
	}
	add_filter('widget_text', 'do_shortcode'); // make text widget do shortcodes....

	/* image size for facebook */
	add_image_size( 'facebook_share', 470, 246, true );
	add_image_size('facebook_share_vert', 246, 470, true);
	add_filter('wpseo_opengraph_image_size', 'mysite_opengraph_image_size');
	function mysite_opengraph_image_size($val) {
		return 'facebook_share';
	}

		// contact form 7 fallback for date field
	add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

	/*****  change the login screen logo ****/
	function my_login_logo() { ?>
		<style type="text/css">
			body.login div#login h1 a {
				background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/admin-img.png);
				padding-bottom: 30px;
				background-size: contain;
				margin-left: 0px;
				margin-bottom: 0px;
				margin-right: 0px;
				height: 60px;
				width: 100%;
			}
		</style>
	<?php }
	add_action( 'login_enqueue_scripts', 'my_login_logo' );

	register_sidebar(
		array(
						'name' =>'Top banner',
						'id'   => 'topbanner',
						'description'   => 'topbanner widget',
						'before_widget' => '<div class="%2$s ">',
						'after_widget'  => '</div>',
						'before_title'  => '<h6 class="widget-title ">',
						'after_title'   => '</h6>',
		)
	);

/*  stuff from child theme for bistro **********/
	/* add_action( 'wp_print_styles', 'cro_deregister_styles', 100 );
	function cro_deregister_styles() {
		wp_deregister_style( 'croma_style' );
		wp_deregister_style( 'croma_site' );
	} */


	//add_action( 'wp_enqueue_scripts', 'croma_fetch_mystyle' );

	function croma_fetch_mystyle() {
		wp_enqueue_style('croma_mystyle', get_stylesheet_directory_uri() . '/style.css', array(), null, 'all');
	}
	/*  end stuff from child theme for bistro **********
?>

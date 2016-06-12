<?php

function basis_full_width_customizer($wp_customize) {
    $wp_customize->add_setting('full_width', array(
        'default'        => 0,
    ));

    $wp_customize->add_control('full_width', array(
        'label'   => 'Full Width Header / Footer',
        'section' => 'layout',
        'type'    => 'radio',
				'choices'  => array(
					0  => "Disabled",
					1 => "Enabled",
				),
    ));
}
add_action('customize_register', 'basis_full_width_customizer');

function basis_full_width_control( $classes ) {
	$classes = explode( ' ', $classes );
	if(get_theme_mod('full_width') == 1) {
		$classes[] = 'no-max-width';
	}
	return implode( ' ', $classes );
}

function basis_theme_setup() {
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 400,
		'flex-width' => true,
	) );

	add_theme_support( 'custom-header', array(
		'default-image'          => get_stylesheet_directory_uri() . '/assets/images/hero.png',
		'width'                  => 1060,
		'height'                 => 550,
		'flex-height'            => true,
		'flex-width'             => false,
		'uploads'                => true,
		'random-default'         => false,
		'header-text'            => true,
		'default-text-color'     => '',
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	) );

	add_image_size( 'hero', 1060, 550, array( 'center', 'center' ) );

}
add_action( 'after_setup_theme', 'basis_theme_setup' );

function basis_get_featured_image() {
	$post_id = get_queried_object_id();
	if ( has_post_thumbnail( $post_id ) ) {
		$image = get_the_post_thumbnail_url( $post_id, 'hero' );
		if( getimagesize( $image ) ) {
				return $image;
		}
	}

	return header_image();
}

function basis_add_google_fonts() {
	wp_enqueue_style( 'ascension-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:600,600italic,800,300,300italic,400,400italic,700,700italic,800italic', false );
}
add_action( 'wp_enqueue_scripts', 'basis_add_google_fonts' );

function basis_replace_navigation() {
   wp_dequeue_script( 'basis-navigation' );
	 wp_enqueue_script( 'basis-navigation-2', get_stylesheet_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );
}
add_action( 'wp_print_scripts', 'basis_replace_navigation', 100 );

function basis_add_mobile_menu(){
	get_template_part( 'templates/parts/mobile-menu' );
}
add_action( 'basis_header', 'basis_add_mobile_menu', 0 );

function basis_move_navigation(){
  remove_action( 'basis_header_after', 'basis_add_primary_navigation', 20 );
	add_action( 'basis_header', 'basis_add_primary_navigation', 20 );
}
add_action( 'init', 'basis_move_navigation', 100 );

function basis_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'basis' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'The primary sidebar appears alongside the content of every page, post, archive, and search template.', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Sidebar', 'basis' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'The secondary sidebar will only appear when you have selected a three-column layout.', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'basis' ),
		'id'            => 'footer-1',
		'description'   => __( 'The footer sidebar appears in the first column of the footer widget area.', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'basis' ),
		'id'            => 'footer-2',
		'description'   => __( 'The footer sidebar appears in the second column of the footer widget area.', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'basis' ),
		'id'            => 'footer-3',
		'description'   => __( 'The footer sidebar appears in the third column of the footer widget area.', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'basis' ),
		'id'            => 'footer-4',
		'description'   => __( 'The footer sidebar appears in the fourth column of the footer widget area.', 'basis' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Hero', 'basis' ),
		'id'            => 'hero',
		'description'   => __( 'The hero appears in the hero widget area on the front page', 'basis' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
}

?>

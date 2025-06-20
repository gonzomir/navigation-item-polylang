<?php
$args = wp_parse_args(
	[
		'dropdown'          => 0,
		'display_names_as'  => 'slug',
		'show_flags'        => true,
		'show_names'        => false,
		'hide_if_empty'     => false,
		'hide_if_no_translation' => false,
	],
	$attributes
);

if ( function_exists( 'pll_the_languages' ) ) {
	pll_the_languages( $args );
}

<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

do_action( 'martfury_woocommerce_main_content' );

get_footer( 'shop' );

<?php
/*
Plugin Name: HTTPS Indicator
Description: HTTPS Indicator
Version:     1.0
Author:      John Blackbourn
Author URI:  https://johnblackbourn.com/
License:     GPL v2 or later
Network:     true

Copyright © 2015 John Blackbourn

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

*/

add_action( 'admin_bar_menu', function( WP_Admin_Bar $wp_admin_bar ) {

	$https = array(
		'home_url()'  => ( 0 === strpos( home_url(), 'https' ) ),
		'home'        => ( 0 === strpos( get_option( 'home' ), 'https' ) ),
		'site_url()'  => ( 0 === strpos( site_url(), 'https' ) ),
		'siteurl'     => ( 0 === strpos( get_option( 'siteurl' ), 'https' ) ),
		'admin_url()' => ( 0 === strpos( admin_url(), 'https' ) ),
		'fsa()'       => force_ssl_admin(),
		'FSA'         => ( defined( 'FORCE_SSL_ADMIN' ) && FORCE_SSL_ADMIN ),
	);

	$out = '';

	foreach ( $https as $text => $secure ) {
		if ( ! $secure ) {
			$out .= '<span style="background-color:#777;color:#fff;padding:2px 3px;margin-left:1px;font-size:10px;">' . $text . '</span>';
		} else {
			$out .= '<span style="background-color:#797;color:#fff;padding:2px 3px;margin-left:1px;font-size:10px;">' . $text . '</span>';
		}
	}

	$wp_admin_bar->add_menu( array(
		'id'     => 'https-indicator',
		'parent' => 'top-secondary',
		'title'  => $out,
	) );

} );

<?php
/**
 * Plugin Name: Uptime Page
 * Description: Adds Uptime Page like from Pingdom into site's Dashboard.
 * Version: 1.1.0
 * Author: SMFB Dinamo
 * Author URI: https://smfb-dinamo.com
 * Tested up to: 6.2.2
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

use WPD\UptimePage;

if (
	defined( 'UPTIME_STATUS_PAGE' ) &&
	defined( 'PINGDOM_TOKEN' ) &&
	defined( 'PINGDOM_PROJECT' )
) {
	(
		new UptimePage\Plugin(
			new UptimePage\Url( UPTIME_STATUS_PAGE ),
			new UptimePage\Providers\Pingdom(
				PINGDOM_TOKEN,
				PINGDOM_PROJECT,
				new UptimePage\HttpClient(
					new UptimePage\Url( 'https://api.pingdom.com/api/3.1' )
				)
			)
		)
	)->run();
}

register_deactivation_hook( __FILE__, [ UptimePage\Plugin::class, 'clear_cache' ] );

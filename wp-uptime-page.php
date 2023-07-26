<?php
/**
 * Plugin Name: Uptime Page
 * Description: Adds Uptime Page like from Pingdom into site's Dashboard.
 * Version: 1.0.0
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

if ( defined( 'UPTIME_STATUS_PAGE' ) ) {
	( new UptimePage\Plugin( UPTIME_STATUS_PAGE ) )->run();
}

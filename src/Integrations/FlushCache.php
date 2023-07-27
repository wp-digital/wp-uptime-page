<?php

namespace WPD\UptimePage\Integrations;

use WPD\UptimePage\Plugin;

class FlushCache implements Integration {

	/**
	 * @param Plugin $plugin
	 * @return void
	 */
	public function run( Plugin $plugin ): void {
		if ( function_exists( 'flush_cache_add_button' ) ) {
			flush_cache_add_button(
				esc_html__( 'Uptime Page path', 'wpd-uptime-page' ),
				[ Plugin::class, 'clear_cache' ]
			);
		}
	}
}

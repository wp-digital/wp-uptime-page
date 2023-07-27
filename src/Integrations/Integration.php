<?php

namespace WPD\UptimePage\Integrations;

use WPD\UptimePage\Plugin;

interface Integration {

	/**
	 * @param Plugin $plugin
	 * @return void
	 */
	public function run( Plugin $plugin ): void;
}

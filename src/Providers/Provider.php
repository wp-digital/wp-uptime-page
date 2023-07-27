<?php

namespace WPD\UptimePage\Providers;

interface Provider {

	/**
	 * @return string
	 */
	public function path(): string;
}

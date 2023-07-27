<?php

namespace WPD\UptimePage\Exceptions;

class ProviderException extends \Exception {

	/**
	 * @param string          $path
	 * @param int             $code
	 * @param \Throwable|null $previous
	 */
	public function __construct( string $path, int $code = 0, \Throwable $previous = null ) {
		parent::__construct(
			sprintf(
				'Failed to fetch data from \'%s\'.',
				$path
			),
			$code,
			$previous
		);
	}
}
